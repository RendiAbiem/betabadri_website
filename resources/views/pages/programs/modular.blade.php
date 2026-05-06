@extends('layouts.app')

@section('title', __('Modular Program Title'))

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/program-hero.jpg') }}'); min-height: 500px;">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">{{ __('Best for Kids & Beginners') }}</span>
                <h1 class="display-3 fw-bold text-white mb-3">{!! __('Fun Learning Modular') !!}</h1>
                <p class="lead text-white-50 mb-4">{{ __('Modular Hero Desc') }}</p>
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
                <h3 class="text-white fw-bold mb-4">{{ __('Why Modular?') }}</h3>
                <p class="text-white-50">{!! __('Why Modular Desc') !!}</p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-cogs"></i></div>
                            <span class="text-white small">{{ __('Mechanics (Gears & Levers)') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-puzzle-piece"></i></div>
                            <span class="text-white small">{{ __('Structure & Construction') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-code-branch"></i></div>
                            <span class="text-white small">{{ __('Visual Logic (Block)') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-wifi"></i></div>
                            <span class="text-white small">{{ __('Sensor & Automation') }}</span>
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
            <h6 class="text-uppercase text-cyan fw-bold">{{ __('Learning Roadmap') }}</h6>
            <h2 class="text-white fw-bold display-5">{!! __('Level Tiers') !!}</h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-junior-tab" data-bs-toggle="pill" data-bs-target="#pills-junior" type="button">{{ __('Junior (Grade 1-3)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-senior-tab" data-bs-toggle="pill" data-bs-target="#pills-senior" type="button">{{ __('Senior (Grade 4-6)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-advance-tab" data-bs-toggle="pill" data-bs-target="#pills-advance" type="button">{{ __('Advance (Middle School)') }}</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- JUNIOR TAB -->
            <div class="tab-pane fade show active" id="pills-junior" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Level 1: Mechanic Basic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Structure & Gears</h4>
                                <p class="text-white-50 small">{{ __('Modular Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months (12 Meetings)') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Catapult / Crane</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bagian Senior dan Advance bisa disesuaikan dengan pola yang sama -->
        </div>
    </div>
</section>

<section class="py-5 bg-navy-dark border-top border-secondary position-relative overflow-hidden">
    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">{{ __('Modular Question') }}</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">{{ __('Modular Question Desc') }}</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">{{ __('Register Free Trial') }}</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> {{ __('Ask Admin') }}</a>
        </div>
    </div>
</section>

@endsection
