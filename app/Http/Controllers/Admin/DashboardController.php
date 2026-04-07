<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// --- IMPORT MODEL ---
use App\Models\Student;
use App\Models\User;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Career;
use App\Models\OfficeAttendance;
use App\Models\School;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman Dashboard Admin.
     * Mengambil semua data statistik untuk widget dan tabel.
     */
    public function index()
    {
        // ==========================================
        // 1. STATISTIK UTAMA (WIDGET KARTU ATAS)
        // ==========================================

        // Hitung Total Seluruh Siswa (Termasuk yang tidak aktif)
        $total_students = Student::count();

        // Hitung Siswa yang Aktif Saja (is_active = 1)
        $activeStudents = Student::where('is_active', 1)->count();

        // Hitung Total Sekolah / Mitra Terdaftar
        // [BARU] Logika untuk widget "Total Sekolah"
        $total_schools = School::count();

        // Hitung Total Mentor
        $total_mentors = User::where('role', 'mentor')->count();


        // ==========================================
        // 2. STATISTIK KEUANGAN (REVENUE & EXPENSE)
        // ==========================================

        // A. Hitung Pemasukan Bulanan (Revenue)
        // Status pembayaran yang dianggap 'berhasil'
        $paidStatuses = ['paid', 'settlement', 'success', 'capture', 'pending_remittance'];

        $revenueRaw = Payment::whereIn('status', $paidStatuses)
            ->whereMonth('created_at', date('m')) // Bulan ini
            ->whereYear('created_at', date('Y'))  // Tahun ini
            ->sum('amount');

        // Format ke Rupiah (Contoh: "Rp 5.000.000")
        $monthly_revenue = 'Rp ' . number_format($revenueRaw, 0, ',', '.');

        // B. Hitung Request Cashout (Pengeluaran) yang Pending
        // (Tetap disimpan variabelnya jika nanti dibutuhkan untuk notifikasi)
        $pending_cashouts = Expense::where('status', 'pending')->count();


        // ==========================================
        // 3. DATA TABEL TERBARU (RECENT ACTIVITIES)
        // ==========================================

        // Ambil 5 Siswa Terbaru beserta data Sekolah & Programnya
        $recent_students = Student::with(['school', 'program'])
            ->latest()
            ->take(5)
            ->get();

        // Ambil 5 Pelamar Kerja Terbaru
        $recent_applicants = Career::latest()->take(5)->get();

        // Ambil 5 Data Kehadiran Karyawan Hari Ini
        $todays_attendance = OfficeAttendance::with('user')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // 4. KIRIM DATA KE VIEW
        // ==========================================
        return view('pages.admins.dashboard', compact(
            'total_students',
            'activeStudents',
            'total_schools',    // <--- [BARU] Dikirim ke view untuk kartu Sekolah
            'total_mentors',
            'monthly_revenue',
            'pending_cashouts',
            'recent_students',
            'recent_applicants',
            'todays_attendance'
        ));
    }
}
