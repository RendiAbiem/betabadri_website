<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\User;
use App\Notifications\NewExpenseRequest;
use App\Notifications\ExpenseStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class ExpenseController extends Controller
{
    public function index()
    {
        // 1. DATA TRANSAKSI
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
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('expenses', 'public');
                $imagePaths[] = $path;
            }
        }

        $expense = Expense::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'image' => !empty($imagePaths) ? json_encode($imagePaths) : null,
            'status' => 'pending',
        ]);

        // NOTIFIKASI: Kirim ke semua Admin saat ada pengajuan baru
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewExpenseRequest($expense));

        return redirect()->route('admin.expenses.index')->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function approve(Expense $expense)
    {
        $expense->update(['status' => 'approved']);

        // NOTIFIKASI: Kirim ke user yang mengajukan bahwa dana disetujui
        $expense->user->notify(new ExpenseStatusUpdated($expense));

        return back()->with('success', 'Pengeluaran disetujui.');
    }

    public function reject(Expense $expense)
    {
        $expense->update(['status' => 'rejected']);

        // NOTIFIKASI: Kirim ke user yang mengajukan bahwa dana ditolak
        $expense->user->notify(new ExpenseStatusUpdated($expense));

        return back()->with('success', 'Pengeluaran ditolak.');
    }

    public function destroy(Expense $expense)
    {
        if (auth()->user()->role !== 'admin') {
            if ($expense->user_id !== auth()->id() || $expense->status !== 'pending') {
                return back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            }
        }

        if ($expense->image) {
            $images = json_decode($expense->image, true);

            if (is_array($images)) {
                foreach ($images as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            else if (Storage::disk('public')->exists($expense->image)) {
                Storage::disk('public')->delete($expense->image);
            }
        }

        $expense->delete();
        return back()->with('success', 'Data dihapus.');
    }
}
