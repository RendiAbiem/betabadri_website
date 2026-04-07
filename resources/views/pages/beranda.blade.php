@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<main id="main" class="overflow-hidden">

    <section class="main-hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

            {{-- INDIKATOR SLIDE --}}
            <div class="carousel-indicators custom-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">

                {{-- SLIDE 1: IMAGE BANNER 1 --}}
                <div class="carousel-item active" data-bs-interval="10000">
                    <div class="hero-overlay"></div>

                    <img src="{{ asset('img/banner/banner1.jpeg') }}"
                        alt="Hero Banner Beta Badri"
                        class="hero-media">

                    <div class="container hero-container">
                        <div class="row w-100 align-items-center">
                            <div class="col-lg-8 hero-content">
                                <span class="badge-label text-gradient">// THE NEXT GENERATION</span>

                                {{-- Judul Utama dengan Terjemahan --}}
                                <h1 class="display-3 fw-bold text-white mb-4 mt-2">
                                    {!! __('Membangun Masa Depan Teknologi') !!}
                                </h1>

                                {{-- Deskripsi dengan Terjemahan --}}
                                <p class="text-light mb-5 fs-5 opacity-75 d-none d-md-block">
                                    {!! __('Kuasai keahlian robotik dan pemrograman bersama mentor expert dengan kurikulum standar industri internasional.') !!}
                                </p>

                                <div class="d-flex gap-3 btn-wrapper">
                                    <a href="{{ url('page/kontak') }}" class="btn btn-primary-hero shadow-blue">
                                        {{ __('Mulai Belajar') }} <i class="fas fa-bolt ms-2"></i>
                                    </a>
                                    <a href="{{ url('page/galeri') }}" class="btn btn-outline-hero">
                                        <i class="fas fa-play-circle me-2"></i> {{ __('Video Profil') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 2: IMAGE BANNER 2 --}}
                <div class="carousel-item" data-bs-interval="10000">
                    <div class="hero-overlay"></div>

                    <img src="{{ asset('img/banner/banner2.jpeg') }}"
                        alt="Hero Banner Beta Badri"
                        class="hero-media">

                    <div class="container hero-container">
                        <div class="row w-100 align-items-center">
                            <div class="col-lg-8 hero-content text-md-start">
                                <span class="badge-label text-gradient">// PROGRAM CLASS</span>

                                {{-- Judul Slide 2 --}}
                                <h2 class="display-3 fw-bold text-white mb-4 mt-2">
                                    {!! __('Inovasi Tanpa Batas Kreativitas') !!}
                                </h2>

                                <div class="d-flex gap-3 btn-wrapper">
                                    <a href="#" class="btn btn-primary-hero shadow-blue">
                                        {{ __('Lihat Program') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 3: VIDEO BACKGROUND --}}
                <div class="carousel-item" data-bs-interval="10000">
                    <div class="hero-overlay"></div>

                    {{-- Video Background --}}
                    <video autoplay muted loop playsinline class="hero-media" style="filter: brightness(0.7); object-fit: cover;">
                        <source src="{{ asset('img/betabadri-zB8sL5Xg.mp4') }}" type="video/mp4">
                    </video>

                    <div class="container hero-container">
                        <div class="row w-100 align-items-center">
                            <div class="col-lg-8 hero-content">
                                <span class="badge-label text-gradient">// CODING & ROBOTICS</span>

                                {{-- Judul Slide 3 --}}
                                <h2 class="display-3 fw-bold text-white mb-4 mt-2">
                                    {!! __('Siapkan Karir Di Era Digital 4.0') !!}
                                </h2>

                                <div class="d-flex gap-3 btn-wrapper">
                                    <a href="#" class="btn btn-primary-hero shadow-blue">
                                        {{ __('Hubungi Kami') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="about-tech-section py-5">
        <div class="tech-grid-overlay"></div>
        <div class="glow-orb-about"></div>

        <div class="container py-lg-5 position-relative" style="z-index: 2;">
            <div class="row align-items-center g-5">

                {{-- KOLOM KIRI: VISUAL GAMBAR --}}
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-visual-wrapper">
                        <div class="main-photo-frame">
                            <img src="{{ asset('img/programming.jpeg') }}" alt="Beta Badri Tech" class="img-fluid rounded-4">
                            <div class="frame-border"></div>
                        </div>

                        <div class="floating-tech-card" data-aos="zoom-in" data-aos-delay="300">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-microchip"></i>
                                </div>
                                <div>
                                    <h4 class="m-0 text-white fw-bold">1000+</h4>
                                    <p class="m-0 text-secondary small">{{ __('Alumni Digital') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: KONTEN TEKS --}}
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ps-lg-5">
                        <span class="badge-label text-gradient">// THE INNOVATION HUB</span>

                        <h2 class="display-5 fw-bold text-white mb-4 mt-2">
                            {!! __('Mengenal Beta Badri') !!}
                        </h2>

                        <p class="text-secondary fs-5 mb-4 leading-relaxed">
                            {!! __('Beta Badri bukan sekadar tempat kursus. Kami adalah Ekosistem Teknologi yang dirancang untuk membentuk pola pikir inovatif bagi generasi muda.') !!}
                        </p>

                        <p class="text-secondary mb-5">
                            {!! __('Fokus kami adalah memberikan pengalaman belajar yang relevan dengan perkembangan industri global. Mulai dari Robotik, Artificial Intelligence, Fullstack Development, Cyber Security, hingga Game Development, kami memastikan setiap siswa siap menghadapi tantangan era digital 4.0.') !!}
                        </p>

                        <div class="about-features-list">
                            {{-- Fitur 1 --}}
                            <div class="d-flex gap-3 mb-4">
                                <div class="feature-icon-small">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">{{ __('Misi Masa Depan') }}</h6>
                                    <p class="small text-secondary mb-0">
                                        {{ __('Mempersiapkan talenta lokal untuk bersaing di panggung teknologi internasional.') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Fitur 2 --}}
                            <div class="d-flex gap-3">
                                <div class="feature-icon-small">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">{{ __('Metode Hands-On') }}</h6>
                                    <p class="small text-secondary mb-0">
                                        {{ __('Belajar lewat praktek langsung menggunakan perangkat teknologi standar industri.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="programs" class="programs-section py-5 position-relative overflow-hidden">

        <div class="glow-bg position-absolute top-0 start-50 translate-middle-x"></div>

        <div class="container position-relative z-2 py-5">

            {{-- HEADER SECTION --}}
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase fw-bold text-primary letter-spacing-2">{{ __('Kurikulum Kami') }}</h6>
                <h2 class="display-5 fw-bold text-white">
                    {!! __('Jalur Belajar Masa Depan') !!}
                </h2>
                <p class="text-white-50 mx-auto" style="max-width: 600px;">
                    {{ __('Kami merancang kurikulum bertingkat untuk membentuk ahli teknologi, mulai dari dasar logika hingga keamanan siber tingkat lanjut.') }}
                </p>
            </div>

            <div class="row g-4">

                {{-- 1. ROBOTIK MODULAR --}}
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="program-card h-100 p-4">
                        <div class="icon-wrapper mb-4 bg-blue-soft">
                            <i class="fas fa-robot fa-2x text-primary"></i>
                        </div>
                        <h4 class="text-white fw-bold">{{ __('Robotik Modular') }}</h4>
                        <p class="text-white-50 small mb-4">
                            {{ __('Belajar mekanika & logika dasar menggunakan kit robot lego/modular yang ramah anak.') }}
                        </p>
                        <ul class="program-tags list-unstyled d-flex flex-wrap gap-2 mb-4">
                            <li><span>{{ __('SD/SMP') }}</span></li>
                            <li><span>Logic</span></li>
                            <li><span>Fun</span></li>
                        </ul>
                        <a href="{{ route('programs.modular') }}" class="btn-link-custom">
                            {{ __('Lihat Detail') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                {{-- 2. ROBOTIK ELEKTRONIKA --}}
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="program-card h-100 p-4">
                        <div class="icon-wrapper mb-4 bg-purple-soft">
                            <i class="fas fa-microchip fa-2x text-purple"></i>
                        </div>
                        <h4 class="text-white fw-bold">{{ __('Robotik Elektronika') }}</h4>
                        <p class="text-white-50 small mb-4">
                            {{ __('Merakit komponen, menyolder, dan memprogram mikrokontroler (Arduino/IoT).') }}
                        </p>
                        <ul class="program-tags list-unstyled d-flex flex-wrap gap-2 mb-4">
                            <li><span>{{ __('SMP/SMA') }}</span></li>
                            <li><span>IoT</span></li>
                            <li><span>Hardware</span></li>
                        </ul>
                        <a href="{{ route('programs.electronika') }}" class="btn-link-custom text-purple">
                            {{ __('Lihat Detail') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                {{-- 3. PROGRAMMING --}}
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="program-card h-100 p-4">
                        <div class="icon-wrapper mb-4 bg-cyan-soft">
                            <i class="fas fa-code fa-2x text-cyan"></i>
                        </div>
                        <h4 class="text-white fw-bold">{{ __('Programming') }}</h4>
                        <p class="text-white-50 small mb-4">
                            {{ __('Pengembangan software mulai dari Web, Mobile App, hingga Game Development (Python/JS).') }}
                        </p>
                        <ul class="program-tags list-unstyled d-flex flex-wrap gap-2 mb-4">
                            <li><span>{{ __('Semua Usia') }}</span></li>
                            <li><span>Coding</span></li>
                            <li><span>Algoritma</span></li>
                        </ul>
                        <a href="{{ route('programs.programming') }}" class="btn-link-custom text-cyan">
                            {{ __('Lihat Detail') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                {{-- 4. CYBER SECURITY --}}
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="program-card h-100 p-4">
                        <div class="icon-wrapper mb-4 bg-red-soft">
                            <i class="fas fa-user-secret fa-2x text-danger"></i>
                        </div>
                        <h4 class="text-white fw-bold">{{ __('Cyber Security') }}</h4>
                        <p class="text-white-50 small mb-4">
                            {{ __('Mengamankan jaringan, ethical hacking, dan pertahanan sistem digital.') }}
                        </p>
                        <ul class="program-tags list-unstyled d-flex flex-wrap gap-2 mb-4">
                            <li><span>{{ __('SMA/Mahasiswa') }}</span></li>
                            <li><span>Network</span></li>
                            <li><span>Security</span></li>
                        </ul>
                        <a href="{{ route('programs.coming-soon') }}" class="btn-link-custom text-danger">
                            {{ __('Lihat Detail') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                {{-- 5. GAME DEVELOPMENT --}}
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="program-card h-100 p-4">
                        <div class="icon-wrapper mb-4 bg-orange-soft">
                            <i class="fas fa-gamepad fa-2x text-orange"></i>
                        </div>
                        <h4 class="text-white fw-bold">{{ __('Game Development') }}</h4>
                        <p class="text-white-50 small mb-4">
                            {{ __('Menciptakan dunia virtual sendiri dengan belajar Unity, Unreal Engine, dan desain aset 3D.') }}
                        </p>
                        <ul class="program-tags list-unstyled d-flex flex-wrap gap-2 mb-4">
                            <li><span>{{ __('Semua Usia') }}</span></li>
                            <li><span>3D Modeling</span></li>
                            <li><span>C# / C++</span></li>
                        </ul>
                        <a href="{{ route('programs.game') }}" class="btn-link-custom text-orange">
                            {{ __('Lihat Detail') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="why-us-section py-5 position-relative">

        <div class="tech-line position-absolute top-0 end-0 h-100"></div>

        <div class="container py-5">
            <div class="row g-5">

                {{-- KOLOM KIRI (STATISTIK) --}}
                <div class="col-lg-5">
                    <div class="sticky-top" style="top: 120px; z-index: 1;">
                        <h6 class="text-uppercase fw-bold text-cyan mb-3 letter-spacing-2">
                            {{ __('Kenapa Memilih Kami?') }}
                        </h6>

                        <h2 class="display-5 fw-bold text-white mb-4">
                            {!! __('Kami Mencetak Innovator Digital') !!}
                        </h2>

                        <p class="text-white-50 mb-5 leading-relaxed">
                            {{ __('Kurikulum standar industri, mentor praktisi, dan ekosistem belajar yang mendukung siswa untuk tidak sekadar "tahu", tapi "mampu menciptakan".') }}
                        </p>

                        <div class="row g-4 mb-4">
                            <div class="col-6">
                                <div class="stat-box">
                                    <h3 class="display-6 fw-bold text-white mb-0">5<span class="text-primary">+</span></h3>
                                    <p class="text-white-50 small">{{ __('Tahun Pengalaman') }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box">
                                    <h3 class="display-6 fw-bold text-white mb-0">700<span class="text-primary">+</span></h3>
                                    <p class="text-white-50 small">{{ __('Siswa Terbimbing') }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box">
                                    <h3 class="display-6 fw-bold text-white mb-0">20<span class="text-primary">+</span></h3>
                                    <p class="text-white-50 small">{{ __('Mitra Sekolah') }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box">
                                    <h3 class="display-6 fw-bold text-white mb-0">100<span class="text-primary">%</span></h3>
                                    <p class="text-white-50 small">{{ __('Project Based') }}</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/page/kontak') }}" class="btn btn-cta-green mt-2">{{ __('Gabung Sekarang') }}</a>
                    </div>
                </div>

                {{-- KOLOM KANAN (FITUR UNGGULAN) --}}
                <div class="col-lg-7">
                    <div class="d-flex flex-column gap-4">

                        {{-- Fitur 1 --}}
                        <div class="feature-card-tech d-flex align-items-start p-4" data-aos="fade-left">
                            <div class="icon-box-tech me-4 flex-shrink-0">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-2">{{ __('Kurikulum Bertingkat') }}</h4>
                                <p class="text-white-50 mb-0">
                                    {{ __('Materi disusun sistematis menyesuaikan usia (SD, SMP, SMA). Siswa belajar pondasi logika sebelum masuk ke syntax coding yang rumit.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Fitur 2 --}}
                        <div class="feature-card-tech d-flex align-items-start p-4" data-aos="fade-left" data-aos-delay="100">
                            <div class="icon-box-tech me-4 flex-shrink-0">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-2">{{ __('100% Praktek (Hands-on)') }}</h4>
                                <p class="text-white-50 mb-0">
                                    {{ __('Kami percaya coding adalah skill praktis. Setiap pertemuan siswa wajib menghasilkan output project, bukan sekadar teori.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Fitur 3 --}}
                        <div class="feature-card-tech d-flex align-items-start p-4" data-aos="fade-left" data-aos-delay="200">
                            <div class="icon-box-tech me-4 flex-shrink-0">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-2">{{ __('Mentor Praktisi') }}</h4>
                                <p class="text-white-50 mb-0">
                                    {{ __('Dibimbing langsung oleh programmer & engineer berpengalaman yang mengerti kebutuhan industri teknologi saat ini.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Fitur 4 --}}
                        <div class="feature-card-tech d-flex align-items-start p-4" data-aos="fade-left" data-aos-delay="300">
                            <div class="icon-box-tech me-4 flex-shrink-0">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-2">{{ __('Kompetisi & Prestasi') }}</h4>
                                <p class="text-white-50 mb-0">
                                    {{ __('Kami rutin mengirim siswa ke ajang kompetisi robotik & coding nasional maupun internasional (Young Coder Cup).') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="methodology-section py-5 position-relative">
        <div class="container py-5">

            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase fw-bold text-cyan letter-spacing-2">{{ __('How We Teach') }}</h6>
                <h2 class="display-5 fw-bold text-white">{!! __('Metode <span class="text-gradient-blue">Pembelajaran</span>') !!}</h2>
            </div>

            <div class="row g-4">

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="method-card h-100">
                        <div class="method-number">01</div>
                        <div class="method-icon mb-4">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-3">{{ __('Kurikulum Terkini') }}</h4>
                        <p class="text-white-50 small mb-0">
                            {{ __('Materi selalu di-update mengikuti perkembangan teknologi terbaru dan standar industri global yang dinamis.') }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="method-card h-100">
                        <div class="method-number">02</div>
                        <div class="method-icon mb-4">
                            <i class="fas fa-language"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-3">{{ __('Pelajar Bilingual') }}</h4>
                        <p class="text-white-50 small mb-0">
                            {{ __('Penyampaian materi menggunakan Bahasa Indonesia & Inggris untuk membiasakan siswa dengan istilah teknis global.') }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="method-card h-100">
                        <div class="method-number">03</div>
                        <div class="method-icon mb-4">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-3">{{ __('Berbasis Project') }}</h4>
                        <p class="text-white-50 small mb-0">
                            {{ __('Learning by doing. Setiap siswa wajib menyelesaikan project nyata (Aplikasi/Robot) di setiap akhir sesi pembelajaran.') }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="method-card h-100">
                        <div class="method-number">04</div>
                        <div class="method-icon mb-4">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-3">{{ __('Pendekatan Individu') }}</h4>
                        <p class="text-white-50 small mb-0">
                            {{ __('Kelas kecil dengan fokus pada kecepatan belajar unik setiap siswa, memastikan tidak ada yang tertinggal.') }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="kegiatan-belajar py-5" style="background: #0B0A1D;">
        <div class="container py-lg-5">
            <div class="row align-items-center">

                {{-- Bagian Teks (Kiri) --}}
                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up">
                    <span class="badge-label text-gradient">{{ __('// GALLERY KEGIATAN') }}</span>
                    <h2 class="display-5 fw-bold text-white mb-3 mt-2">
                        {!! __('Apa saja yang Kami Lakukan <br> <span class="text-gradient">Di Kelas Betabadri?</span>') !!}
                    </h2>
                    <p class="text-secondary fs-5">
                        {{ __('Intip keseruan interaksi belajar mengajar robotik dan coding di berbagai mitra sekolah kami.') }}
                    </p>
                    <div class="mt-4 d-none d-lg-flex gap-3">
                        <button class="video-nav-btn video-prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="video-nav-btn video-next active">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                {{-- Bagian Slider Video (Kanan) --}}
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="swiper videoSwiper overflow-hidden">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/1_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/1_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">SD IT AL-FITYAH</h6>
                                            <small class="text-cyan">{{ __('Robotik Modular - Robot Makerzoid') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/2_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/2_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">Habibie School</h6>
                                            <small class="text-cyan">{{ __('Programming - Game Developer') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/3_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/3_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">SD IT AL-FITYAH</h6>
                                            <small class="text-cyan">{{ __('Robotik Modular - Robotic Vex IQ') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/4_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/4_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">Habibie School</h6>
                                            <small class="text-cyan">{{ __('Robotik Elektronika - Project Traffic Light') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/5_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/5_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">SMP IT ABDURRAB</h6>
                                            <small class="text-cyan">{{ __('Robotik Elektronika - Robotic Line Follower') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="video-card">
                                    <video class="v-player" poster="{{ asset('img/thumnail/6_pict.jpeg') }}" loop muted>
                                        <source src="{{ asset('img/vid/6_vid.mp4') }}" type="video/mp4">
                                    </video>
                                    <div class="video-overlay">
                                        <button class="play-btn"><i class="fas fa-play"></i></button>
                                        <div class="video-info">
                                            <h6 class="text-white fw-bold mb-0">SMA IT SYAFII</h6>
                                            <small class="text-cyan">{{ __('Programming - Setup Laravel') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-pagination d-lg-none mt-4 position-relative"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="process-section py-5 position-relative overflow-hidden">
        <div class="container py-5">

            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase fw-bold text-primary letter-spacing-2">{{ __('How to Join') }}</h6>
                <h2 class="display-5 fw-bold text-white">{!! __('4 Langkah <span class="text-gradient-blue">Mudah Bergabung</span>') !!}</h2>
            </div>

            <div class="row g-4 position-relative process-timeline">
                <div class="timeline-line d-none d-lg-block"></div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-card text-center position-relative">
                        <div class="process-icon-wrapper mb-4">
                            <div class="process-number">1</div>
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h4 class="text-white fw-bold h5">{{ __('Daftar & Konsultasi') }}</h4>
                        <p class="text-white-50 small">{{ __('Isi formulir pendaftaran atau hubungi admin kami untuk konsultasi kebutuhan belajar anak.') }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-card text-center position-relative">
                        <div class="process-icon-wrapper mb-4">
                            <div class="process-number">2</div>
                            <i class="fas fa-laptop-house"></i>
                        </div>
                        <h4 class="text-white fw-bold h5">{{ __('Free Trial Class') }}</h4>
                        <p class="text-white-50 small">{{ __('Ikuti sesi percobaan gratis (Offline/Online) untuk merasakan pengalaman belajar seru.') }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-card text-center position-relative">
                        <div class="process-icon-wrapper mb-4">
                            <div class="process-number">3</div>
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="text-white fw-bold h5">{{ __('Assessment') }}</h4>
                        <p class="text-white-50 small">{{ __('Siswa akan dinilai kemampuannya untuk penempatan level kelas yang paling sesuai.') }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="process-card text-center position-relative">
                        <div class="process-icon-wrapper mb-4 bg-success-glow">
                            <div class="process-number">4</div>
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="text-white fw-bold h5">{{ __('Start Learning') }}</h4>
                        <p class="text-white-50 small">{{ __('Selamat! Anak Anda siap memulai petualangan menjadi pencipta teknologi masa depan.') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="testimonials-section-dark py-5 position-relative overflow-hidden">
        <div class="glow-bg-right position-absolute top-50 end-0 translate-middle-y"></div>

        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
                <div>
                    <h6 class="text-uppercase fw-bold text-cyan letter-spacing-2">{{ __('Testimonials') }}</h6>
                    <h2 class="display-5 fw-bold text-white">{!! __('Kata Mereka <span class="text-gradient-blue">Tentang Kami</span>') !!}</h2>
                </div>
                <div class="d-none d-lg-flex gap-3">
                    <button class="testi-nav-btn testi-prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="testi-nav-btn testi-next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="swiper testimonialSwiper pb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testi)
                    <div class="swiper-slide h-auto">
                        <div class="testi-card-dark h-100 p-4 d-flex flex-column">

                            <div class="d-flex align-items-center mb-4">
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
                                        {{ __($testi->role) }}
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

                            <div class="testi-content flex-grow-1">
                                <p class="fst-italic mb-4" style="font-size: 16px; line-height: 1.7; color: #e2e8f0;">
                                    "{{ Str::limit($testi->content, 150) }}"
                                </p>
                            </div>

                            <div class="mt-auto">
                                @php
                                $modalPosition = $testi->position ?? '';
                                if($testi->school_id && $testi->school) {
                                    $modalPosition .= ($modalPosition ? ' | ' : '') . $testi->school->name;
                                }
                                @endphp

                                <button class="btn btn-sm btn-link-custom text-decoration-none p-0" onclick="openTestimonialModal(this)"
                                    data-name="{{ $testi->name }}"
                                    data-role="{{ __($testi->role) }}"
                                    data-position="{{ $modalPosition }}"
                                    data-text="{{ $testi->content }}">
                                    {{ __('Baca Selengkapnya') }} <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide h-auto">
                        <div class="testi-card-dark h-100 p-4 d-flex align-items-center justify-content-center">
                            <p class="text-white-50">{{ __('Belum ada testimonial.') }}</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>

            <div class="text-center mt-4" data-aos="fade-up">
                <a href="{{ url('/page/testimonials') }}" class="btn btn-outline-hero">
                    {{ __('Lihat Semua Testimonial') }} <i class="fas fa-comments ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- MODAL TESTIMONI (FIXED Z-INDEX & SCROLL) --}}
    <div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
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

                    {{-- Teks Testimoni --}}
                    <p id="modalText" class="text-white-50 fst-italic mb-0" style="line-height: 1.8; font-size: 1.1rem; text-align: justify;"></p>
                </div>

            </div>
        </div>
    </div>

    <section class="faq-section py-5 position-relative">
        <div class="container py-5" style="max-width: 900px;">

            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase fw-bold text-cyan letter-spacing-2">{{ __('Tanya Jawab') }}</h6>
                <h2 class="display-5 fw-bold text-white">{!! __('Sering <span class="text-gradient-blue">Ditanyakan</span>') !!}</h2>
            </div>

            <div class="accordion custom-accordion" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            {{ __('Apakah pemula tanpa pengalaman coding bisa bergabung?') }}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! __('<strong>Tentu saja!</strong> Kurikulum kami dirancang bertingkat. Untuk pemula, kami mulai dengan logika dasar dan visual programming (blok) sebelum masuk ke penulisan kode (syntax) yang lebih kompleks.') !!}
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            {{ __('Perangkat apa saja yang perlu disiapkan siswa?') }}
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ __('Untuk kelas Programming, siswa wajib membawa Laptop (Windows/Mac) dengan spesifikasi standar (RAM 4GB cukup). Untuk kelas Robotik, semua kit dan komponen sudah disediakan di laboratorium kami.') }}
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            {{ __('Apakah ada sertifikat setelah lulus?') }}
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! __('Ya, setiap siswa yang menyelesaikan satu level materi dan lulus ujian project akhir akan mendapatkan <strong>Sertifikat Kompetensi</strong> resmi dari Beta Badri Education.') !!}
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                            {{ __('Apakah tersedia kelas online?') }}
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! __('Kami menyediakan opsi kelas <strong>Hybrid</strong>. Namun untuk hasil maksimal, terutama kelas Robotik, kami sangat menyarankan pertemuan tatap muka (Offline) agar praktek lebih optimal.') !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="partners-section py-5 position-relative overflow-hidden" id="partners-section-anchor">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: #080f1f;"></div>

        <div class="container position-relative z-2">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase fw-bold text-cyan letter-spacing-2">{{ __('Trusted Partners') }}</h6>
                <h4 class="text-white fw-bold mb-0">{!! __('Berkolaborasi dengan <span class="text-gradient-blue">Instansi Terbaik</span>') !!}</h4>
            </div>

            <div class="row g-4 justify-content-center" data-aos="fade-up" data-aos-delay="100">
                @foreach($partners as $partner)
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="h-100 d-flex align-items-center justify-content-center p-4 rounded-3 partner-item-wrapper">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                            alt="{{ $partner->name }}"
                            class="img-fluid partner-logo-natural"
                            title="{{ $partner->name }}"
                            style="max-height: 160px; width: auto; object-fit: contain;">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-section py-5 text-center position-relative overflow-hidden">

        <div class="cta-bg-overlay"></div>

        <div class="container py-5 position-relative z-2">
            <h2 class="display-4 fw-bold text-white mb-4">
                {!! __('Siap Mencetak <span class="text-warning">Prestasi Digital?</span>') !!}
            </h2>
            <p class="lead text-white-50 mb-5 mx-auto" style="max-width: 700px;">
                {{ __('Jangan biarkan anak hanya menjadi penikmat teknologi. Bergabunglah bersama 700+ siswa lainnya dan mulai perjalanan menjadi pencipta teknologi hari ini.') }}
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ url('page/kontak') }}" class="btn btn-lg btn-cta-green px-5 py-3 fs-5">
                    {{ __('Daftar Konsultasi Gratis') }}
                </a>
                <a href="{{ url('page/programs') }}" class="btn btn-lg btn-outline-light px-5 py-3 fs-5">
                    {{ __('Lihat Jadwal Kelas') }}
                </a>
            </div>
        </div>
    </section>

</main>
@endsection
