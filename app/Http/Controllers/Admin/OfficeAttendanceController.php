<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Response;

class OfficeAttendanceController extends Controller
{
    /**
     * Menampilkan Halaman Absensi & Logika Filter
     */
    public function index(Request $request)
    {
        // 1. Logika Notifikasi: Jika Admin membuka halaman ini, tandai semua absen hari ini sebagai 'sudah dilihat'
        if (Auth::user()->role === 'admin') {
            OfficeAttendance::whereDate('date', Carbon::today())
                ->where('is_seen', false)
                ->update(['is_seen' => true]);
        }

        $query = OfficeAttendance::with('user');

        // Filter by Role
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        } elseif ($request->role) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        // Filter Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            // Default tampilkan data bulan berjalan agar tidak kosong
            $query->whereMonth('date', date('m'))->whereYear('date', date('Y'));
        }

        $attendances = $query->latest('date')->latest('clock_in')->paginate(10);

        // Ringkasan Statistik
        $summaryQuery = clone $query;
        $summaryData = $summaryQuery->reorder()->get();

        $summary = [
            'present' => $summaryData->where('status', 'present')->count(),
            'late' => $summaryData->where('status', 'late')->count(),
            'absent' => $summaryData->where('status', 'absent')->count(),
        ];

        $todayAttendance = OfficeAttendance::where('user_id', Auth::id())
            ->whereDate('date', Carbon::today())
            ->first();

        return view('pages.admins.attendance.index', compact('attendances', 'summary', 'todayAttendance'));
    }

    /**
     * Proses Absen Masuk (Wajib Upload Foto + Geolokasi)
     */
    public function clockIn(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'image_in' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image_in.required' => 'Anda wajib mengunggah foto selfie/lokasi untuk absen masuk.',
        ]);

        $userId = Auth::id();
        $today = Carbon::today();

        $check = OfficeAttendance::where('user_id', $userId)->where('date', $today)->first();
        if ($check) {
            return back()->with('error', 'Anda sudah absen masuk hari ini.');
        }

        $imagePath = null;
        if ($request->hasFile('image_in')) {
            $imagePath = $request->file('image_in')->store('attendance/in', 'public');
        }

        // Koordinat Kantor
        $officeLat = 0.477919;
        $officeLng = 101.422727;
        $radius = 0.05;

        $distance = sqrt(pow(($request->lat - $officeLat), 2) + pow(($request->lng - $officeLng), 2));
        $workMode = ($distance <= $radius) ? 'WFO' : 'WFA';

        OfficeAttendance::create([
            'user_id' => $userId,
            'date' => $today,
            'clock_in' => Carbon::now()->format('H:i:s'),
            'image_in' => $imagePath,
            'status' => 'present',
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'work_mode' => $workMode,
            'is_seen' => false // Default false agar muncul di notifikasi Admin
        ]);

        return back()->with('success', "Berhasil Absen Masuk ($workMode)! Selamat bekerja.");
    }

    /**
     * Proses Absen Pulang
     */
    public function clockOut(Request $request, $id)
    {
        $request->validate([
            'activity' => 'required|string|max:255',
            'report_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ], [
            'activity.required' => 'Mohon isi ringkasan kegiatan Anda hari ini.',
            'report_file.required' => 'Wajib upload file bukti kerja untuk absen pulang.'
        ]);

        $attendance = OfficeAttendance::findOrFail($id);

        if ($attendance->user_id != Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        if ($attendance->clock_out) {
            return back()->with('error', 'Anda sudah melakukan absen pulang.');
        }

        $filePath = null;
        if ($request->hasFile('report_file')) {
            $filePath = $request->file('report_file')->store('reports', 'public');
        }

        $attendance->update([
            'clock_out' => Carbon::now()->format('H:i:s'),
            'activity' => $request->activity,
            'report_file' => $filePath,
        ]);

        return back()->with('success', 'Laporan terkirim & Berhasil Absen Pulang!');
    }

    /**
     * Export Excel/CSV
     */
    public function exportExcel(Request $request)
    {
        $query = OfficeAttendance::with('user')->latest();

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $attendances = $query->get();

        $csvFileName = 'Laporan-Absensi-' . date('Y-m-d_H-i') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
        ];

        $callback = function() use($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Tanggal', 'Nama Karyawan', 'Jam Masuk', 'Jam Pulang', 'Mode Kerja', 'Status', 'Ringkasan Kegiatan']);

            foreach ($attendances as $key => $item) {
                fputcsv($file, [
                    $key + 1,
                    $item->date,
                    $item->user->name ?? '-',
                    $item->clock_in ?? '-',
                    $item->clock_out ?? '-',
                    $item->work_mode ?? '-',
                    ucfirst($item->status),
                    $item->activity ?? '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
