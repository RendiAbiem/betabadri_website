<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\NewLeaveRequest;
use App\Notifications\LeaveStatusUpdated;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log; // Import Log untuk debugging

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

            if ($request->type === 'Cuti Tahunan/Libur' && Carbon::now()->diffInDays($start, false) < 7) {
                return back()->withInput()->with('error', 'Cuti tahunan harus diajukan minimal 7 hari sebelumnya.');
            }

            $path = null;
            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('leaves', 'public');
            }

            $leave = Leave::create([
                'user_id' => auth()->id(),
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_days' => $totalDays,
                'reason' => $request->reason,
                'attachment' => $path,
                'status' => 'pending'
            ]);

            // --- PROSES NOTIFIKASI ---
            $admins = User::where('role', 'admin')->get();

            if ($admins->isNotEmpty()) {
                Notification::send($admins, new NewLeaveRequest($leave));
            } else {
                Log::warning('Notifikasi gagal dikirim: Tidak ada user dengan role admin.');
            }

            return redirect()->route('admin.leaves.index')->with('success', 'Pengajuan cuti berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Error Simpan Cuti: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $leave = Leave::with('user')->findOrFail($id);

        if(auth()->user()->role !== 'admin' && $leave->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        // Menandai notifikasi spesifik sebagai dibaca
        auth()->user()->unreadNotifications
            ->where('data.leave_id', (int)$id) // Casting ke integer untuk keamanan
            ->markAsRead();

        return view('pages.admins.leaves.show', compact('leave'));
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);

        // NOTIFIKASI ke Pengaju
        if ($leave->user) {
            $leave->user->notify(new LeaveStatusUpdated($leave));
        }

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

        // NOTIFIKASI ke Pengaju
        if ($leave->user) {
            $leave->user->notify(new LeaveStatusUpdated($leave));
        }

        return back()->with('success', 'Pengajuan cuti telah ditolak.');
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
