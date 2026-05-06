@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/program-hero.jpg') }}'); min-height: 400px;">
    <div class="program-bg-overlay"></div>
    <div class="container position-relative z-2 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-bold">Beta Badri Curriculum</span>
        <h1 class="display-3 fw-bold text-white mb-3">{{ __('Choose Your Future Path') }}</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
            {{ __('Curriculum Hero Desc') }}
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">
    <div class="tech-line-vertical position-absolute start-50 top-0 h-100 d-none d-lg-block"></div>

    <div class="container py-5">
        <!-- Modular Robotics -->
        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-warning-glow">
                        <i class="fas fa-cubes text-warning"></i>
                    </div>
                    <span class="text-warning fw-bold letter-spacing-2 text-uppercase small">{{ __('For Beginners & kids') }}</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">{{ __('Modular Robotics') }}</h2>
                    <p class="text-white-50 mb-4">{{ __('Modular Desc') }}</p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> {{ __('Age') }}: SD (Grade 1-6)</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> {{ __('Focus: Logic & Mechanics') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> {{ __('Output: Competition Robot') }}</li>
                    </ul>
                    <a href="{{ route('programs.modular') }}" class="btn btn-outline-light rounded-pill px-4">{{ __('View Details') }} <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/robotic.jpg') }}" alt="Modular" class="img-fluid rounded-4 shadow-lg-blue">
                </div>
            </div>
        </div>

        <!-- Electronic Robotics -->
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
                    <span class="text-purple fw-bold letter-spacing-2 text-uppercase small" style="color: #a78bfa;">{{ __('For Future Engineers') }}</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">{{ __('Electronic Robotics') }}</h2>
                    <p class="text-white-50 mb-4">{{ __('Electronic Desc') }}</p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> {{ __('Age') }}: SMP - SMA</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> {{ __('Focus: Hardware & IoT') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-purple me-2"></i> {{ __('Output: Smart Devices') }}</li>
                    </ul>
                    <a href="{{ route('programs.electronika') }}" class="btn btn-outline-light rounded-pill px-4">{{ __('View Details') }} <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <!-- Programming & App -->
        <div class="row align-items-center mb-5 pb-5 program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-cyan-glow">
                        <i class="fas fa-laptop-code text-cyan"></i>
                    </div>
                    <span class="text-cyan fw-bold letter-spacing-2 text-uppercase small">{{ __('For Digital Creators') }}</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">{{ __('Programming & App') }}</h2>
                    <p class="text-white-50 mb-4">{{ __('Programming Desc') }}</p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> {{ __('Age') }}: SD - {{ __('Adult') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> {{ __('Focus: Software & Logic') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i> {{ __('Output: Web/App/Game') }}</li>
                    </ul>
                    <a href="{{ route('programs.programming') }}" class="btn btn-outline-light rounded-pill px-4">{{ __('View Details') }} <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="program-img-wrapper">
                    <img src="{{ asset('img/programming2.jpg') }}" alt="Programming" class="img-fluid rounded-4 shadow-lg-cyan">
                </div>
            </div>
        </div>

        <!-- Game Dev -->
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
                    <span class="text-orange fw-bold letter-spacing-2 text-uppercase small">{{ __('For Game Creators') }}</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">{{ __('Game Development') }}</h2>
                    <p class="text-white-50 mb-4">{{ __('Game Desc') }}</p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> {{ __('Age') }}: SMP - {{ __('Adult') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> {{ __('Focus: 3D Design & C#') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-orange me-2"></i> {{ __('Output: Indie/Studio Game') }}</li>
                    </ul>
                    <a href="{{ route('programs.game') }}" class="btn btn-outline-light rounded-pill px-4">{{ __('View Details') }} <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <!-- Cyber Security -->
        <div class="row align-items-center program-row" data-aos="fade-up">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="pe-lg-5">
                    <div class="icon-box-tech mb-4 bg-red-glow">
                        <i class="fas fa-user-secret text-danger"></i>
                    </div>
                    <span class="text-danger fw-bold letter-spacing-2 text-uppercase small">{{ __('For Future Security Expert') }}</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">{{ __('Cyber Security') }}</h2>
                    <p class="text-white-50 mb-4">{{ __('Cyber Desc') }}</p>
                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> {{ __('Age') }}: SMP - {{ __('Undergrad') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> {{ __('Focus: Network & Defense') }}</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> {{ __('Output: Security Analyst') }}</li>
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

<!-- Table Section -->
<section class="py-5 bg-black-pearl">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="text-white fw-bold">{{ __('Confused Choosing?') }}</h2>
            <p class="text-white-50">{{ __('Comparison Desc') }}</p>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-hover custom-table text-center align-middle">
                <thead>
                    <tr>
                        <th class="py-4 text-start ps-4">{{ __('Feature') }}</th>
                        <th class="py-4 text-warning">Modular</th>
                        <th class="py-4 text-purple">Elektronika</th>
                        <th class="py-4 text-cyan">Programming</th>
                        <th class="py-4 text-danger">Cyber Sec</th>
                        <th class="py-4 text-orange">Game Dev</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start ps-4 fw-bold">{{ __('Age Recommendation') }}</td>
                        <td>SD (7-12)</td>
                        <td>SMP - SMA</td>
                        <td>{{ __('All Ages') }}</td>
                        <td>SMP - Mhs</td>
                        <td>SMP - {{ __('Adult') }}</td>
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
                        <td class="text-start ps-4 fw-bold">{{ __('Difficulty Level') }}</td>
                        <td><i class="fas fa-star text-warning"></i> x2</td>
                        <td><i class="fas fa-star text-warning"></i> x3</td>
                        <td><i class="fas fa-star text-warning"></i> x3</td>
                        <td><i class="fas fa-star text-warning"></i> x5</td>
                        <td><i class="fas fa-star text-warning"></i> x4</td>
                    </tr>
                    <tr>
                        <td class="text-start ps-4 fw-bold">{{ __('Main Output') }}</td>
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
        <h2 class="text-white fw-bold mb-4">{{ __('Still Need Advice?') }}</h2>
        <p class="text-white-50 mb-4">{{ __('Consultant Desc') }}</p>
        <a href="https://wa.me/6281376180003" class="btn btn-cta-green btn-lg px-5">{{ __('Chat Our Consultant') }}</a>
    </div>
</section>

@endsection
