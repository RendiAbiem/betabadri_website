@extends('layouts.admins')

@section('title', 'Tambah Testimonial')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Tambah Testimonial</h4>
        <p class="text-secondary small mb-0">Masukkan ulasan dari siswa, sekolah, atau orang tua.</p>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="content-card p-4">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NAMA LENGKAP --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-dark"
                           placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
                </div>

                {{-- ROLE & JABATAN --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Kategori (Role) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select form-select-dark" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Siswa" {{ old('role') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="Sekolah" {{ old('role') == 'Sekolah' ? 'selected' : '' }}>Pihak Sekolah</option>
                            <option value="Orang Tua" {{ old('role') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Jabatan / Detail <span class="text-secondary x-small">(Opsional)</span></label>
                        <input type="text" name="position" class="form-control form-control-dark"
                               placeholder="Cth: Kelas 12 IPA atau Kepala Sekolah" value="{{ old('position') }}">
                    </div>
                </div>

                {{-- ASAL SEKOLAH (TAMBAHAN BARU) --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Asal Sekolah <span class="text-secondary x-small">(Opsional - Jika terkait mitra)</span></label>
                    <select name="school_id" class="form-select form-select-dark">
                        <option value="">-- Tidak Terikat Sekolah Mitra --</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ISI ULASAN --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Isi Ulasan <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control form-control-dark" rows="4"
                              placeholder="Tuliskan pengalaman atau pendapat mereka..." required>{{ old('content') }}</textarea>
                </div>

                {{-- FOTO PROFIL --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Foto Profil <span class="text-secondary x-small">(Opsional)</span></label>
                    <input type="file" name="photo" class="form-control form-control-dark text-secondary" accept="image/*">
                    <div class="form-text text-secondary x-small mt-1">
                        *Format: JPG, PNG. Maksimal 2MB. Disarankan rasio 1:1 (Kotak).
                    </div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="d-flex justify-content-end pt-3 border-top border-secondary border-opacity-25">
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Testimonial
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- SIDEBAR PANDUAN --}}
    <div class="col-md-4">
        <div class="content-card border-start border-4 border-info">
            <h6 class="text-white fw-bold mb-3">Panduan Pengisian</h6>
            <div class="text-secondary small">
                <ul class="ps-3 mb-0 d-grid gap-2">
                    <li>
                        <strong class="text-info">Role:</strong> Pilih "Sekolah" jika testimonial berasal dari Guru atau Kepala Sekolah.
                    </li>
                    <li>
                        <strong class="text-info">Asal Sekolah:</strong> Pilih nama sekolah dari daftar jika orang tersebut berasal dari sekolah yang sudah bekerjasama dengan kita. Jika umum, biarkan kosong.
                    </li>
                    <li>
                        <strong class="text-info">Jabatan:</strong> Isi detail tambahan spesifik.
                        <br><em>Contoh: "Ketua OSIS" (untuk Siswa) atau "Wali Murid" (untuk Orang Tua).</em>
                    </li>
                    <li>
                        <strong class="text-info">Foto:</strong> Gunakan foto wajah yang jelas agar terlihat lebih profesional di landing page.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
