@extends('layouts.app')

@section('title', 'Program Game Development - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center" style="background-image: url('{{ asset('img/gamedev-hero.jpg') }}'); background-color: #050510;">
    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-purple text-white px-3 py-2 rounded-pill mb-3 fw-bold" style="background-color: #f59e0b;">Game Creators Hub</span>
                <h1 class="display-3 fw-bold text-white mb-3">Build Your <br><span class="text-gradient-blue">Dream Games</span></h1>
                <p class="lead text-white-50 mb-4">
                    Jangan hanya menjadi pemain, jadilah pembuatnya! Pelajari logika algoritma, desain karakter, hingga mempublikasikan game ciptaanmu sendiri ke platform dunia.
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
                <h3 class="text-white fw-bold mb-4">Mengapa Belajar Game Dev?</h3>
                <p class="text-white-50">
                    Membuat game adalah cara terbaik untuk melatih logika matematika dan kreativitas secara bersamaan. Di Beta Badri, siswa tidak hanya belajar coding, tetapi juga pemecahan masalah (problem solving) yang berguna untuk masa depan mereka.
                </p>

                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(245, 158, 11, 0.2); color: #f59e0b;"><i class="fas fa-gamepad"></i></div>
                            <span class="text-white small">Game Design Logic</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(6, 182, 212, 0.2); color: #06b6d4;"><i class="fas fa-shapes"></i></div>
                            <span class="text-white small">2D & 3D Assets Design</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(16, 185, 129, 0.2); color: #10b981;"><i class="fas fa-code"></i></div>
                            <span class="text-white small">Algorithm & Data Structure</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="check-icon-wrapper d-flex align-items-center gap-3">
                            <div class="check-icon" style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6;"><i class="fas fa-rocket"></i></div>
                            <span class="text-white small">Publishing & Monetization</span>
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
            <h6 class="text-uppercase text-cyan fw-bold">Roadmap Belajar</h6>
            <h2 class="text-white fw-bold display-5">Career <span class="text-gradient-blue">Path</span></h2>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="pills-tab" role="tablist" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button">Junior (Pemula)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2" id="pills-adv-tab" data-bs-toggle="pill" data-bs-target="#pills-adv" type="button">Senior (Professional)</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent" data-aos="fade-up" data-aos-delay="200">

            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-blue-soft">Phase 1: Visual Logic</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Foundational Script</h4>
                                <p class="text-white-50 small">Memahami konsep dasar pemrograman (Loop, Variable, Logic) menggunakan Scratch. Membuat game 2D pertama.</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Catch The Falling Objects</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header bg-purple-soft">Phase 2: Python Gaming</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Intro to Syntax</h4>
                                <p class="text-white-50 small">Beralih dari blok ke teks dengan Python (Pygame). Belajar koordinat layar dan interaksi user.</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Space Invader Clone</li>
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
                            <div class="level-header" style="background: #06b6d4;">Phase 3: 2D Engine</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Advanced Physics</h4>
                                <p class="text-white-50 small">Menggunakan Construct 3 atau GDevelop. Belajar tentang gravitasi, collision, dan sistem nyawa (UI/HUD).</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: Platformer Adventure</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="level-card h-100">
                            <div class="level-header" style="background: #10b981;">Phase 4: Game Design</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Assets Creation</h4>
                                <p class="text-white-50 small">Fokus pada pembuatan karakter (Pixel Art) dan background. Belajar animasi frame-by-frame untuk karakter game.</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 3 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: RPG Character Kit</li>
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
                            <div class="level-header" style="background: #ef4444;">Phase 5: Unity 3D & C#</div>
                            <div class="p-4">
                                <h4 class="text-white fw-bold">Pro-Industry Engine</h4>
                                <p class="text-white-50 small">Membangun game 3D profesional dengan Unity Engine. Mempelajari script C# yang kompleks dan optimasi game.</p>
                                <hr class="border-secondary border-opacity-25">
                                <ul class="list-unstyled text-white-50 small mb-0">
                                    <li><i class="fas fa-clock me-2 text-cyan"></i> 6 Bulan</li>
                                    <li><i class="fas fa-trophy me-2 text-cyan"></i> Project: 3D First Person Survival</li>
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
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(245, 158, 11, 0.1) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="container text-center position-relative z-2">
        <h2 class="text-white fw-bold mb-4">Wujudkan Game Impianmu!</h2>
        <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px;">
            Bergabunglah dengan komunitas developer muda kami. Belajar, berkreasi, dan publikasikan karyamu.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('page/kontak') }}" class="btn btn-cta-green btn-lg px-5">Daftar Trial Class</a>
            <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5"><i class="fab fa-whatsapp me-2"></i> Konsultasi Program</a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Gradient Warna untuk elemen Game Dev */
    .text-gradient-blue {
        background: linear-gradient(90deg, #38bdf8 0%, #818cf8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .level-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .level-card:hover {
        transform: translateY(-10px);
        border-color: #38bdf8;
    }

    .level-header {
        padding: 10px 20px;
        font-weight: bold;
        color: white;
        text-align: center;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .bg-blue-soft { background: #1e3a8a; }
    .bg-purple-soft { background: #581c87; }
</style>
@endpush
