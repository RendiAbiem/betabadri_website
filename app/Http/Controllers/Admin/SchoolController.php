<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Program; // Masih butuh untuk dropdown filter di 'show'
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    // 1. INDEX (Tetap Sama)
    public function index(Request $request)
    {
        // 1. QUERY UTAMA: Ambil data sekolah beserta jumlah siswanya
        $query = School::withCount('students');

        // 2. LOGIC PENCARIAN
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;

            // Menggunakan grouping function($q) agar logika OR tidak tercampur
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('pic_name', 'like', '%' . $search . '%');
            });
        }

        $schools = $query->latest()->paginate(10)->withQueryString();

        // 3. QUERY STATISTIK (Untuk Card di Atas)
        $totalSchools = School::count();

        // Menghitung total seluruh siswa dari model Student
        $totalStudents = \App\Models\Student::count();

        // Menghitung sekolah yang datanya belum lengkap (PIC masih kosong)
        $incompleteSchools = School::whereNull('pic_name')
                                ->orWhere('pic_name', '')
                                ->count();

        return view('pages.admins.schools.index', compact(
            'schools',
            'totalSchools',
            'totalStudents',
            'incompleteSchools'
        ));
    }

    // 2. CREATE (Hapus $programs)
    public function create() {
        // Tidak perlu kirim $programs lagi karena inputnya nanti terpisah
        return view('pages.admins.schools.create');
    }

    // 3. STORE (Hapus logic Sync/Checkbox)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'pic_name' => 'nullable|string',
            'pic_phone' => 'nullable|string',
            // 'programs' => ... (Hapus validasi programs)
        ]);

        // Simpan Data Sekolah Saja (Simpel)
        School::create($request->all());

        return redirect()->route('admin.schools.index')->with('success', 'Sekolah berhasil ditambahkan. Silakan buat Program untuk sekolah ini di menu Master Harga.');
    }

    // 4. EDIT (Hapus $programs)
    public function edit($id) {
        $school = School::findOrFail($id);
        return view('pages.admins.schools.edit', compact('school'));
    }

    // 5. UPDATE (Hapus logic Sync)
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $school->update($request->all());
        // Hapus $school->programs()->sync(...)

        return redirect()->route('admin.schools.index')->with('success', 'Data sekolah diperbarui');
    }

    // 6. DESTROY (Tetap Sama)
    public function destroy(School $school)
    {
        $school->delete();
        return back()->with('success', 'Sekolah dihapus');
    }

    // 7. SHOW (Update Filter Dropdown)
    public function show(Request $request, $id)
    {
        $school = School::findOrFail($id);

        // Query Siswa
        $query = $school->students()->with('program');

        if ($request->has('program_id') && $request->program_id != 'all') {
            $query->where('program_id', $request->program_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $students = $query->orderBy('name', 'asc')->paginate(20);

        // Ambil program KHUSUS milik sekolah ini saja untuk filter
        $programs = $school->programs;

        return view('pages.admins.schools.show', compact('school', 'students', 'programs'));
    }

    // 8. EXPORT PDF (Tetap Sama)
    public function exportPdf($id)
    {
        $school = School::findOrFail($id);
        $students = $school->students()
                           ->with('program')
                           ->where('is_active', true)
                           ->orderBy('name')
                           ->get();

        return view('pages.admins.schools.print_pdf', compact('school', 'students'));
    }
}
