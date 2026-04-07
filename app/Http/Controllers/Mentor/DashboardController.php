<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\TeachingJournal;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Jadwal Hari Ini (Ambil nama hari dalam Bhs Indonesia)
        Carbon::setLocale('id');
        $todayName = Carbon::now()->translatedFormat('l'); // Senin, Selasa...

        $todaySchedules = Schedule::with(['school', 'program'])
            ->where('user_id', $user->id)
            ->where('day', $todayName)
            ->orderBy('time_start')
            ->get();

        // 2. Total Jam Mengajar Bulan Ini (Estimasi dari Jurnal)
        // Asumsi: 1 Jurnal = 1 Sesi (misal 2 jam).
        // Atau hitung manual via schedule. Di sini kita hitung jumlah sesi saja.
        $totalSessions = TeachingJournal::where('user_id', $user->id)
            ->whereMonth('date', Carbon::now()->month)
            ->count();

        // 3. Pengumuman (Dummy dulu, nanti bisa dari tabel Announcements)
        $announcement = "Minggu depan tanggal 24-25 Libur Cuti Bersama.";

        return view('pages.mentors.dashboard.index', compact('todaySchedules', 'totalSessions', 'announcement'));
    }
}
