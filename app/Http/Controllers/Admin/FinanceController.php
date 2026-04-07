<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Import Model
use App\Models\Payment;
use App\Models\Student;
use App\Models\School;
use App\Models\Program;
use App\Models\Expense;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = date('Y'); // Tahun saat ini (misal: 2026)

        // ==========================================
        // 1. SETUP STATUS PEMBAYARAN
        // ==========================================
        $paidStatuses = [
            'paid', 'settlement', 'success', 'capture', 'pending_remittance'
        ];

        // Ambil SEMUA Data Pembayaran tahun ini untuk optimasi
        $allPayments = Payment::with('student.program')
            ->whereIn('status', $paidStatuses)
            ->whereYear('payment_date', $currentYear)
            ->get();

        // Ambil SEMUA Data Pengeluaran tahun ini
        $allExpenses = Expense::where('status', 'approved')
            ->whereYear('date', $currentYear)
            ->get();


        // ==========================================
        // 2. HITUNG STATISTIK KARTU ATAS (GLOBAL)
        // ==========================================

        // Income Bulan Ini
        $incomeThisMonth = $allPayments->filter(function($p) {
            return Carbon::parse($p->payment_date)->format('Y-m') === date('Y-m');
        })->sum('amount');

        // Expense Bulan Ini
        $expenseThisMonth = $allExpenses->filter(function($e) {
            return Carbon::parse($e->date)->format('Y-m') === date('Y-m');
        })->sum('amount');

        $balanceNow = $incomeThisMonth - $expenseThisMonth;


        // ==========================================
        // 3. REKAP TREND BULANAN (GRAFIK/TABEL)
        // ==========================================
        $monthlyBalance = [];

        // Loop dari Bulan 1 (Januari) sampai 12 (Desember)
        for ($i = 1; $i <= 12; $i++) {

            // Filter Income di Bulan $i
            $income = $allPayments->filter(function ($p) use ($i) {
                return Carbon::parse($p->payment_date)->month == $i;
            })->sum('amount');

            // Filter Expense di Bulan $i
            $expense = $allExpenses->filter(function ($e) use ($i) {
                return Carbon::parse($e->date)->month == $i;
            })->sum('amount');

            $monthlyBalance[] = (object) [
                'month' => $i,
                'month_name' => date('F', mktime(0, 0, 0, $i, 1)),
                'revenue' => $income,
                'total' => $income,
                'expense' => $expense,
                'profit' => $income - $expense
            ];
        }


        // ==========================================
        // 4. TABEL UTAMA (PER SEKOLAH) DENGAN SEARCH
        // ==========================================
        $querySchool = School::with(['students.program', 'students.payments']);

        // [BARU] Logika Pencarian Nama Sekolah
        if ($request->has('search') && $request->search != '') {
            $querySchool->where('name', 'like', '%' . $request->search . '%');
        }

        $schools = $querySchool->get();

        // Transformasi data sekolah
        $mainTable = $schools->map(function($school) use ($paidStatuses) {
            $students = $school->students;

            $totalCollected = 0;
            $totalDiscount = 0;

            foreach($students as $student) {
                foreach($student->payments as $payment) {
                    if(in_array($payment->status, $paidStatuses)) {
                        $totalCollected += $payment->amount;
                        $totalDiscount += ($payment->discount ?? 0);
                    }
                }
            }

            // Gunakan map() lalu sum() untuk menghindari error Query Builder
            $totalFee = $students->where('is_active', 1)->map(function($s) {
                return $s->program->school_fee ?? 0;
            })->sum();

            return (object) [
                'school_id' => $school->id,
                'school_name' => $school->name,
                'total_students' => $students->count(),
                'program_list' => $students->pluck('program.name')->unique()->filter()->implode(', '),
                'total_fee' => $totalFee,
                'total_collected' => $totalCollected,
                'total_discount' => $totalDiscount,
            ];
        });


        return view('pages.admins.finance.index', compact(
            'mainTable',
            'balanceNow',
            'incomeThisMonth',
            'expenseThisMonth',
            'monthlyBalance'
        ));
    }

     public function show(Request $request, $id)
    {
        $school = School::findOrFail($id);
        $programs = Program::whereHas('students', function($q) use ($id) {
            $q->where('school_id', $id);
        })->get();

        $query = Student::with(['program', 'payments'])->where('school_id', $id);

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('program_id') && $request->program_id != 'all') {
            $query->where('program_id', $request->program_id);
        }

        $students = $query->paginate(10);

        $paymentHistory = Payment::whereHas('student', function($q) use ($id) {
                $q->where('school_id', $id);
            })
            ->with('student.program')
            ->latest('payment_date')
            ->limit(50)
            ->get();

        return view('pages.admins.finance.show', compact('school', 'students', 'programs', 'paymentHistory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $student = Student::with('program')->findOrFail($request->student_id);
        $amount = $request->amount;
        $discount = $request->discount ?? 0;

        Payment::create([
            'student_id' => $student->id,
            'payment_type_snapshot' => $student->program->payment_type ?? 'per_siswa',
            'amount' => $amount,
            'discount' => $discount,
            'final_amount' => $amount - $discount,
            'school_fee_generated' => $student->program->school_fee ?? 0,
            'status' => 'paid',
            'payment_date' => $request->payment_date,
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
