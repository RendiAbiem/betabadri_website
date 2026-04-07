<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'email'      => 'required|email',
            'phone'      => 'required|numeric',
            'cv'         => 'required|mimes:pdf,doc,docx|max:2048', // Wajib PDF/Doc, Max 2MB
            'message'    => 'nullable|string',
        ]);

        // 2. Upload File CV
        // File akan disimpan di storage/app/public/cvs
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // 3. Simpan ke Database
        Career::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'cv_path'    => $cvPath,
            'message'    => $request->message,
        ]);

        // 4. Redirect Kembali dengan Pesan Sukses
        return redirect()->back()->with('success', 'Lamaran Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
