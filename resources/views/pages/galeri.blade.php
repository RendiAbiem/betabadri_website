@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('img/galeri-img.jpg') }}'); min-height: 400px;">
    <div class="program-bg-overlay"></div>
    <div class="container position-relative z-2">
        <span class="badge bg-pink-soft text-pink px-3 py-2 rounded-pill mb-3 fw-bold border border-danger" style="color: #ec4899; border-color: #ec4899 !important;" data-aos="fade-down">
            {{ __('Our Documentation') }}
        </span>
        <h1 class="display-3 fw-bold text-white mb-3" data-aos="fade-up">
            {!! __('Gallery Hero Title') !!}
        </h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            {{ __('Gallery Hero Desc') }}
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden" style="min-height: 80vh;">
    <div class="glow-bg-center position-absolute top-50 start-50 translate-middle" style="opacity: 0.3;"></div>

    <div class="container py-5 position-relative z-2">
        {{-- FILTER KATEGORI --}}
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-md-10 text-center">
                <p class="text-white-50 mb-3 small">{{ __('Select Category') }}</p>
                <div class="filter-group d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('public.gallery', ['category' => 'modular']) }}"
                       class="btn btn-filter {{ request('category') == 'modular' ? 'active' : '' }}">
                        <i class="fas fa-robot me-2"></i> {{ __('Modular Robotics') }}
                    </a>
                    <a href="{{ route('public.gallery', ['category' => 'electronic']) }}"
                       class="btn btn-filter {{ request('category') == 'electronic' ? 'active' : '' }}">
                        <i class="fas fa-microchip me-2"></i> {{ __('Electronic Robotics') }}
                    </a>
                    <a href="{{ route('public.gallery', ['category' => 'programming']) }}"
                       class="btn btn-filter {{ request('category') == 'programming' ? 'active' : '' }}">
                        <i class="fas fa-laptop-code me-2"></i> {{ __('Programming') }}
                    </a>
                    <a href="{{ route('public.gallery', ['category' => 'game']) }}"
                       class="btn btn-filter {{ request('category') == 'game' ? 'active' : '' }}">
                        <i class="fas fa-gamepad me-2"></i> {{ __('Game Development') }}
                    </a>
                    <a href="{{ route('public.gallery') }}"
                       class="btn btn-filter {{ !request()->has('category') || request('category') == 'all' ? 'active' : '' }}">
                        <i class="fas fa-layer-group me-2"></i> {{ __('Show All') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- GRID GAMBAR --}}
        <div class="row g-4" data-aos="fade-up">
            @forelse($galleries as $gallery)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="gallery-card">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" loading="lazy">
                    <div class="gallery-overlay">
                        <h6 class="text-white">{{ $gallery->title ?? ucfirst($gallery->category) }}</h6>
                        <div>
                            <span class="badge bg-primary rounded-pill">{{ ucfirst($gallery->category) }}</span>
                        </div>
                        <a href="javascript:void(0);"
                           class="stretched-link"
                           data-bs-toggle="modal"
                           data-bs-target="#imageGalleryModal"
                           data-image="{{ asset('storage/' . $gallery->image) }}"
                           data-title="{{ $gallery->title ?? ucfirst($gallery->category) }}">
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-4x text-white-50" style="opacity: 0.2;"></i>
                <p class="text-white-50 fs-5">{{ __('No photos in this category') }}</p>
            </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if(isset($galleries) && $galleries->hasPages())
        <div class="d-flex flex-column align-items-center mt-5 pt-4 border-top border-secondary">
            <div class="text-secondary small mb-3">
                {{ __('Showing') }} <span class="fw-bold text-white">{{ $galleries->firstItem() }}</span>
                {{ __('to') }} <span class="fw-bold text-white">{{ $galleries->lastItem() }}</span>
                {{ __('of') }} <span class="fw-bold text-white">{{ $galleries->total() }}</span> {{ __('results') }}
            </div>
            <div class="dark-pagination">
                {{ $galleries->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ========================================== --}}
{{-- 3. MODAL PREVIEW GAMBAR BOOTSTRAP --}}
{{-- ========================================== --}}
<div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0 shadow-none">

            {{-- Tombol Close (Silang) --}}
            <div class="position-absolute top-0 end-0 m-3" style="z-index: 1056;">
                 <button type="button" class="btn-close btn-close-white bg-dark rounded-circle p-3 shadow-lg" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center p-0 position-relative d-flex justify-content-center align-items-center" style="min-height: 200px;">

                {{-- Spinner Loading (Optional, akan tertutup jika gambar muncul) --}}
                <div class="spinner-border text-light position-absolute" role="status" id="imageLoadingSpinner">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{-- Gambar akan disuntikkan oleh JavaScript ke sini --}}
                {{-- Tambahkan style background gelap agar kalau gambar transparan terlihat jelas --}}
                <img src="" id="modalDynamicImage" class="img-fluid rounded shadow-lg position-relative z-2" style="max-height: 85vh; object-fit: contain; background: rgba(0,0,0,0.2);" alt="Gallery Preview">

                {{-- Judul Gambar --}}
                <div class="position-absolute bottom-0 start-50 translate-middle-x w-100 p-3 z-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); border-bottom-left-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);">
                    <h5 id="modalDynamicTitle" class="text-white mb-0 fw-bold"></h5>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

{{-- PERBAIKAN LAYOUT SHIFT (PENTING) --}}
@push('styles')
<style>
    /* Memaksa scrollbar selalu muncul untuk mencegah layout bergeser saat modal dibuka */
    html {
        overflow-y: scroll !important;
    }

    /* Style tambahan untuk modal agar lebih rapi */
    #imageGalleryModal .modal-content {
        background-color: transparent !important;
        box-shadow: none !important;
    }

    #modalDynamicImage {
        transition: opacity 0.3s ease-in-out;
    }

    /* Memastikan tombol close terlihat jelas */
    .btn-close-white.bg-dark {
        background-color: rgba(0, 0, 0, 0.5) !important;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .btn-close-white.bg-dark:hover {
        background-color: rgba(0, 0, 0, 0.8) !important;
    }
</style>
@endpush
