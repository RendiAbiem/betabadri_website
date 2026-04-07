<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('user')->latest();

        // Fitur filter kategori
        if ($request->category) {
            $query->where('category', $request->category);
        }

        $documents = $query->paginate(12);
        return view('pages.admins.documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,jpg,png|max:10240', // Maks 10MB
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        Document::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => round($file->getSize() / 1024), // Simpan dalam bentuk KB
            'description' => $request->description,
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

    // FUNGSI UNTUK MENDOWNLOAD FILE
    public function download($id)
    {
        $document = Document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file_path)) {
            // Nama file saat didownload (Judul + Ekstensi Asli)
            $downloadName = $document->title . '.' . $document->file_type;

            // Dapatkan path absolute dari folder storage
            $absolutePath = storage_path('app/public/' . $document->file_path);

            // Gunakan response()->download() agar VS Code tidak menampilkan error
            return response()->download($absolutePath, $downloadName);
        }

        return back()->with('error', 'File fisik tidak ditemukan di server.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Hapus fisik
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        // Hapus database
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
