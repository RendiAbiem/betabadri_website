@extends('layouts.app')

@section('title', 'Program Robotic Electronic - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/electronic-program.jpg') }}');">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-purple text-white px-3 py-2 rounded-pill mb-3 fw-bold" style="background-color: #8b5cf6;">Future Engineers</span>
                <h1 class="display-3 fw-bold text-white mb-3">Mastering <br><span class="text-gradient-blue">Electronics & IoT</span></h1>
                <p class="lead text-white-50 mb-4">
                    Tingkatkan skill ke level engineer sesungguhnya. Belajar merakit sirkuit, menyolder komponen, dan memprogram otak robot (Microcontroller) dengan bahasa C++.
                </p>
                <div class="d-flex gap-3">
                    <a href="#curriculum" class="btn btn-cta-green px-4 py-3">Lihat Silabus</a>
                    <a href="{{ asset('img/proposal.pdf') }}" download="Proposal_Penawaran.pdf" class="btn btn-outline-light px-4 py-3">
                        <i class="fas fa-file-download me-2"></i>Download Brosur
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-navy-dark">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="text-white fw-bold mb-4">Kenapa Robotik Elektronika?</h3>
                <p class="text-white-50">
                    Di era Industri 4.0, pemahaman tentang Hardware (Fisik) dan Software (Coding) sangat krusial. Program ini menjembatani keduanya. Siswa akan belajar bagaimana listrik bekerja, cara membaca skema elektronik, hingga membuat sistem Rumah Pintar (Smart Home).
                </p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-microchip"></i></div>
                            <span class="text-white small">Microcontroller (Otak Robot)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-bolt"></i></div>
                            <span class="text-white small">Arus & Tegangan Listrik</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-burn"></i></div>
                            <span class="text-white small">Soldering & Wiring</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-wifi"></i></div>
                            <span class="text-white small">IoT (Internet of Things)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h5 class="text-cyan mb-4 text-center">Tech Stack & Components</h5>
                <div class="tools-grid">
                    <div class="tool-item" data-bs-toggle="tooltip" title="Arduino Uno"><i class="fas fa-microchip"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="ESP32 (Wifi)"><i class="fas fa-broadcast-tower"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Sensors Kit"><i class="fas fa-eye"></i></div>

                    <div class="tool-item" data-bs-toggle="tooltip" title="C++ Language"><i class="fab fa-cuttlefish"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Arduino IDE"><i class="fas fa-code"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Multimeter"><i class="fas fa-tools"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="curriculum" class="py-5 bg-black-pearl position-relative">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold">Roadmap Belajar</h6>
            <h2 class="text-white fw-bold display-5">Jenjang <span class="text-gradient-blue">Keahlian</span></h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button">Basic (Pemula)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-inter-tab" data-bs-toggle="pill" data-bs-target="#pills-inter" type="button">Intermediate</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-adv-tab" data-bs-toggle="pill" data-bs-target="#pills-adv" type="button">Advance (IoT)</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent" data-aos="fade-up" data-aos-delay="200">

            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Level 1: Electronics Fund.</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Komponen Dasar</h4>
                                <p class="text-white-50 small">Mengenal resistor, kapasitor, LED, dan hukum Ohm. Merakit rangkaian sederhana di Breadboard.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Traffic Light System</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Level 2: Intro to Arduino</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Coding Syntax (C++)</h4>
                                <p class="text-white-50 small">Mulai menggunakan Arduino Uno. Belajar coding text-based (bukan blok) untuk mengontrol lampu dan suara.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Piano Digital</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-inter" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-cyan-soft" style="background: #06b6d4;">Level 3: Sensors & Actuators</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Smart Automation</h4>
                                <p class="text-white-50 small">Menggunakan sensor cahaya, suhu, jarak, dan menggerakkan Servo motor. Logika otomatisasi (If/Else).</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Radar Pendeteksi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-success-soft" style="background: #10b981;">Level 4: Mobile Robot</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Merakit Robot Car</h4>
                                <p class="text-white-50 small">Membuat chassis, menyolder driver motor, dan memprogram robot Line Follower atau Obstacle Avoider.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Bluetooth RC Car</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-adv" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-danger-soft" style="background: #ef4444;">Level 5: IoT Specialist</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Internet of Things</h4>
                                <p class="text-white-50 small">Menggunakan ESP32/ESP8266. Menghubungkan alat elektronik ke HP (Blynk/Firebase) untuk Smart Home.</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 6 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Smart Home System</li>
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
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(139, 92, 246, 0.15) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">Siap Menjadi Inventor Muda?</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">
            Mulailah perjalanan teknikmu hari ini. Bangun alat canggihmu sendiri dari nol.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">Daftar Konsultasi</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> Tanya Admin</a>
        </div>
    </div>
</section>

@endsection
