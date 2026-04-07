<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <--- WAJIB DITAMBAHKAN: Untuk validasi kustom

class ProgramController extends Controller
{
    // 1. INDEX (Tabel Daftar Program)
    public function index(Request $request)
    {
        // 1. Ambil data sekolah untuk Dropdown Filter
        $schools = School::orderBy('name', 'asc')->get();

        // 2. Query Dasar
        $query = Program::with('school');

        // 3. Logic Filter: Sekolah
        if ($request->has('school_id') && $request->school_id != '') {
            $query->where('school_id', $request->school_id);
        }

        // 4. Logic Filter: Tipe Pembayaran
        if ($request->has('type') && $request->type != '') {
            $query->where('payment_type', $request->type);
        }

        // 5. Logic Search: Nama Program
        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        // 6. Eksekusi dengan Pagination
        $programs = $query->latest()->paginate(10)->withQueryString();

        return view('pages.admins.programs.index', compact('programs', 'schools'));
    }

    // 2. CREATE (Form Tambah)
    public function create()
    {
        $schools = School::orderBy('name')->get();
        return view('pages.admins.programs.create', compact('schools'));
    }

    // 3. STORE (Proses Simpan)
    public function store(Request $request)
    {
        $request->validate([
            'school_id'     => 'required|exists:schools,id',
            'name'          => [
                'required',
                'string',
                'max:255',
                // VALIDASI UNIK: Cek nama program, TAPI hanya di sekolah yang dipilih
                Rule::unique('programs')->where(function ($query) use ($request) {
                    return $query->where('school_id', $request->school_id);
                }),
            ],
            'payment_type'  => 'required|string',
            'price'         => 'required|numeric|min:0',
            'school_fee'    => 'required|numeric|min:0',
        ], [
            // Pesan Error Khusus
            'name.unique' => 'Program dengan nama ini sudah terdaftar di sekolah tersebut.',
        ]);

        Program::create($request->all());

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program sekolah berhasil dibuat.');
    }

    // 4. SHOW (Detail Program)
    public function show(Program $program)
    {
        $program->load('school');
        return view('pages.admins.programs.show', compact('program'));
    }

    // 5. EDIT (Form Edit)
    public function edit(Program $program)
    {
        $schools = School::orderBy('name')->get();
        return view('pages.admins.programs.edit', compact('program', 'schools'));
    }

    // 6. UPDATE (Proses Update)
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'school_id'     => 'required|exists:schools,id',
            'name'          => [
                'required',
                'string',
                'max:255',
                // VALIDASI UNIK SAAT EDIT: Abaikan ID program ini sendiri agar tidak error saat save diri sendiri
                Rule::unique('programs')->where(function ($query) use ($request) {
                    return $query->where('school_id', $request->school_id);
                })->ignore($program->id),
            ],
            'payment_type'  => 'required|string',
            'price'         => 'required|numeric|min:0',
            'school_fee'    => 'required|numeric|min:0',
        ], [
            'name.unique' => 'Program dengan nama ini sudah terdaftar di sekolah tersebut.',
        ]);

        $program->update($request->all());

        return redirect()->route('admin.programs.index')
            ->with('success', 'Data program berhasil diperbarui.');
    }

    // 7. DESTROY (Hapus)
    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }
}
