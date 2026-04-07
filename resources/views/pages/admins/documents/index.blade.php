@extends('layouts.admins')

@section('title', 'Pusat Dokumen (E-Archive)')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">Pusat Dokumen</h4>
        <p class="text-secondary small mb-0">Arsip digital, laporan, dan catatan operasional dalam bentuk sticky notes.</p>
    </div>
    <div>
        <button class="btn btn-primary fw-bold shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-plus me-2"></i> Buat Catatan Baru
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

{{-- FILTER KATEGORI --}}
<div class="d-flex flex-wrap gap-2 mb-4 pb-3 border-bottom border-secondary border-opacity-25">
    <a href="{{ route('admin.documents.index') }}" class="btn btn-sm rounded-pill {{ !request('category') ? 'btn-light text-dark fw-bold' : 'btn-outline-secondary text-white' }}">Semua Catatan</a>

    @php $categories = ['Laporan', 'SOP', 'Legal', 'Media', 'Lainnya']; @endphp
    @foreach($categories as $cat)
        <a href="{{ route('admin.documents.index', ['category' => $cat]) }}"
           class="btn btn-sm rounded-pill {{ request('category') == $cat ? 'btn-light text-dark fw-bold' : 'btn-outline-secondary text-white' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>

{{-- GRID TAMPILAN STICKY NOTES --}}
<div class="row g-4">
    @forelse($documents as $doc)
        @php
            // Mapping warna sticky note
            $colors = [
                'yellow' => ['bg' => '#fef3c7', 'text' => '#92400e', 'border' => '#fcd34d', 'badge' => '#fbbf24'],
                'blue'   => ['bg' => '#e0f2fe', 'text' => '#075985', 'border' => '#bae6fd', 'badge' => '#7dd3fc'],
                'green'  => ['bg' => '#dcfce7', 'text' => '#166534', 'border' => '#bbf7d0', 'badge' => '#86efac'],
                'red'    => ['bg' => '#fee2e2', 'text' => '#991b1b', 'border' => '#fecaca', 'badge' => '#fca5a5'],
            ];
            $style = $colors[$doc->color] ?? $colors['yellow'];

            // Logika Icon File
            $ext = strtolower($doc->file_type);
            $icon = 'fa-file-alt';
            if(in_array($ext, ['pdf'])) $icon = 'fa-file-pdf';
            elseif(in_array($ext, ['doc', 'docx'])) $icon = 'fa-file-word';
            elseif(in_array($ext, ['xls', 'xlsx'])) $icon = 'fa-file-excel';
            elseif(in_array($ext, ['png', 'jpg', 'jpeg'])) $icon = 'fa-file-image';
            elseif(in_array($ext, ['zip', 'rar'])) $icon = 'fa-file-archive';
        @endphp

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="sticky-note p-4 shadow-sm position-relative"
                 style="background-color: {{ $style['bg'] }}; border-left: 6px solid {{ $style['border'] }};">

                {{-- Pin Decor --}}
                <div class="position-absolute top-0 start-50 translate-middle">
                    <i class="fas fa-thumbtack text-danger opacity-75 shadow-sm" style="font-size: 1.1rem;"></i>
                </div>

                {{-- Judul & Badge --}}
                <div class="mb-3">
                    <span class="badge rounded-pill mb-2" style="background-color: {{ $style['badge'] }}; color: {{ $style['text'] }}; font-size: 0.6rem; letter-spacing: 0.5px;">
                        {{ strtoupper($doc->category) }}
                    </span>
                    <h6 class="fw-bold mb-1" style="color: {{ $style['text'] }}; line-height: 1.4;">
                        {{ $doc->title }}
                    </h6>
                </div>

                {{-- Isi Catatan / Deskripsi --}}
                <div class="mb-4" style="color: {{ $style['text'] }}; opacity: 0.85; font-size: 0.85rem; font-style: italic; min-height: 50px;">
                    {!! nl2br(e($doc->description)) ?: 'Tidak ada deskripsi tambahan.' !!}
                </div>

                {{-- Lampiran & Aksi --}}
                <div class="mt-auto pt-3 border-top border-dark border-opacity-10 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        <i class="fas {{ $icon }} me-2 fs-5" style="color: {{ $style['text'] }};"></i>
                        <span class="x-small fw-bold text-uppercase text-truncate" style="color: {{ $style['text'] }}; max-width: 80px;">
                            .{{ $doc->file_type }}
                        </span>
                    </div>

                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.documents.download', $doc->id) }}" class="btn btn-sm p-1" title="Unduh Lampiran" style="color: {{ $style['text'] }};">
                            <i class="fas fa-download"></i>
                        </a>

                        @if(auth()->user()->role === 'admin' || $doc->user_id === auth()->id())
                        <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm p-1" style="color: {{ $style['text'] }};" onclick="return confirm('Hapus catatan ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="position-absolute bottom-0 end-0 p-2 opacity-50" style="font-size: 0.6rem; color: {{ $style['text'] }};">
                    {{ $doc->created_at->format('d/m/y') }}
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="opacity-25 text-white">
                <i class="fas fa-sticky-note fa-4x mb-3"></i>
                <h6>Belum ada catatan yang ditempel.</h6>
            </div>
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
<div class="mt-5">
    {{ $documents->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

{{-- MODAL UPLOAD --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
            <div class="modal-header border-bottom border-secondary border-opacity-25 p-4">
                <h5 class="modal-title text-white fw-bold"><i class="fas fa-pen-fancy text-primary me-2"></i> Tulis Catatan Dokumen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="text-white-50 small text-uppercase fw-bold mb-2">Pilih Warna Note</label>
                        <div class="d-flex gap-3 align-items-center bg-dark bg-opacity-50 p-3 rounded border border-secondary border-opacity-25">
                            <label class="color-option">
                                <input type="radio" name="color" value="yellow" checked>
                                <span class="dot" style="background-color: #fcd34d;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="color" value="blue">
                                <span class="dot" style="background-color: #7dd3fc;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="color" value="green">
                                <span class="dot" style="background-color: #86efac;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="color" value="red">
                                <span class="dot" style="background-color: #fca5a5;"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-white-50 small text-uppercase fw-bold mb-2">Judul Catatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-dark" placeholder="Judul singkat..." required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="text-white-50 small text-uppercase fw-bold mb-2">Kategori <span class="text-danger">*</span></label>
                            <select name="category" class="form-control form-control-dark" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="text-white-50 small text-uppercase fw-bold mb-2">File Lampiran <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control form-control-dark text-secondary" required>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-white-50 small text-uppercase fw-bold mb-2">Isi Catatan</label>
                        <textarea name="description" class="form-control form-control-dark" rows="4" placeholder="Tulis instruksi atau keterangan dokumen di sini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-25 p-4">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">Tempel Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .sticky-note {
        min-height: 250px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: default;
        transform: rotate(-1deg);
    }

    .sticky-note:nth-child(even) { transform: rotate(1.5deg); }
    .sticky-note:nth-child(3n) { transform: rotate(-1.2deg); }

    .sticky-note:hover {
        transform: rotate(0deg) scale(1.05) !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.3) !important;
        z-index: 5;
    }

    .sticky-note::after {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        border-width: 15px 15px 0 0;
        border-style: solid;
        border-color: rgba(0,0,0,0.08) #0f172a;
        display: block;
        width: 0;
    }

    /* Color Radio Options */
    .color-option { cursor: pointer; }
    .color-option input { display: none; }
    .color-option .dot {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: 3px solid transparent;
        transition: all 0.2s;
    }
    .color-option input:checked + .dot {
        border-color: #fff;
        transform: scale(1.2);
    }
</style>

@endsection
