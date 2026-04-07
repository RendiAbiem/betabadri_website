@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/program-hero.jpg') }}'); min-height: 400px;">
    <div class="program-bg-overlay"></div>
    <div class="container position-relative z-2 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-bold">Beta Badri Curriculum</span>
        <h1 class="display-3 fw-bold text-white mb-3">Pilih Jalur <span class="text-gradient-blue">Masa Depanmu</span></h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
            Kami menyediakan kurikulum teknologi terlengkap untuk segala usia. Mulai dari merakit robot Lego, menciptakan alat IoT, hingga mengembangkan aplikasi digital.
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">

    <div class="tech-line-vertical position-absolute start-50 top-0 h-100 d-none d-lg-block"></div>

    <div class="container py-5">

        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-warning-glow">
                        <i class="fas fa-cubes text-warning"></i>
                    </div>
                    <span class="text-warning fw-bold letter-spacing-2 text-uppercase small">Untuk Pemula & Anak-anak</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Robotik Modular</h2>
                    <p class="text-white-50 mb-4">
                        Gerbang awal mengenal dunia engineering tanpa rasa takut. Menggunakan kit bongkar-pasang (seperti Lego/Vex) untuk mempelajari mekanika gerak, struktur, dan logika sensor sederhana.
                    </p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Usia: SD (Kelas 1-6)</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Fokus: Logika & Mekanika</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Output: Robot Kompetisi</li>
                    </ul>
                    <a href="{{ route('programs.modular') }}" class="btn btn-outline-light rounded-pill px-4">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/robotic.jpg') }}" alt="Modular" class="img-fluid rounded-4 shadow-lg-blue">
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/electronic.jpg') }}" alt="Elektronika" class="img-fluid rounded-4 shadow-lg-purple">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5">
                    <div class="icon-box-tech mb-4 bg-purple-glow">
                        <i class="fas fa-microchip text-purple"></i>
                    </div>
                    <span class="text-purple fw-bold letter-spacing-2 text-uppercase small" style="color: #a78bfa;">Untuk Calon Engineer</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Robotik Elektronika</h2>
                    <p class="text-white-50 mb-4">
                        Level lanjutan untuk mereka yang ingin merakit alat canggih dari nol. Belajar menyolder komponen, memahami arus listrik, dan memprogram mikrokontroler (Arduino/IoT) dengan bahasa C++.
                    </p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> Usia: SMP - SMA/Umum</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> Fokus: Hardware & IoT</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> Output: Smart Devices</li>
                    </ul>
                    <a href="{{ route('programs.electronika') }}" class="btn btn-outline-light rounded-pill px-4">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-cyan-glow">
                        <i class="fas fa-laptop-code text-cyan"></i>
                    </div>
                    <span class="text-cyan fw-bold letter-spacing-2 text-uppercase small">Untuk Digital Creator</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Programming & App</h2>
                    <p class="text-white-50 mb-4">
                        Kuasai bahasa digital masa depan. Mulai dari visual coding yang menyenangkan hingga membangun Website, Aplikasi Mobile (Android), dan Game Development profesional.
                    </p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> Usia: SD - Dewasa</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> Fokus: Software & Logika</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> Output: Web/App/Game</li>
                    </ul>
                    <a href="{{ route('programs.programming') }}" class="btn btn-outline-light rounded-pill px-4">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/programming2.jpg') }}" alt="Programming" class="img-fluid rounded-4 shadow-lg-cyan">
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/game.jpg') }}" alt="Game Dev" class="img-fluid rounded-4 shadow-lg-orange">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5">
                    <div class="icon-box-tech mb-4 bg-orange-glow">
                        <i class="fas fa-gamepad text-orange"></i>
                    </div>
                    <span class="text-orange fw-bold letter-spacing-2 text-uppercase small">Untuk Game Creator</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Game Development</h2>
                    <p class="text-white-50 mb-4">
                        Ubah hobimu menjadi karya. Belajar menggunakan Unity atau Unreal Engine untuk menciptakan dunia game 2D/3D, lengkap dengan mekanika gameplay yang seru.
                    </p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> Usia: SMP - Dewasa</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> Fokus: 3D Design & C#</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> Output: Game Indie/Studio</li>
                    </ul>
                    <a href="{{ route('programs.game') }}" class="btn btn-outline-light rounded-pill px-4">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="row align-items-center program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-red-glow">
                        <i class="fas fa-user-secret text-danger"></i>
                    </div>
                    <span class="text-danger fw-bold letter-spacing-2 text-uppercase small">Untuk Calon Security Expert</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Cyber Security</h2>
                    <p class="text-white-50 mb-4">
                        Pelajari cara melindungi dunia digital. Mulai dari dasar jaringan, etika hacking (ethical hacking), hingga teknik pertahanan sistem dari serangan siber yang kompleks.
                    </p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Usia: SMP - Mahasiswa</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Fokus: Network & Defense</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Output: Security Analyst</li>
                    </ul>
                    <a href="{{ route('programs.coming-soon') }}" class="btn btn-outline-light rounded-pill px-4">Coming Soon <i class="fas fa-hourglass-half ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/cyber.jpg') }}" alt="Cyber Security" class="img-fluid rounded-4 shadow-lg-red">
                </div>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-black-pearl">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="text-white fw-bold">Bingung Memilih?</h2>
            <p class="text-white-50">Tabel perbandingan ringkas untuk membantu Anda memutuskan.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-hover custom-table text-center align-middle">
                <thead>
                    <tr>
                        <th class="py-4 text-start ps-4">Fitur</th>
                        <th class="py-4 text-warning">Modular</th>
                        <th class="py-4 text-purple">Elektronika</th>
                        <th class="py-4 text-cyan">Programming</th>
                        <th class="py-4 text-danger">Cyber Sec</th>
                        <th class="py-4 text-orange">Game Dev</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start ps-4 fw-bold">Rekomendasi Usia</td>
                        <td>SD (7-12)</td>
                        <td>SMP - SMA</td>
                        <td>Semua Usia</td>
                        <td>SMP - Mhs</td>
                        <td>SMP - Dewasa</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4 fw-bold">Hardware</td>
                        <td>Kit Lego</td>
                        <td>Arduino/IoT</td>
                        <td>Laptop</td>
                        <td>Laptop High</td>
                        <td>Laptop High</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4 fw-bold">Tingkat Kesulitan</td>
                        <td><i class="fas fa-star text-warning"></i> x2</td>
                        <td><i class="fas fa-star text-warning"></i> x3</td>
                        <td><i class="fas fa-star text-warning"></i> x3</td>
                        <td><i class="fas fa-star text-warning"></i> x5</td>
                        <td><i class="fas fa-star text-warning"></i> x4</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4 fw-bold">Output Utama</td>
                        <td>Robot</td>
                        <td>Alat IoT</td>
                        <td>Web/App</td>
                        <td>Security System</td>
                        <td>Game 2D/3D</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="py-5 bg-navy-dark border-top border-secondary text-center">
    <div class="container">
        <h2 class="text-white fw-bold mb-4">Masih Butuh Saran?</h2>
        <p class="text-white-50 mb-4">Tim konsultan pendidikan kami siap membantu memetakan minat & bakat anak Anda.</p>
        <a href="https://wa.me/6281376180003" class="btn btn-cta-green btn-lg px-5">Chat Konsultan Kami</a>
    </div>
</section>

@endsection


