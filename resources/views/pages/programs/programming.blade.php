@extends('layouts.app')

@section('title', __('Programming Program Title'))

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/programming-program.jpg') }}'); min-height: 500px;">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-bold">From Scratch to Python</span>
                <h1 class="display-3 fw-bold text-white mb-3">{!! __('Professional Coding Class') !!}</h1>
                <p class="lead text-white-50 mb-4">{{ __('Programming Hero Desc') }}</p>
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
                <h3 class="text-white fw-bold mb-4">{{ __('Why Coding?') }}</h3>
                <p class="text-white-50">{!! __('Why Coding Desc') !!}</p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-brain"></i></div>
                            <span class="text-white small">{{ __('Logic & Algorithm') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-laptop-code"></i></div>
                            <span class="text-white small">{{ __('Web & App Dev') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-gamepad"></i></div>
                            <span class="text-white small">{{ __('Game Development') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="check-icon"><i class="fas fa-chart-line"></i></div>
                            <span class="text-white small">{{ __('Data Science Basic') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h5 class="text-cyan mb-4 text-center">Languages & Tools</h5>
                <div class="tools-grid">
                    <div class="tool-item" data-bs-toggle="tooltip" title="Python"><i class="fab fa-python"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="JavaScript"><i class="fab fa-js"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="HTML5 & CSS3"><i class="fab fa-html5"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Visual Studio Code"><i class="fas fa-code"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Unity Engine"><i class="fab fa-unity"></i></div>
                    <div class="tool-item" data-bs-toggle="tooltip" title="Scratch (Visual)"><i class="fas fa-cat"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="curriculum" class="py-5 bg-black-pearl position-relative">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold">{{ __('Learning Roadmap') }}</h6>
            <h2 class="text-white fw-bold display-5">{!! __('Our Curriculum') !!}</h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-kids-tab" data-bs-toggle="pill" data-bs-target="#pills-kids" type="button">{{ __('Kids (Elem.)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-teen-tab" data-bs-toggle="pill" data-bs-target="#pills-teen" type="button">{{ __('Teens (Junior High)') }}</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-pro-tab" data-bs-toggle="pill" data-bs-target="#pills-pro" type="button">{{ __('Pro (High School/Gen)') }}</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- KIDS TAB -->
            <div class="tab-pane fade show active" id="pills-kids" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Level 1: Visual Logic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Scratch Programming</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 1 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: {{ __('Interactive Story') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Level 2: Game Creator</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Platformer Game</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 2 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Mario-style Game</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEEN TAB -->
            <div class="tab-pane fade" id="pills-teen" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-cyan-soft" style="background: #06b6d4;">Level 3: Intro to Python</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Text-Based Coding</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 3 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: Chatbot Sederhana</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-success-soft" style="background: #10b981;">Level 4: Web Basic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">HTML, CSS & JS</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 4 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('3 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: {{ __('Personal Portfolio') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRO TAB -->
            <div class="tab-pane fade" id="pills-pro" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-danger-soft" style="background: #ef4444;">Level 5: Fullstack Web</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Laravel / React</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 5 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('6 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: {{ __('E-Commerce / App') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-warning-soft" style="background: #f59e0b; color: black;">Level 6: Game Dev</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Unity Engine (C#)</h4>
                                <p class="text-white-50 small">{{ __('Programming Level 6 Desc') }}</p>
                                <hr class="border-secondary">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> {{ __('6 Months') }}</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> {{ __('Project') }}: {{ __('3D Adventure Game') }}</li>
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
        <h2 class="text-white fw-bold mb-4">{{ __('App Dream Question') }}</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">{{ __('App Dream Desc') }}</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">{{ __('Register Free Trial') }}</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> {{ __('Ask Admin') }}</a>
        </div>
    </div>
</section>

@endsection
