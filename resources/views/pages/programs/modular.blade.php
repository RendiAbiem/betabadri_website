@extends('layouts.app')

@section('title', 'Program Robotic Modular - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/robotic-program.jpg') }}');">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">Best for Kids & Beginners</span>
                <h1 class="display-3 fw-bold text-white mb-3">Fun Learning <br><span class="text-gradient-blue">Modular Robotics</span></h1>
                <p class="lead text-white-50 mb-4">
                    Kelas robotik interaktif tanpa menyolder. Belajar prinsip mekanika, sensor, dan logika pemrograman menggunakan kit robot edukasi standar internasional.
                </p>
                <div class="d-flex gap-3">
                    <a href="#curriculum" class="btn btn-cta-green px-4 py-3">Lihat Silabus</a>
                    <a href="{{ asset('img/proposal.pdf') }}" download="Proposal_Penawaran.pdf" class="btn btn-outline-light px-4 py-3">
                        <i class="fas fa-file-download me-2"></i>Download Brosur
                    </a>
                </div>
        </div>
    </div>
</section>

<section class="py-5 bg-navy-dark">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="text-white fw-bold mb-4">Kenapa Robotik Modular?</h3>
                <p class="text-white-50">
                    Robotik Modular adalah gerbang terbaik untuk anak-anak mengenal dunia rekayasa (engineering). Menggunakan sistem <strong>Bongkar-Pasang (Plug & Play)</strong>, siswa dapat fokus memahami logika sensor dan mekanika tanpa risiko komponen rusak akibat penyolderan.
                </p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-cogs"></i></div>
                            <span class="text-white small">Mekanika (Gears & Tuas)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-puzzle-piece"></i></div>
                            <span class="text-white small">Struktur & Konstruksi</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-code-branch"></i></div>
                            <span class="text-white small">Visual Logic (Block)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-wifi"></i></div>
                            <span class="text-white small">Sensor & Automation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h5 class="text-cyan mb-4 text-center">Hardware & Software Tools</h5>
                <div class="tools-grid">
                    <div class="tool-item" data-bs-toggle="tooltip" title="Lego Mindstorms"><i class="fas fa-cubes"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="VEX IQ"><i class="fas fa-robot"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Arduino Kit"><i class="fas fa-microchip"></i></div>

                    <div class="tool-item" data-bs-toggle="tooltip" title="Scratch"><i class="fas fa-cat"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="MakeBlock"><i class="fas fa-shapes"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Logic"><i class="fas fa-brain"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="curriculum" class="py-5 bg-black-pearl position-relative">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold">Roadmap Belajar</h6>
            <h2 class="text-white fw-bold display-5">Jenjang <span class="text-gradient-blue">Level</span></h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-junior-tab" data-bs-toggle="pill" data-bs-target="#pills-junior" type="button">Junior (SD 1-3)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-senior-tab" data-bs-toggle="pill" data-bs-target="#pills-senior" type="button">Senior (SD 4-6)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-advance-tab" data-bs-toggle="pill" data-bs-target="#pills-advance" type="button">Advance (SMP)</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent" data-aos="fade-up" data-aos-delay="200">

            <div class="tab-pane fade show active" id="pills-junior" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Level 1: Mechanic Basic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Structure & Gears</h4>
                                <p class="text-white-50 small">Memahami cara kerja roda gigi (gear), tuas, dan kestabilan struktur robot. Robot belum menggunakan motor/baterai.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan (12 Pertemuan)</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Catapult / Crane</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Level 2: Power Machines</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Motor & Movement</h4>
                                <p class="text-white-50 small">Mengenal motor DC dan baterai. Robot mulai bisa bergerak maju, mundur, dan berputar menggunakan remote sederhana.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan (12 Pertemuan)</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Racing Car</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-senior" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-cyan-soft" style="background: #06b6d4;">Level 3: Intro to Coding</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Visual Programming</h4>
                                <p class="text-white-50 small">Mulai memprogram otak robot (Brain Brick) menggunakan coding blok. Belajar urutan perintah (Algorithm).</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Auto-Stop Bot</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-success-soft" style="background: #10b981;">Level 4: Sensors</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Sensing World</h4>
                                <p class="text-white-50 small">Memanfaatkan sensor Jarak (Ultrasonic), Warna, dan Sentuh agar robot bisa berinteraksi dengan lingkungan.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Obstacle Avoider</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-advance" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-danger-soft" style="background: #ef4444;">Level 5: Competition</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Line Follower & Sumo</h4>
                                <p class="text-white-50 small">Pemrograman logika tingkat lanjut (PID Controller) untuk kompetisi robot cepat dan robot petarung.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 6 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Sumo Bot</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-navy-dark border-top border-secondary position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(0,97,242,0.15) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">Anak Anda Suka Lego & Merakit?</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">Salurkan hobi mereka menjadi keahlian teknologi masa depan.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">Daftar Free Trial</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> Tanya Admin</a>
        </div>
    </div>
</section>

@endsection
