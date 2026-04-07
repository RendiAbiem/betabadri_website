@extends('layouts.admins')

@section('title', 'Tambah Foto Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-white fw-bold">Tambah Foto</h4>
        <p class="text-secondary small mb-0">Upload dokumentasi baru ke galeri.</p>
    </div>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Judul Foto (Opsional)</label>
                        <input type="text" name="title"
                               class="form-control form-control-dark @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Kegiatan Coding Kelas 7">
                        @error('title')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-white-50 small mb-2">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select form-select-dark @error('category') is-invalid @enderror" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="programming" {{ old('category') == 'programming' ? 'selected' : '' }}>Programming</option>
                            <option value="modular" {{ old('category') == 'modular' ? 'selected' : '' }}>Robotic Modular</option>
                            <option value="electronic" {{ old('category') == 'electronic' ? 'selected' : '' }}>Robotic Electronic</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Upload Foto <span class="text-danger">*</span></label>

                    <div class="border border-secondary border-opacity-25 rounded bg-navy-lighter mb-3 overflow-hidden position-relative d-flex align-items-center justify-content-center"
                         style="height: 250px; width: 100%;">

                        <img id="imgPreview" src="#" alt="Preview" class="w-100 h-100 object-fit-contain d-none" style="z-index: 2;">

                        <div id="placeholderBox" class="text-center">
                            <i class="fas fa-image fa-3x text-secondary opacity-25 mb-3"></i>
                            <p class="text-white-50 small mb-0">Preview foto akan muncul di sini</p>
                        </div>
                    </div>

                    <input type="file" name="image"
                           class="form-control form-control-dark text-sm @error('image') is-invalid @enderror"
                           accept="image/*"
                           onchange="previewGalleryImage(this)" required>

                    @error('image')
                        <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function previewGalleryImage(input) {
        var preview = document.getElementById('imgPreview');
        var placeholder = document.getElementById('placeholderBox');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // Munculkan gambar
                placeholder.classList.add('d-none'); // Sembunyikan ikon
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
