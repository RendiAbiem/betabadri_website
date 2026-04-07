@extends('layouts.admins')

@section('title', 'Edit Partner')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-white fw-bold">Edit Partner</h4>
        <p class="text-secondary small mb-0">Perbarui data kerjasama mitra.</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="content-card">
            <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Partner <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control form-control-dark @error('name') is-invalid @enderror"
                           value="{{ old('name', $partner->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Logo Saat Ini</label>
                    <div class="p-3 bg-white rounded border d-flex align-items-center justify-content-center" style="height: 120px; width: 100%;">
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="Current Logo" class="img-fluid" style="max-height: 90px;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Ganti Logo (Opsional)</label>
                    <input type="file" name="logo"
                           class="form-control form-control-dark text-sm @error('logo') is-invalid @enderror"
                           accept="image/*">

                    <div class="text-white-50 small fst-italic mt-1">
                        <i class="fas fa-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengubah logo.
                    </div>

                    @error('logo')
                        <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
