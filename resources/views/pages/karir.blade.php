@extends('layouts.app')

@section('title', 'Karir - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('img/career.jpg') }}'); min-height: 400px;">
    <div class="program-bg-overlay"></div>
    <div class="container position-relative z-2">
        <span class="badge bg-warning-glow text-warning px-3 py-2 rounded-pill mb-3 fw-bold border border-warning" data-aos="fade-down">We Are Hiring!</span>
        <h1 class="display-3 fw-bold text-white mb-3" data-aos="fade-up">{!! __('Join Our Team') !!}</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            {{ __('Career Hero Desc') }}
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">
    <div class="container py-5 position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase text-cyan fw-bold letter-spacing-2">{{ __('Available Positions') }}</h6>
            <h3 class="text-white fw-bold">{!! __('Mentor Opportunities') !!}</h3>
        </div>

        <div class="row g-4">
            {{-- Modular --}}
            <div class="col-lg-6" data-aos="fade-up">
                <div class="job-card p-4 d-flex flex-column flex-md-row gap-4 align-items-start h-100">
                    <div class="job-icon-wrapper bg-red-soft"><i class="fas fa-cubes"></i></div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="text-white fw-bold mb-0 h5">{{ __('Robotic Modular Mentor') }}</h4>
                            <span class="badge bg-success bg-opacity-25 text-success border border-success rounded-pill px-3">Full Time</span>
                        </div>
                        <p class="text-white-50 small mb-3">{{ __('Modular Job Desc') }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="job-tag">{{ __('Patient') }}</span>
                            <span class="job-tag">{{ __('Creative') }}</span>
                            <span class="job-tag">LEGO Education</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-white-50"><i class="fas fa-map-marker-alt me-1"></i> Pekanbaru</small>
                            <a href="#application-form" class="btn btn-sm btn-cta-green px-4 rounded-pill">{{ __('Apply Now') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Electronic --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="job-card p-4 d-flex flex-column flex-md-row gap-4 align-items-start h-100">
                    <div class="job-icon-wrapper bg-purple-soft"><i class="fas fa-microchip"></i></div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="text-white fw-bold mb-0 h5">{{ __('Electronic Mentor') }}</h4>
                            <span class="badge bg-warning bg-opacity-25 text-warning border border-warning rounded-pill px-3">Part Time</span>
                        </div>
                        <p class="text-white-50 small mb-3">{{ __('Electronic Job Desc') }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="job-tag">Arduino</span>
                            <span class="job-tag">IoT</span>
                            <span class="job-tag">Engineering</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-white-50"><i class="fas fa-map-marker-alt me-1"></i> Pekanbaru</small>
                            <a href="#application-form" class="btn btn-sm btn-cta-green px-4 rounded-pill">{{ __('Apply Now') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Programming --}}
            <div class="col-lg-6 mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="job-card p-4 d-flex flex-column flex-md-row gap-4 align-items-start h-100">
                    <div class="job-icon-wrapper bg-cyan-soft"><i class="fas fa-code"></i></div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="text-white fw-bold mb-0 h5">{{ __('Programming Mentor') }}</h4>
                            <span class="badge bg-success bg-opacity-25 text-success border border-success rounded-pill px-3">Full Time</span>
                        </div>
                        <p class="text-white-50 small mb-3">{{ __('Programming Job Desc') }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="job-tag">Python/JS</span>
                            <span class="job-tag">{{ __('Strong Logic') }}</span>
                            <span class="job-tag">IT/CS</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-white-50"><i class="fas fa-map-marker-alt me-1"></i> Pekanbaru</small>
                            <a href="#application-form" class="btn btn-sm btn-cta-green px-4 rounded-pill">{{ __('Apply Now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-white-50">{{ __('Or send CV manually to email') }}: <strong class="text-cyan">Ymnm000@hotmail.com</strong></p>
        </div>
    </div>
</section>

<section id="application-form" class="py-5 bg-black-pearl border-top border-secondary">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper p-4 p-lg-5" data-aos="fade-up">
                    <h3 class="text-white fw-bold mb-4 text-center">{{ __('Application Form') }}</h3>

                    <form action="{{ route('career.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">{{ __('First Name') }} *</label>
                                    <input type="text" name="first_name" class="form-control form-control-dark" required placeholder="{{ __('First Name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" class="form-control form-control-dark" placeholder="{{ __('Last Name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">Email *</label>
                                    <input type="email" name="email" class="form-control form-control-dark" required placeholder="email@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">{{ __('Phone Number') }} *</label>
                                    <input type="tel" name="phone" class="form-control form-control-dark" required placeholder="+62...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">{{ __('Upload CV Desc') }}</label>
                                    <input type="file" name="cv" class="form-control form-control-dark" required>
                                    <small class="text-white-50 fst-italic mt-1 d-block">{{ __('Upload CV Note') }}</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-white-50 small mb-2">{{ __('Additional Message') }}</label>
                                    <textarea name="message" rows="5" class="form-control form-control-dark" placeholder="{{ __('Tell us about your skills') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-4 text-center">
                                <button type="submit" class="btn btn-cta-green btn-lg px-5 w-100 fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> {{ __('Submit Application') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
