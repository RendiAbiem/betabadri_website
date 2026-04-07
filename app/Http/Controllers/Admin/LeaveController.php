<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller
{
    public function index()
    {
        $query = Leave::with('user')->latest();

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $leaves = $query->paginate(10);
        return view('pages.admins.leaves.index', compact('leaves'));
    }

    // TAMBAHAN: Method untuk menampilkan form
    public function create()
    {
        return view('pages.admins.leaves.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string|min:10',
                'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $totalDays = $start->diffInDays($end) + 1;

            // Cek minimal 7 hari untuk Cuti Tahunan
            if ($request->type === 'Cuti Tahunan/Libur' && Carbon::now()->diffInDays($start, false) < 7) {
                return back()->withInput()->with('error', 'Cuti tahunan harus diajukan minimal 7 hari sebelumnya.');
            }

            $path = null;
            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('leaves', 'public');
            }

            Leave::create([
                'user_id' => auth()->id(),
                'type' => $request->type, // Sesuai dengan input name="type"
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_days' => $totalDays,
                'reason' => $request->reason,
                'attachment' => $path,
                'status' => 'pending'
            ]);

            // Ubah menjadi redirect ke index agar setelah submit kembali ke tabel
            return redirect()->route('admin.leaves.index')->with('success', 'Pengajuan cuti berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // TAMBAHAN: Method untuk menampilkan detail
    public function show($id)
    {
        $leave = Leave::with('user')->findOrFail($id);

        // Proteksi: Staff hanya bisa lihat miliknya sendiri
        if(auth()->user()->role !== 'admin' && $leave->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pages.admins.leaves.show', compact('leave'));
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);
        return back()->with('success', 'Pengajuan cuti telah disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['admin_note' => 'required|string']);
        $leave = Leave::findOrFail($id);
        $leave->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);
        return back()->with('success', 'Pengajuan cuti telah ditolak.');
    }
}
