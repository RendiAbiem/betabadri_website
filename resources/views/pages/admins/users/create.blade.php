@extends('layouts.admins')

@section('title', 'Tambah User Baru')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Tambah User Baru</h4>
        <p class="text-secondary small mb-0">Buat akun untuk Admin, Mentor, atau Staff.</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="content-card p-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-dark"
                           placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-dark"
                               placeholder="email@sekolah.com" value="{{ old('email') }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Role (Hak Akses) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select form-select-dark" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor (Pengajar)</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr class="border-secondary opacity-25 my-4">
                <p class="text-info x-small mb-3"><i class="fas fa-lock me-1"></i> Keamanan Akun</p>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control form-control-dark"
                               placeholder="Minimal 8 karakter" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control form-control-dark"
                               placeholder="Ketik ulang password" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan User Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
