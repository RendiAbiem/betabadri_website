<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index()
    {
        // 1. DATA TRANSAKSI - Tampilkan semua data untuk semua role (Tanpa filter user_id)
        $expenses = Expense::latest('date')->paginate(10);

        // 2. TOTAL DISETUJUI
        $totalApproved = Expense::where('status', 'approved')->sum('amount');

        // 3. LOGIKA REKAP BULANAN
        $currentYear = date('Y');
        $monthlyData = Expense::whereYear('date', $currentYear)
            ->where('status', 'approved')
            ->selectRaw('MONTH(date) as month, SUM(amount) as total_amount, COUNT(id) as total_transaction')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $monthlyRecap = collect();
        for ($i = 1; $i <= 12; $i++) {
            $data = $monthlyData->get($i);
            $monthlyRecap->push((object)[
                'month_num' => $i,
                'month_name' => Carbon::create()->month($i)->translatedFormat('F'),
                'year' => $currentYear,
                'total' => $data ? $data->total_amount : 0,
                'count' => $data ? $data->total_transaction : 0,
                'is_current' => $i == date('n'),
            ]);
        }

        return view('pages.admins.expenses.index', compact('expenses', 'totalApproved', 'monthlyRecap'));
    }

    public function create()
    {
        return view('pages.admins.expenses.create');
    }

    public function store(Request $request)
    {
        // 1. UPDATE VALIDASI: 'images' sekarang berupa array
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Validasi array
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi per file di dalam array
        ]);

        // 2. UPDATE UPLOAD: Looping untuk menyimpan banyak file
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('expenses', 'public');
                $imagePaths[] = $path; // Masukkan path ke dalam array
            }
        }

        // 3. Simpan data (Path gambar diubah jadi format JSON)
        Expense::create([
            'user_id' => auth()->id(), // <--- DITAMBAHKAN AGAR USER BISA HAPUS DATANYA SENDIRI
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            // Simpan array sebagai JSON string (misal: ["expenses/1.jpg", "expenses/2.jpg"])
            'image' => !empty($imagePaths) ? json_encode($imagePaths) : null,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.expenses.index')->with('success', 'Pengajuan berhasil disimpan.');
    }

    // Fungsi Konfirmasi (Approve)
    public function approve(Expense $expense)
    {
        $expense->update(['status' => 'approved']);
        return back()->with('success', 'Pengeluaran disetujui.');
    }

    // Fungsi Tolak (Reject)
    public function reject(Expense $expense)
    {
        $expense->update(['status' => 'rejected']);
        return back()->with('success', 'Pengeluaran ditolak.');
    }

    public function destroy(Expense $expense)
    {
        // Pengecekan Keamanan Ekstra (Opsional tapi direkomendasikan)
        // Pastikan hanya admin atau pembuat data yang bisa menghapus, dan hanya jika status pending
        if (auth()->user()->role !== 'admin') {
            if ($expense->user_id !== auth()->id() || $expense->status !== 'pending') {
                return back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            }
        }

        // UPDATE HAPUS FILE: Karena formatnya sekarang JSON array, kita harus decode dulu
        if ($expense->image) {
            $images = json_decode($expense->image, true);

            // Cek apakah hasil decode adalah array (data baru)
            if (is_array($images)) {
                foreach ($images as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            // Fallback untuk data lama (jika sebelumnya hanya simpan 1 string path)
            else if (Storage::disk('public')->exists($expense->image)) {
                Storage::disk('public')->delete($expense->image);
            }
        }

        $expense->delete();
        return back()->with('success', 'Data dihapus.');
    }
}
