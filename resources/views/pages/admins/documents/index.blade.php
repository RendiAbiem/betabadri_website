@extends('layouts.admins')

@section('title', 'Pusat Dokumen (E-Archive)')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">Pusat Dokumen</h4>
        <p class="text-secondary small mb-0">Arsip digital, laporan, dan dokumen operasional.</p>
    </div>
    <div>
        <button class="btn btn-primary fw-bold shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-cloud-upload-alt me-2"></i> Unggah Dokumen
        </button>
    </div>
</div>

{{-- ALERT NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 p-3 rounded mb-4">
        <h6 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i> Gagal Mengunggah!</h6>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FILTER KATEGORI --}}
<div class="d-flex flex-wrap gap-2 mb-4 pb-3 border-bottom border-secondary border-opacity-25">
    <a href="{{ route('admin.documents.index') }}" class="btn btn-sm rounded-pill {{ !request('category') ? 'btn-light text-dark fw-bold' : 'btn-outline-secondary text-white' }}">Semua Berkas</a>

    @php $categories = ['Laporan', 'SOP', 'Legal', 'Media', 'Lainnya']; @endphp
    @foreach($categories as $cat)
        <a href="{{ route('admin.documents.index', ['category' => $cat]) }}"
           class="btn btn-sm rounded-pill {{ request('category') == $cat ? 'btn-light text-dark fw-bold' : 'btn-outline-secondary text-white' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>

{{-- GRID TAMPILAN DOKUMEN --}}
<div class="row g-3">
    @forelse($documents as $doc)

        {{-- LOGIKA ICON BERDASARKAN EKSTENSI FILE --}}
        @php
            $ext = strtolower($doc->file_type);
            $icon = 'fa-file-alt'; $color = 'text-secondary';

            if(in_array($ext, ['pdf'])) { $icon = 'fa-file-pdf'; $color = 'text-danger'; }
            elseif(in_array($ext, ['doc', 'docx'])) { $icon = 'fa-file-word'; $color = 'text-primary'; }
            elseif(in_array($ext, ['xls', 'xlsx'])) { $icon = 'fa-file-excel'; $color = 'text-success'; }
            elseif(in_array($ext, ['png', 'jpg', 'jpeg'])) { $icon = 'fa-file-image'; $color = 'text-info'; }
            elseif(in_array($ext, ['zip', 'rar'])) { $icon = 'fa-file-archive'; $color = 'text-warning'; }
        @endphp

        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="content-card h-100 p-3 d-flex flex-column transition-hover">

                {{-- Header Card: Icon & Kategori --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="file-icon bg-dark border border-secondary border-opacity-25 rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                        <i class="fas {{ $icon }} {{ $color }} fs-4"></i>
                    </div>
                    <span class="badge bg-dark border border-secondary border-opacity-50 text-secondary x-small">{{ $doc->category }}</span>
                </div>

                {{-- Judul File --}}
                <h6 class="text-white fw-bold mb-1 text-truncate" title="{{ $doc->title }}">{{ $doc->title }}</h6>

                {{-- Info Tambahan --}}
                <div class="text-secondary x-small mb-3">
                    <div class="mb-1"><i class="fas fa-clock me-1 opacity-50"></i> {{ $doc->created_at->format('d M Y, H:i') }}</div>
                    <div class="mb-1"><i class="fas fa-hdd me-1 opacity-50"></i> {{ $doc->file_size }} KB <span class="mx-1">•</span> <span class="text-uppercase">{{ $doc->file_type }}</span></div>
                    <div class="text-info"><i class="fas fa-user me-1 opacity-50"></i> Oleh: {{ explode(' ', trim($doc->user->name))[0] }}</div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-auto d-flex gap-2 pt-3 border-top border-secondary border-opacity-25">
                    {{-- Download --}}
                    <a href="{{ route('admin.documents.download', $doc->id) }}" class="btn btn-sm btn-primary flex-grow-1 fw-bold">
                        <i class="fas fa-download me-1"></i> Unduh
                    </a>

                    {{-- Hapus (Hanya Admin atau Pemilik File) --}}
                    @if(auth()->user()->role === 'admin' || $doc->user_id === auth()->id())
                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini permanen?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Dokumen">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="opacity-50">
                <i class="fas fa-folder-open fa-4x mb-3 text-secondary"></i>
                <h6 class="text-white fw-bold">Belum ada dokumen di kategori ini.</h6>
                <p class="text-secondary small">Klik "Unggah Dokumen" untuk menambahkan file pertama.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $documents->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

{{-- ================================================= --}}
{{-- MODAL UPLOAD DOKUMEN BARU                         --}}
{{-- ================================================= --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #1e293b; border: 1px solid rgba(255,255,255,0.1);">
            <div class="modal-header border-bottom border-secondary border-opacity-25">
                <h5 class="modal-title text-white fw-bold"><i class="fas fa-cloud-upload-alt text-primary me-2"></i> Unggah Berkas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label class="text-secondary small text-uppercase fw-bold mb-2">Nama / Judul Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-dark" placeholder="Contoh: Laporan Keuangan Q1 2026" required>
                    </div>

                    <div class="mb-3">
                        <label class="text-secondary small text-uppercase fw-bold mb-2">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-control form-control-dark" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-secondary small text-uppercase fw-bold mb-2">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control form-control-dark text-secondary" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.jpg,.png" required>
                        <small class="text-muted x-small d-block mt-1">Format: PDF, Word, Excel, ZIP, JPG, PNG. Maks: 10MB.</small>
                    </div>

                    <div class="mb-2">
                        <label class="text-secondary small text-uppercase fw-bold mb-2">Keterangan (Opsional)</label>
                        <textarea name="description" class="form-control form-control-dark" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>

                </div>
                <div class="modal-footer border-top border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Unggah Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover {
        transform: translateY(-5px);
        border-color: rgba(67, 97, 238, 0.4) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
</style>

@endsection
