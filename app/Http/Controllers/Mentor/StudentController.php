<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // 1. FORM INPUT MASAL
    public function create()
    {
        // Mentor hanya perlu pilih Sekolah & Program (Konteks Kelas)
        $schools = School::orderBy('name')->get();
        $programs = Program::all();

        return view('pages.mentors.students.create', compact('schools', 'programs'));
    }

    // 2. PROSES SIMPAN BANYAK SEKALIGUS
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'program_id' => 'required|exists:programs,id',
            'inputs.*.name' => 'required|string|max:255',
            'inputs.*.class_name' => 'required|string|max:50',
            'inputs.*.gender' => 'required|in:L,P',
        ]);

        try {
            DB::beginTransaction();

            // 2. Loop data dari input masal
            foreach ($request->inputs as $input) {
                Student::create([
                    'school_id' => $request->school_id,
                    'program_id' => $request->program_id,
                    'name' => $input['name'],
                    'class_name' => $input['class_name'],
                    'gender' => $input['gender'],
                    'status' => 'active', // Default status
                ]);
            }

            DB::commit();

            // --- DISINI KUNCINYA ---
            // Redirect ke halaman List Siswa (Index) setelah berhasil
            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil ditambahkan secara masal.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
