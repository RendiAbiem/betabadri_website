<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Program;
use App\Models\Student;
use App\Models\StudentGrade;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    // 1. HALAMAN LIST RIWAYAT PENILAIAN
    public function index()
    {
        // Menampilkan riwayat penilaian yang pernah dibuat oleh mentor ini
        $grades = StudentGrade::with(['student.school', 'program'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.mentors.grades.index', compact('grades'));
    }

    // 2. FORM INPUT NILAI (FILTER SEKOLAH & PROGRAM DULU)
    public function create(Request $request)
    {
        $schools = School::orderBy('name')->get();
        $programs = Program::all();

        $students = [];
        // Jika User sudah memilih Sekolah & Program, ambil datanya
        if($request->has('school_id') && $request->has('program_id')) {
            $students = Student::where('school_id', $request->school_id)
                        ->where('program_id', $request->program_id)
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get();
        }

        return view('pages.mentors.grades.create', compact('schools', 'programs', 'students'));
    }

    // 3. PROSES SIMPAN NILAI
    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'program_id' => 'required',
            'project_name' => 'required|string', // Contoh: "Ujian Akhir Semester" atau "Project Line Follower"
            'grades' => 'required|array', // Array nilai per siswa
        ]);

        foreach ($request->grades as $studentId => $data) {
            // Kita gunakan create agar setiap project tercatat terpisah
            // Atau bisa updateOrCreate jika ingin revisi nilai project yang sama
            StudentGrade::create([
                'user_id' => Auth::id(),
                'student_id' => $studentId,
                'program_id' => $request->program_id,
                'project_name' => $request->project_name,
                'score_attitude' => $data['attitude'] ?? 0,
                'score_skill' => $data['skill'] ?? 0,
                'score_knowledge' => $data['knowledge'] ?? 0,
                'notes' => $data['notes'] ?? null,
            ]);
        }

        return redirect()->route('mentor.grades.index')->with('success', 'Nilai project berhasil disimpan!');
    }
}
