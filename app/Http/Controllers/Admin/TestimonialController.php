<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\School; // <-- PASTIKAN IMPORT MODEL SCHOOL
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Import Storage untuk hapus foto lama

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::with('school');

        // Jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%')
                  ->orWhereHas('school', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Pertahankan parameter pencarian pada pagination
        $testimonials = $query->latest()->paginate(9)->appends($request->query());

        return view('pages.admins.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        // Ambil data sekolah urut abjad untuk ditampilkan di dropdown
        $schools = School::orderBy('name', 'asc')->get();
        return view('pages/admins.testimonials.create', compact('schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Siswa,Sekolah,Orang Tua', // Validasi Dropdown
            'position' => 'nullable|string|max:255', // Jabatan opsional
            'school_id' => 'nullable|exists:schools,id', // <-- Validasi Asal Sekolah
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto Logic (Jika ada)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create([
            'name' => $request->name,
            'role' => $request->role,
            'position' => $request->position,
            'school_id' => $request->school_id, // <-- Simpan school_id
            'content' => $request->input('content'),
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Cari data berdasarkan ID, jika tidak ada maka akan error 404 di sini (bukan saat disubmit)
        $testimonial = Testimonial::findOrFail($id);

        $schools = School::orderBy('name', 'asc')->get();
        return view('pages.admins.testimonials.edit', compact('testimonial', 'schools'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id); // Tambahkan baris ini

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Siswa,Sekolah,Orang Tua',
            'position' => 'nullable|string|max:255',
            'school_id' => 'nullable|exists:schools,id',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'position' => $request->position,
            'school_id' => $request->school_id,
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('photo')) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id); // Tambahkan baris ini

        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimoni berhasil dihapus');
    }
}
