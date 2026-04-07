@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('img/vision.jpg') }}');">

    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <span class="badge bg-purple-soft text-purple px-3 py-2 rounded-pill mb-3 fw-bold border border-purple" style="border-color: #8b5cf6;" data-aos="fade-down">Filosofi Kami</span>
        <h1 class="display-3 fw-bold text-white mb-3" data-aos="fade-up">Visi & <span class="text-gradient-blue">Misi</span></h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
            Komitmen kami dalam menghadirkan pendidikan berbasis teknologi yang inklusif dan menyenangkan di Pekanbaru dan sekitarnya.
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">
    <div class="tech-line position-absolute top-0 end-0 h-100 d-none d-lg-block"></div>

    <div class="container py-5">
        <div class="row align-items-center gx-5">

            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="vision-img-wrapper position-relative">
                    <img src="{{ asset('img/mission.jpg') }}" alt="Visi Beta Badri" class="img-fluid rounded-4 shadow-lg-blue position-relative z-2">
                    <div class="decoration-box-border"></div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-lg-4">
                    <h6 class="text-uppercase text-cyan fw-bold letter-spacing-2 mb-3">Visi Kami</h6>
                    <h2 class="display-5 fw-bold text-white mb-4">
                        Pionir Edukasi <span class="text-gradient-blue">Berbasis Teknologi</span>
                    </h2>
                    <blockquote class="text-white-50 lead mb-4 fst-italic border-start border-4 border-primary ps-4">
                        "Menjadi Pionir Edukasi Berbasis Teknologi yang Berakar dari Pekanbaru, dan Menginspirasi Generasi Digital di Seluruh Indonesia Melalui Pengalaman Belajar STEM yang Inklusif, Adaptif, dan Futuristik."
                    </blockquote>

                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="icon-box-small bg-blue-soft">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0">From Pekanbaru</h6>
                            <small class="text-white-50">Untuk Indonesia</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-black-pearl position-relative">
    <div class="container py-5">

        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold letter-spacing-2">Misi Kami</h6>
            <h2 class="text-white fw-bold">Langkah <span class="text-gradient-blue">Nyata</span></h2>
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="mission-card h-100 p-4">
                    <div class="mission-icon mb-3 text-cyan"><i class="fas fa-globe-asia fa-2x"></i></div>
                    <h4 class="text-white fw-bold mb-3 h5">Akses STEM Berkualitas</h4>
                    <p class="text-white-50 small">Menyediakan akses pendidikan STEM berkualitas dan menyenangkan, dimulai dari Pekanbaru dan meluas ke seluruh Indonesia.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="mission-card h-100 p-4">
                    <div class="mission-icon mb-3 text-purple"><i class="fas fa-puzzle-piece fa-2x"></i></div>
                    <h4 class="text-white fw-bold mb-3 h5">Kurikulum Interaktif</h4>
                    <p class="text-white-50 small">Merancang kurikulum interaktif yang menumbuhkan kreativitas dan keterampilan <em>problem solving</em> (pemecahan masalah).</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="mission-card h-100 p-4">
                    <div class="mission-icon mb-3 text-warning"><i class="fas fa-robot fa-2x"></i></div>
                    <h4 class="text-white fw-bold mb-3 h5">Pencipta Teknologi</h4>
                    <p class="text-white-50 small">Mendorong anak muda menjadi pencipta teknologi (Creator) melalui metode pembelajaran aplikatif, bukan sekadar pengguna.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="mission-card h-100 p-4">
                    <div class="mission-icon mb-3 text-success"><i class="fas fa-users fa-2x"></i></div>
                    <h4 class="text-white fw-bold mb-3 h5">Budaya Inklusif</h4>
                    <p class="text-white-50 small">Menumbuhkan budaya belajar yang inklusif, ramah bagi semua, dan relevan dengan perkembangan dunia digital saat ini.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="mission-card h-100 p-4">
                    <div class="mission-icon mb-3 text-danger"><i class="fas fa-handshake fa-2x"></i></div>
                    <h4 class="text-white fw-bold mb-3 h5">Mitra Strategis</h4>
                    <p class="text-white-50 small">Berperan sebagai mitra strategis dalam pendidikan teknologi bersama sekolah, orang tua, dan komunitas.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-navy-dark border-top border-secondary text-center">
    <div class="container">
        <h2 class="text-white fw-bold mb-4">Siap Berkolaborasi?</h2>
        <p class="text-white-50 mb-4">Bersama kita bangun ekosistem pendidikan teknologi terbaik di Riau.</p>
        <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">Hubungi Kami</a>
    </div>
</section>

@endsection
