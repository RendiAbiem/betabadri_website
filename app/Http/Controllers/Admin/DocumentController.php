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

        // Fitur pencarian judul atau kategori
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        // Fitur filter kategori (tetap dipertahankan untuk link pill)
        if ($request->category) {
            $query->where('category', $request->category);
        }

        $documents = $query->paginate(12);

        // Mengambil daftar kategori unik untuk ditampilkan di filter/pill
        $uniqueCategories = Document::select('category')->distinct()->pluck('category');

        return view('pages.admins.documents.index', compact('documents', 'uniqueCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,jpg,png,jpeg|max:10240', // File opsional (nullable)
            'color' => 'nullable|string|in:yellow,blue,green,red',
            'description' => 'nullable|string',
        ]);

        // Siapkan data dasar
        $data = [
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'color'       => $request->color ?? 'yellow',
            'description' => $request->description,
        ];

        // Logika jika ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('documents', 'public');

            $data['file_path'] = $path;
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = round($file->getSize() / 1024); // Simpan dalam KB
        }

        Document::create($data);

        return back()->with('success', 'Catatan berhasil ditempel!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'color' => 'required|in:yellow,blue,green,red',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,jpg,png,jpeg|max:10240',
        ]);

        $document = Document::findOrFail($id);

        // Pastikan hanya pemilik atau admin yang bisa edit
        if (auth()->user()->role !== 'admin' && $document->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengubah catatan ini.');
        }

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'color' => $request->color,
            'description' => $request->description,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada file baru yang diupload
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('documents', 'public');
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = round($file->getSize() / 1024);
        }

        $document->update($data);

        return back()->with('success', 'Catatan berhasil diperbarui!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);

        // Cek apakah file_path ada (karena sekarang file bersifat opsional)
        if (!$document->file_path) {
            return back()->with('error', 'Catatan ini tidak memiliki lampiran file.');
        }

        if (Storage::disk('public')->exists($document->file_path)) {
            $downloadName = $document->title . '.' . $document->file_type;
            $absolutePath = storage_path('app/public/' . $document->file_path);

            return response()->download($absolutePath, $downloadName);
        }

        return back()->with('error', 'File fisik tidak ditemukan di server.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Hapus fisik jika ada
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Catatan berhasil dihapus.');
    }
}
