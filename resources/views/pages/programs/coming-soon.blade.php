@extends('layouts.app')

@section('title', 'Coming Soon - Beta Badri Education')

@section('content')
<section class="coming-soon-section d-flex align-items-center justify-content-center">
    <div class="tech-grid-overlay"></div>
    <div class="glow-orb-coming-soon"></div>

    <div class="container text-center position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="zoom-in">
                <div class="coming-soon-icon mb-4">
                    <i class="fas fa-rocket fa-4x text-gradient"></i>
                </div>

                <span class="badge-label text-gradient mb-3 d-inline-block">// UNDER DEVELOPMENT</span>

                <h1 class="display-3 fw-bold text-white mb-3">
                    Sesuatu yang <span class="text-gradient">Luar Biasa</span> <br> Sedang Disiapkan!
                </h1>

                <p class="text-secondary fs-5 mb-5 mx-auto" style="max-width: 600px;">
                    Kami sedang meramu kurikulum terbaik untuk program ini agar kamu siap menjadi ahli teknologi masa depan. Pantau terus perkembangannya!
                </p>

                <div class="development-progress mx-auto mb-5" style="max-width: 400px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white small fw-bold">Development Progress</span>
                        <span class="text-cyan small fw-bold">85%</span>
                    </div>
                    <div class="progress-tech-container">
                        <div class="progress-tech-bar" style="width: 85%;"></div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-outline-hero">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                    </a>
                    <a href="https://wa.me/62xxxxxxxxxx" class="btn btn-primary-hero shadow-blue">
                        Kabari Saya <i class="fab fa-whatsapp ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
