@extends('layouts.app')

@section('title', 'Apa Kata Mereka - Beta Badri Education')

@section('content')

<section class="testimonials-header-tech position-relative overflow-hidden" style="min-height: 100vh; background-color: #0b1120; padding-bottom: 100px;">
    <div class="tech-grid-overlay"></div>
    <div class="glow-orb-header"></div>

    <div class="container position-relative" style="z-index: 2; padding-top: 5rem;">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-label text-gradient">// SUCCESS STORIES</span>
            <h1 class="display-4 fw-bold text-white mt-3">Cerita Sukses <span class="text-gradient">Kami</span></h1>
            <p class="text-secondary mx-auto fs-5" style="max-width: 600px;">
                Pilih kategori di bawah ini untuk melihat pengalaman nyata dari keluarga besar Beta Badri.
            </p>
        </div>

        {{-- 1. Filter Buttons --}}
        <div class="filter-wrapper mb-5 d-flex justify-content-center flex-wrap gap-2" data-aos="fade-up" data-aos-delay="100">
            <button class="btn-filter-tech" onclick="filterTestimonials('all', this)">Semua Cerita</button>
            <button class="btn-filter-tech" onclick="filterTestimonials('Siswa', this)">Siswa</button>
            <button class="btn-filter-tech" onclick="filterTestimonials('Sekolah', this)">Guru/Sekolah</button>
            <button class="btn-filter-tech" onclick="filterTestimonials('Orang Tua', this)">Orang Tua</button>
        </div>

        {{-- 2. Initial Placeholder (Muncul sebelum filter ditekan) --}}
        <div id="filter-placeholder" class="text-center py-5" data-aos="zoom-in">
            <div class="placeholder-icon mb-4">
                <i class="fas fa-mouse-pointer fa-3x text-primary opacity-50 pulse-animation"></i>
            </div>
            <h4 class="text-white-50 fw-light">Klik salah satu kategori di atas <br>untuk memuat testimonial.</h4>
        </div>

        {{-- 3. Testimonials Grid --}}
        <div class="row g-4 d-none" id="testimonials-grid">
            @forelse($testimonials as $testi)
            <div class="col-md-6 col-lg-4 testimonial-item" data-role="{{ $testi->role }}">
                <article class="testi-card-dark h-100 p-4 d-flex flex-column">

                    {{-- HEADER KARTU (Sama dengan Beranda) --}}
                    <div class="d-flex align-items-center mb-4 border-bottom border-secondary border-opacity-10 pb-3">
                        <div class="quote-icon me-3 flex-shrink-0">
                            <i class="fas fa-quote-left text-primary fa-lg"></i>
                        </div>
                        <div>
                            {{-- 1. NAMA --}}
                            <h5 class="text-white fw-bold mb-1 text-truncate">
                                {{ $testi->name }}
                            </h5>

                            {{-- 2. ROLE - JABATAN --}}
                            <small class="text-cyan d-block fw-bold mb-2 lh-sm">
                                {{ $testi->role }}
                                @if($testi->position)
                                - {{ $testi->position }}
                                @endif
                            </small>

                            {{-- 3. SEKOLAH (Pop Up Style) --}}
                            @if($testi->school_id && $testi->school)
                            <div class="d-inline-block bg-white bg-opacity-10 px-3 py-1 rounded-pill mt-1">
                                <small class="text-white d-flex align-items-center fw-bold" style="font-size: 0.85rem;">
                                    <i class="fas fa-school me-2 text-secondary"></i>
                                    {{ $testi->school->name }}
                                </small>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- ISI TESTIMONI --}}
                    <div class="testi-content-main flex-grow-1">
                        <p class="text-white-50 fst-italic mb-4 lh-lg" style="font-size: 16px;">
                            "{{ Str::limit($testi->content, 180) }}"
                        </p>
                    </div>

                    {{-- TOMBOL BACA SELENGKAPNYA --}}
                    <div class="mt-auto">
                        @php
                            $modalPosition = $testi->position ?? '';
                            if($testi->school_id && $testi->school) {
                                $modalPosition .= ($modalPosition ? ' | ' : '') . $testi->school->name;
                            }
                        @endphp

                        <button class="btn btn-link-custom text-decoration-none p-0 mb-4 text-primary fw-bold"
                            onclick="openTestimonialModal(this)"
                            data-name="{{ $testi->name }}"
                            data-role="{{ $testi->role }}"
                            data-position="{{ $modalPosition }}"
                            data-text="{{ $testi->content }}">
                            Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </button>

                        {{-- AVATAR KECIL DI BAWAH (Opsional, bawaan dari kode Anda sebelumnya) --}}
                        <div class="testi-footer-info d-flex align-items-center pt-3 border-top border-secondary border-opacity-10">

                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12 text-center text-white-50 py-5">
                Belum ada testimonial yang tersedia.
            </div>
            @endforelse
        </div>

        {{-- 4. Pagination --}}
        @if($testimonials->hasPages())
        <div class="d-none justify-content-center mt-5 pb-5" id="pagination-wrapper">
            {{ $testimonials->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</section>

{{-- MODAL TESTIMONI (SAMA SEPERTI DI HALAMAN BERANDA) --}}
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    {{-- PERBAIKAN: Menggunakan modal-dialog-scrollable agar bisa digulir tanpa menabrak navbar --}}
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="background-color: #161a2e; border: 1px solid rgba(255,255,255,0.1); border-radius: 20px;">

            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 pt-0">
                <div class="d-flex align-items-center mb-4">
                    <div class="quote-icon me-3 flex-shrink-0" style="width: 50px; height: 50px; background-color: rgba(67, 97, 238, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-quote-left fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h4 id="modalName" class="text-white fw-bold mb-1"></h4>
                        <p id="modalRole" class="text-cyan small fw-bold mb-0"></p>
                    </div>
                </div>

                {{-- Teks Testimoni Panjang --}}
                <p id="modalText" class="text-white-50 fst-italic mb-0" style="line-height: 1.8; font-size: 1.1rem; text-align: justify;"></p>
            </div>

        </div>
    </div>
</div>

@endsection
