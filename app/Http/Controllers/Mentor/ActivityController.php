<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Program;
use App\Models\Student;
use App\Models\TeachingJournal;
use App\Models\StudentAttendance;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    // 1. FORM INPUT JURNAL & ABSEN
    public function create(Request $request)
    {
        // Mentor pilih Sekolah & Kelas dulu untuk memunculkan list siswa
        $schools = School::orderBy('name')->get();
        $programs = Program::all();

        $students = [];
        if($request->has('school_id') && $request->has('program_id')) {
            $students = Student::where('school_id', $request->school_id)
                        ->where('program_id', $request->program_id)
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get();
        }

        return view('pages.mentors.activity.create', compact('schools', 'programs', 'students'));
    }

    // 2. SIMPAN DATA (MATERI + ABSENSI)
    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'program_id' => 'required',
            'date' => 'required|date',
            'topic' => 'required|string',
            'attendance' => 'required|array',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi Foto
        ]);

        // 1. Upload Foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Simpan ke folder public/storage/journals
            $photoPath = $request->file('photo')->store('journals', 'public');
        }

        // 2. Simpan Jurnal
        $journal = TeachingJournal::create([
            'user_id' => Auth::id(),
            'school_id' => $request->school_id,
            'program_id' => $request->program_id,
            'class_name' => $request->class_name ?? 'General',
            'date' => $request->date,
            'topic' => $request->topic,
            'notes' => $request->notes,
            'photo_proof' => $photoPath, // <--- Simpan Path Foto
        ]);

        // 3. Simpan Absensi (Sama seperti sebelumnya)
        foreach($request->attendance as $studentId => $status) {
            StudentAttendance::create([
                'teaching_journal_id' => $journal->id,
                'student_id' => $studentId,
                'status' => $status
            ]);
        }

        return redirect()->route('mentor.activity.create')->with('success', 'Laporan, Foto, & Absensi tersimpan!');
    }

    // 3. EXPORT EXCEL (MATERI + KEHADIRAN)
    public function export()
    {
        $fileName = 'laporan-kegiatan-mengajar.csv';

        // Ambil data Absensi beserta Jurnalnya (Materi)
        $data = StudentAttendance::with(['journal.school', 'journal.program', 'journal.mentor', 'student'])
                ->whereHas('journal', function($q) {
                    $q->where('user_id', Auth::id()); // Hanya data mentor yg login
                })
                ->latest()
                ->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($data) {
            $file = fopen('php://output', 'w');

            // Header CSV (Kolom Excel)
            fputcsv($file, [
                'Tanggal',
                'Sekolah',
                'Program',
                'Materi Pembelajaran', // <--- Kolom Materi
                'Nama Siswa',
                'Status Kehadiran'
            ]);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->journal->date,
                    $row->journal->school->name,
                    $row->journal->program->name,
                    $row->journal->topic, // <--- Isi Materi
                    $row->student->name,
                    ucfirst($row->status)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // 4. DAFTAR RIWAYAT MENGAJAR (INDEX)
    public function index()
    {
        $journals = TeachingJournal::with(['school', 'program'])
            ->where('user_id', Auth::id()) // Hanya data mentor ini
            ->latest()
            ->paginate(10);

        return view('pages.mentors.activity.index', compact('journals'));
    }

    // 5. DETAIL JURNAL (SHOW)
    public function show($id)
    {
        // Pastikan hanya pemilik jurnal yang bisa lihat (Security)
        $journal = TeachingJournal::with(['school', 'program', 'attendances.student'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pages.mentors.activity.show', compact('journal'));
    }
}
