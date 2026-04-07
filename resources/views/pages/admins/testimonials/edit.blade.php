@extends('layouts.admins')

@section('title', 'Edit Testimonial')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Edit Testimonial</h4>
        <p class="text-secondary small mb-0">Perbarui data ulasan dari siswa atau mitra.</p>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="content-card p-4">
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- NAMA LENGKAP --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-dark"
                           value="{{ old('name', $testimonial->name) }}" required>
                </div>

                {{-- ROLE & JABATAN --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Kategori (Role) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select form-select-dark" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Siswa" {{ old('role', $testimonial->role) == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="Sekolah" {{ old('role', $testimonial->role) == 'Sekolah' ? 'selected' : '' }}>Pihak Sekolah</option>
                            <option value="Orang Tua" {{ old('role', $testimonial->role) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Jabatan / Detail <span class="text-secondary x-small">(Opsional)</span></label>
                        <input type="text" name="position" class="form-control form-control-dark"
                               value="{{ old('position', $testimonial->position) }}"
                               placeholder="Cth: Kelas 12 IPA atau Kepala Sekolah">
                    </div>
                </div>

                {{-- ASAL SEKOLAH (TAMBAHAN BARU) --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Asal Sekolah <span class="text-secondary x-small">(Opsional - Jika terkait mitra)</span></label>
                    <select name="school_id" class="form-select form-select-dark">
                        <option value="">-- Tidak Terikat Sekolah Mitra --</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ (old('school_id') ?? $testimonial->school_id) == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ISI ULASAN --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Isi Ulasan <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control form-control-dark" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
                </div>

                {{-- FOTO PROFIL --}}
                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Foto Profil</label>

                    @if($testimonial->photo)
                        <div class="d-flex align-items-center gap-3 mb-3 p-2 border border-secondary border-opacity-25 rounded bg-navy-lighter">
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Foto Lama" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                            <div>
                                <small class="text-secondary d-block">Foto saat ini</small>
                                <span class="text-white x-small fst-italic">Biarkan kosong jika tidak ingin mengubah foto.</span>
                            </div>
                        </div>
                    @endif

                    <input type="file" name="photo" class="form-control form-control-dark text-secondary" accept="image/*">
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="d-flex justify-content-end pt-3 border-top border-secondary border-opacity-25">
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
