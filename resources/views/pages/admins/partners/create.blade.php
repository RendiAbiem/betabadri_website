@extends('layouts.admins')

@section('title', 'Tambah Partner')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-white fw-bold">Tambah Partner</h4>
        <p class="text-secondary small mb-0">Tambahkan partner kerjasama baru.</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="content-card">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Partner <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control form-control-dark @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Contoh: PT. Teknologi Maju" required>
                    @error('name')
                        <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Upload Logo <span class="text-danger">*</span></label>

                    <div class="p-3 bg-white rounded mb-2 d-flex align-items-center justify-content-center border" style="height: 120px; width: 100%;">
                        <img id="logoPreview" src="#" alt="Preview Logo" class="img-fluid d-none" style="max-height: 100px;">
                        <span id="placeholderText" class="text-muted small">Preview logo akan muncul di sini</span>
                    </div>

                    <input type="file" name="logo"
                           class="form-control form-control-dark text-sm @error('logo') is-invalid @enderror"
                           accept="image/*"
                           onchange="previewLogo(this)" required>

                    <div class="text-white-50 small fst-italic mt-1">
                        <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG, SVG. Maks 2MB.
                    </div>

                    @error('logo')
                        <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function previewLogo(input) {
        var preview = document.getElementById('logoPreview');
        var placeholder = document.getElementById('placeholderText');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if(placeholder) placeholder.classList.add('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
