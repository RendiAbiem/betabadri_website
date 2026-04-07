<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerAdminController extends Controller
{
    public function index()
    {
        // Ambil data pelamar terbaru
        $applicants = Career::latest()->get();
        return view('pages/admins.careers.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = Career::findOrFail($id);

        // Ubah status jadi 'reviewed' jika dibuka
        if($applicant->status == 'pending'){
            $applicant->update(['status' => 'reviewed']);
        }

        return view('pages/admins.careers.show', compact('applicant'));
    }

    public function destroy($id)
    {
        $applicant = Career::findOrFail($id);

        // Hapus file CV dari storage
        if ($applicant->cv_path) {
            Storage::disk('public')->delete($applicant->cv_path);
        }

        $applicant->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Data pelamar berhasil dihapus');
    }
}
