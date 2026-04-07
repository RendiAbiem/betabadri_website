@extends('layouts.admins')

@section('title', 'Edit User')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Edit Data Pengguna</h4>
        <p class="text-secondary small mb-0">Perbarui profil, hak akses, atau reset kata sandi akun.</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               class="form-control form-control-dark @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email"
                               class="form-control form-control-dark @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Role (Hak Akses) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select form-select-dark" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Super User)</option>
                            <option value="mentor" {{ $user->role == 'mentor' ? 'selected' : '' }}>Mentor (Pengajar)</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff (Mr. Puja / Office)</option>
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Siswa</option>
                        </select>
                    </div>
                </div>

                <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info mb-4" style="border-left: 4px solid #0dcaf0 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock me-3 fa-lg"></i>
                        <div>
                            <strong class="d-block mb-1">Keamanan Akun</strong>
                            <p class="small mb-0">Kosongkan kolom di bawah jika tidak ingin mengubah kata sandi.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-navy-lighter border-secondary border-opacity-25 text-secondary">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="password" name="password"
                                   class="form-control form-control-dark @error('password') is-invalid @enderror"
                                   placeholder="Minimal 8 karakter">
                        </div>
                        @error('password')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-navy-lighter border-secondary border-opacity-25 text-secondary">
                                <i class="fas fa-shield-check"></i>
                            </span>
                            <input type="password" name="password_confirmation"
                                   class="form-control form-control-dark"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
