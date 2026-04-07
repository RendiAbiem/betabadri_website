@extends('layouts.admins')

@section('title', 'Tambah Sekolah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Tambah Sekolah Baru</h4>
        <p class="text-secondary small mb-0">Input data mitra sekolah baru.</p>
    </div>
    <a href="{{ route('admin.schools.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="content-card">
            <form action="{{ route('admin.schools.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control form-control-dark @error('name') is-invalid @enderror"
                           placeholder="Contoh: SMKN 2 Pekanbaru"
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Alamat Lengkap</label>
                    <textarea name="address" class="form-control form-control-dark"
                              rows="3" placeholder="Lokasi Sekolah">{{ old('address') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Nama PIC / Guru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-secondary">
                                <i class="fas fa-user-tie"></i>
                            </span>
                            <input type="text" name="pic_name" class="form-control form-control-dark"
                                   placeholder="Nama Guru" value="{{ old('pic_name') }}">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">WhatsApp PIC</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-success">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <input type="text" name="pic_phone" class="form-control form-control-dark"
                                   placeholder="0812..." value="{{ old('pic_phone') }}">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="content-card border-start border-4 border-primary">
            <h6 class="text-white fw-bold mb-3">Langkah Selanjutnya</h6>
            <p class="text-secondary small">Setelah menyimpan data sekolah ini, silakan menuju menu <strong>Master Harga</strong> untuk membuat program khusus (harga & fee) bagi sekolah ini.</p>
        </div>
    </div>
</div>

@endsection
