@extends('layouts.admins')

@section('title', 'Edit Sekolah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Edit Data Sekolah</h4>
        <p class="text-secondary small mb-0">Update informasi dasar sekolah.</p>
    </div>
    <a href="{{ route('admin.schools.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="content-card">
            <form action="{{ route('admin.schools.update', $school->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control form-control-dark @error('name') is-invalid @enderror"
                           value="{{ old('name', $school->name) }}" required>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Alamat Lengkap</label>
                    <textarea name="address" class="form-control form-control-dark"
                              rows="3">{{ old('address', $school->address) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Nama PIC</label>
                        <input type="text" name="pic_name" class="form-control form-control-dark"
                               value="{{ old('pic_name', $school->pic_name) }}">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">WhatsApp PIC</label>
                        <input type="text" name="pic_phone" class="form-control form-control-dark"
                               value="{{ old('pic_phone', $school->pic_phone) }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <a href="{{ route('admin.schools.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="content-card border-start border-4 border-warning mb-3">
            <h6 class="text-white fw-bold mb-3">Manajemen Program</h6>
            <p class="text-secondary small mb-3">
                Ingin menambah atau mengubah harga program untuk sekolah ini?
            </p>
            <a href="{{ route('admin.programs.create') }}" class="btn btn-sm btn-warning w-100 text-dark fw-bold">
                <i class="fas fa-plus-circle me-2"></i> Buat Program Baru
            </a>
            <div class="mt-2 text-center">
                <a href="{{ route('admin.programs.index') }}" class="text-secondary small text-decoration-none">
                    Lihat Daftar Program
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
