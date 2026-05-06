@extends('layouts.app')

@section('title', __('Game Dev Title'))

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/gamedev-hero.jpg') }}'); background-color: #050510; min-height: 500px;">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-purple text-white px-3 py-2 rounded-pill mb-3 fw-bold" style="background-color: #f59e0b;">Game Creators Hub</span>
                <h1 class="display-3 fw-bold text-white mb-3">{!! __('Build Your Dream Games') !!}</h1>
                <p class="lead text-white-50 mb-4">{{ __('Game Hero Desc') }}</p>
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
                <h3 class="text-white fw-bold mb-4">{{ __('Why Game Dev?') }}</h3>
                <p class="text-white-50">{{ __('Why Game Dev Desc') }}</p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(245, 158, 11, 0.2); color: #f59e0b;"><i class="fas fa-gamepad"></i></div>
                            <span class="text-white small">{{ __('Game Design Logic') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(6, 182, 212, 0.2); color: #06b6d4;"><i class="fas fa-shapes"></i></div>
                            <span class="text-white small">{{ __('2D & 3D Assets Design') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(16, 185, 129, 0.2); color: #10b981;"><i class="fas fa-code"></i></div>
                            <span class="text-white small">{{ __('Algorithm & Data Structure') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6;"><i class="fas fa-rocket"></i></div>
                            <span class="text-white small">{{ __('Publishing & Monetization') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h5 class="text-cyan mb-4 text-center">Software & Engines Used</h5>
                <div class="tools-grid">
                    <div class="tool-item" data-bs-toggle="tooltip" title="Scratch (Block Coding)"><i class="fas fa-puzzle-piece"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Python Language"><i class="fab fa-python"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Construct 3"><i class="fas fa-layer-group"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Unity Engine"><i class="fab fa-unity"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="C# Language"><i class="fas fa-code"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Piskel (Pixel Art)"><i class="fas fa-paint-brush"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="curriculum" class="py-5 bg-black-pearl position-relative">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold">{{ __('Learning Roadmap') }}</h6>
            <h2 class="text-white fw-bold display-5">{!! __('Career Path') !!}</h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button">{{ __('Junior (Beginner)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-adv-tab" data-bs-toggle="pill" data-bs-target="#pills-adv" type="button">{{ __('Senior (Professional)') }}</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- JUNIOR TAB -->
            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Phase 1: Visual Logic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Foundational Script</h4>
                                <p class="text-white-50 small">{{ __('Phase 1 Desc') }}</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Catch The Falling Objects</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Phase 2: Python Gaming</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Intro to Syntax</h4>
                                <p class="text-white-50 small">{{ __('Phase 2 Desc') }}</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Space Invader Clone</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SENIOR TAB -->
            <div class="tab-pane fade" id="pills-adv" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header" style="background: #ef4444;">Phase 5: Unity 3D & C#</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Pro-Industry Engine</h4>
                                <p class="text-white-50 small">{{ __('Phase 5 Desc') }}</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('6 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: 3D First Person Survival</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-navy-dark border-top border-secondary border-opacity-25 position-relative overflow-hidden">
    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">{{ __('Realize Dream Question') }}</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">{{ __('Realize Dream Desc') }}</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">{{ __('Daftar Trial Class') }}</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> {{ __('Konsultasi Program') }}</a>
        </div>
    </div>
</section>

@endsection
