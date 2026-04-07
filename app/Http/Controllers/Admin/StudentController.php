<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\School; // Jangan lupa import School
use App\Models\Program; // <--- 1. JANGAN LUPA IMPORT INI
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // 1. QUERY UTAMA (Data Tabel)
        $query = Student::with(['school', 'program']);

        // 2. LOGIC PENCARIAN
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;

            // Menggunakan grouping function($q) agar logika OR tidak bocor jika nanti ada filter lain
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%') // Opsional jika punya kolom nisn
                ->orWhereHas('school', function($subQ) use ($search) {
                    $subQ->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        // 3. QUERY STATISTIK (Untuk Card di Atas)
        // Hitung langsung dari database agar akurat
        $totalStudents = Student::count();
        $activeStudents = Student::where('is_active', 1)->count();
        $alumniStudents = Student::where('is_active', 0)->count(); // Asumsi 0 = Alumni/Non-aktif

        // Menghitung jumlah sekolah unik yang memiliki siswa terdaftar
        $totalSchools = Student::distinct('school_id')->count('school_id');

        return view('pages.admins.students.index', compact(
            'students',
            'totalStudents',
            'activeStudents',
            'alumniStudents',
            'totalSchools'
        ));
    }

    public function create()
    {
        // Kita butuh daftar sekolah untuk dropdown
        $schools = School::orderBy('name')->get();
        $programs = Program::all(); // <--- 2. AMBIL DATA PROGRAM

        return view('pages/admins.students.create', compact('schools', 'programs'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Masal
        // Perhatikan: 'inputs.*.name' artinya memvalidasi array input
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'program_id' => 'required|exists:programs,id',
            'inputs.*.name' => 'required|string|max:255',
            'inputs.*.class_name' => 'required|string|max:50',
            'inputs.*.gender' => 'required|in:L,P',
        ]);

        try {
            // Gunakan Transaction agar jika 1 gagal, semua batal (aman)
            \DB::beginTransaction();

            // 2. Loop data array dari form
            foreach ($request->inputs as $key => $value) {Student::create([
                    'school_id' => $request->school_id, // Data dari select box atas
                    'program_id' => $request->program_id, // Data dari select box atas
                    'name' => $value['name'],       // Data dari baris tabel
                    'class_name' => $value['class_name'],
                    'gender' => $value['gender'],
                    'is_active' => 1,
                ]);
            }

            \DB::commit();

            // 3. INI BAGIAN REDIRECTNYA
            // Pastikan mengarah ke route index (List Siswa)
            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil disimpan!');

        } catch (\Exception $e) {
            \DB::rollBack();
            // Jika error, kembalikan ke form agar user tau
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(Student $student)
    {
        $schools = School::orderBy('name')->get();

        // Ambil program HANYA dari sekolah siswa saat ini
        $programs = Program::where('school_id', $student->school_id)->get();

        return view('pages.admins.students.edit', compact('student', 'schools', 'programs'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
                'school_id' => 'required|exists:schools,id',
                'program_id' => 'required|exists:programs,id', // <--- 5. VALIDASI UPDATE
                'name' => 'required|string|max:255',
                'class_name' => 'required|string|max:50', // <--- Validasi Kelas
                'nisn' => 'nullable|numeric|unique:students,nisn,' . $student->id,
                'gender' => 'required|in:L,P',
                'is_active' => 'required|boolean'
            ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Data siswa diperbarui');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Data siswa dihapus');
    }
}
