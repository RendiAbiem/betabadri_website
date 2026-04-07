<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('pages/admins.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('pages/admins.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', // Validasi Gambar
        ]);

        // Upload Gambar
        $imagePath = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo' => $imagePath,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan');
    }

    public function edit(Partner $partner)
    {
        return view('pages/admins.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Nullable = boleh kosong jika tidak ganti gambar
        ]);

        $data = ['name' => $request->name];

        // Cek jika user upload gambar baru
        if ($request->hasFile('logo')) {
            // 1. Hapus gambar lama
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            // 2. Upload gambar baru
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui');
    }

    public function destroy(Partner $partner)
    {
        // Hapus gambar dari penyimpanan sebelum hapus data
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus');
    }
}
