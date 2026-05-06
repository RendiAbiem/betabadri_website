@extends('layouts.app')

@section('title', __('Electronic Program Title'))

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/electronic-program.jpg') }}'); min-height: 500px;">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-purple text-white px-3 py-2 rounded-pill mb-3 fw-bold" style="background-color: #8b5cf6;">{{ __('Future Engineers') }}</span>
                <h1 class="display-3 fw-bold text-white mb-3">{!! __('Mastering Electronics') !!}</h1>
                <p class="lead text-white-50 mb-4">{{ __('Electronic Hero Desc') }}</p>
                <div class="d-flex gap-3">
                    <a href="#curriculum" class="btn btn-cta-green px-4 py-3">{{ __('View Syllabus') }}</a>
                    <a href="{{ asset('img/proposal.pdf') }}" download="Proposal_Penawaran.pdf" class="btn btn-outline-light px-4 py-3">
                        <i class="fas fa-file-download me-2"></i>{{ __('Download Brochure') }}
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
                <h3 class="text-white fw-bold mb-4">{{ __('Why Electronic?') }}</h3>
                <p class="text-white-50">{{ __('Why Electronic Desc') }}</p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-microchip"></i></div>
                            <span class="text-white small">{{ __('Microcontroller (Robot Brain)') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-bolt"></i></div>
                            <span class="text-white small">{{ __('Current & Voltage') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-burn"></i></div>
                            <span class="text-white small">{{ __('Soldering & Wiring') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-wifi"></i></div>
                            <span class="text-white small">{{ __('IoT (Internet of Things)') }}</span>
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
            <h6 class="text-uppercase text-cyan fw-bold">{{ __('Learning Roadmap') }}</h6>
            <h2 class="text-white fw-bold display-5">{!! __('Skill Tiers') !!}</h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button">{{ __('Basic (Beginner)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-inter-tab" data-bs-toggle="pill" data-bs-target="#pills-inter" type="button">{{ __('Intermediate') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-adv-tab" data-bs-toggle="pill" data-bs-target="#pills-adv" type="button">Advance (IoT)</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- BASIC TAB -->
            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Level 1: Electronics Fund.</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">{{ __('Komponen Dasar') }}</h4>
                                <p class="text-white-50 small">{{ __('Electronic Level 1 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Traffic Light System</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Level 2: Intro to Arduino</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Coding Syntax (C++)</h4>
                                <p class="text-white-50 small">{{ __('Electronic Level 2 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Piano Digital</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INTERMEDIATE TAB -->
            <div class="tab-pane fade" id="pills-inter" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-cyan-soft" style="background: #06b6d4;">Level 3: Sensors & Actuators</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Smart Automation</h4>
                                <p class="text-white-50 small">{{ __('Electronic Level 3 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Radar Pendeteksi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-success-soft" style="background: #10b981;">Level 4: Mobile Robot</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">{{ __('Merakit Robot Car') }}</h4>
                                <p class="text-white-50 small">{{ __('Electronic Level 4 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Bluetooth RC Car</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADVANCE TAB -->
            <div class="tab-pane fade" id="pills-adv" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-danger-soft" style="background: #ef4444;">Level 5: IoT Specialist</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Internet of Things</h4>
                                <p class="text-white-50 small">{{ __('Electronic Level 5 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('6 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Smart Home System</li>
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
    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">{{ __('Inventor Question') }}</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">{{ __('Inventor Desc') }}</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">{{ __('Register Consultation') }}</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> {{ __('Ask Admin') }}</a>
        </div>
    </div>
</section>

@endsection
