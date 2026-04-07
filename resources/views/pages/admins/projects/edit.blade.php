@extends('layouts.admins')

@section('title', 'Edit Project Program')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Project</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="admin-card">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Judul Project/Level <span class="text-danger">*</span></label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $project->title) }}" required>
                @error('title')
                    <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Kategori Program <span class="text-danger">*</span></label>
                <select name="category" class="form-control @error('category') is-invalid @enderror" required style="background:#0B0A1D; color:white;">
                    <option value="" disabled>-- Pilih Kategori --</option>
                    <option value="modular" {{ old('category', $project->category) == 'modular' ? 'selected' : '' }}>Robotic Modular</option>
                    <option value="electronic" {{ old('category', $project->category) == 'electronic' ? 'selected' : '' }}>Robotic Electronic</option>
                    <option value="programming" {{ old('category', $project->category) == 'programming' ? 'selected' : '' }}>Programming</option>
                </select>
                @error('category')
                    <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
            <textarea name="description" rows="3"
                      class="form-control @error('description') is-invalid @enderror"
                      required>{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Detail (Poin Pembelajaran) <span class="text-danger">*</span></label>
            <textarea name="details" rows="6"
                      class="form-control @error('details') is-invalid @enderror"
                      placeholder="Pisahkan setiap poin dengan Enter (Baris Baru)" required>{{ old('details', $project->details) }}</textarea>
            <div class="form-text text-secondary small mt-1">
                <i class="fas fa-info-circle me-1"></i> Gunakan tombol <strong>Enter</strong> untuk membuat baris baru (list item).
            </div>
            @error('details')
                <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Gambar Background</label>

            <div class="mb-3 p-2 d-inline-block border border-secondary rounded" style="background: #1a1a1e;">
                <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image" style="height: 100px; width: auto; border-radius: 4px;">
                <div class="text-center text-secondary small mt-1">Gambar Saat Ini</div>
            </div>

            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            <div class="form-text text-secondary small">Biarkan kosong jika tidak ingin mengganti gambar. Max: 2MB.</div>
            @error('image')
                <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Update Project
            </button>
        </div>
    </form>
</div>

@endsection
