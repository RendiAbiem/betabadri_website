@extends('layouts.admins')

@section('title', 'Tambah Project Program')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Tambah Project</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="admin-card">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Judul Project/Level <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: Level 1: Beginner" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kategori Program <span class="text-danger">*</span></label>
                <select name="category" class="form-control" required style="background:#0B0A1D; color:white;">
                    <option value="modular">Robotic Modular</option>
                    <option value="electronic">Robotic Electronic</option>
                    <option value="programming">Programming</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Detail (Poin Pembelajaran) <span class="text-danger">*</span></label>
            <textarea name="details" rows="5" class="form-control" placeholder="Pisahkan setiap poin dengan Enter (Baris Baru)" required></textarea>
            <div class="form-text text-secondary">Gunakan Enter untuk membuat list item baru.</div>
        </div>

        <div class="mb-4">
            <label class="form-label">Gambar Background <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <div class="text-end border-top border-secondary pt-3">
            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
