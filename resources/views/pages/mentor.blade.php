@extends('layouts.app')

@section('title', 'Tim Pengajar - Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('img/bg-mentor.jpg') }}');">
    <div class="program-bg-overlay"></div>
    <div class="container position-relative z-2">
        <span class="badge bg-cyan-soft text-cyan px-3 py-2 rounded-pill mb-3 fw-bold border border-info" data-aos="fade-down">Expert Instructors</span>
        <h1 class="display-3 fw-bold text-white mb-3" data-aos="fade-up">Meet The <span class="text-gradient-blue">Masters</span></h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            Belajar langsung dari praktisi industri dan edukator berpengalaman.
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">
    <div class="glow-bg-left position-absolute top-0 start-0"></div>

    <div class="container py-5">

        <div class="row mb-5 justify-content-center" data-aos="fade-up">
            <div class="col-md-10 text-center">
                <div class="d-inline-flex flex-wrap justify-content-center gap-2 p-1 rounded-pill bg-black-pearl border border-secondary" id="mentor-filters">
                    <button class="btn btn-sm btn-active-cyan rounded-pill px-4 filter-btn" data-filter="all">All</button>
                    <button class="btn btn-sm btn-ghost text-white-50 rounded-pill px-3 filter-btn" data-filter="modular">Robotic Modular</button>
                    <button class="btn btn-sm btn-ghost text-white-50 rounded-pill px-3 filter-btn" data-filter="electronic">Robotic Electronic</button>
                    <button class="btn btn-sm btn-ghost text-white-50 rounded-pill px-3 filter-btn" data-filter="programming">Programming</button>
                    <button class="btn btn-sm btn-ghost text-white-50 rounded-pill px-3 filter-btn" data-filter="game">Game Dev</button>
                </div>
            </div>
        </div>

        <div class="row g-4" id="mentor-grid">
            @forelse($mentors as $mentor)
            @php
                $role = strtolower($mentor->role);
                $classes = '';

                // --- LOGIKA KATEGORI OTOMATIS BERDASARKAN ROLE ---

                // 1. Game Development
                if (str_contains($role, 'game') || str_contains($role, 'unity') || str_contains($role, '3d')) {
                    $classes .= 'game ';
                }

                // 2. Programming
                if (str_contains($role, 'coding') || str_contains($role, 'program') || str_contains($role, 'web') || str_contains($role, 'software')) {
                    $classes .= 'programming ';
                }

                // 3. Robotic Modular (Keyword: Modular, Lego, atau Robotic umum)
                if (str_contains($role, 'modular') || str_contains($role, 'lego')) {
                    $classes .= 'modular ';
                }

                // 4. Robotic Electronic (Keyword: Electro, IoT, Arduino)
                if (str_contains($role, 'electro') || str_contains($role, 'iot') || str_contains($role, 'arduino') || str_contains($role, 'mikro')) {
                    $classes .= 'electronic ';
                }

                // Fallback: Jika role-nya hanya "Robotics Mentor" (tanpa spesifik Modular/Electro),
                // Kita tampilkan di kedua kategori Robotik agar aman.
                if (str_contains($role, 'robot') && !str_contains($role, 'modular') && !str_contains($role, 'electro')) {
                    $classes .= 'modular electronic ';
                }
            @endphp

            <div class="col-lg-3 col-md-6 mentor-item {{ $classes }}" data-aos="fade-up" data-aos-delay="100">
                <div class="mentor-card h-100">

                    <div class="mentor-img-wrapper position-relative overflow-hidden bg-dark">
                        @if($mentor->image)
                            <img src="{{ asset('storage/' . $mentor->image) }}"
                                 alt="{{ $mentor->name }}"
                                 class="img-fluid w-100 h-100 object-fit-cover transition-scale">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary bg-opacity-25 text-white-50">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-body p-4 text-center">
                        <h5 class="text-white fw-bold mb-1">{{ $mentor->name }}</h5>
                        <p class="text-cyan small mb-3 text-uppercase letter-spacing-1 fw-bold">{{ $mentor->role }}</p>

                        <div class="divider-small mx-auto mb-3"></div>

                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @if(str_contains($classes, 'game'))
                                <span class="skill-badge">Unity</span> <span class="skill-badge">C#</span>
                            @elseif(str_contains($classes, 'programming'))
                                <span class="skill-badge">Python</span> <span class="skill-badge">Web</span>
                            @elseif(str_contains($classes, 'electronic'))
                                <span class="skill-badge">IoT</span> <span class="skill-badge">Arduino</span>
                            @elseif(str_contains($classes, 'modular'))
                                <span class="skill-badge">Lego</span> <span class="skill-badge">Logic</span>
                            @else
                                <span class="skill-badge">Expert</span> <span class="skill-badge">Teacher</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-white-50 py-5">
                <div class="opacity-50">
                    <i class="fas fa-users-slash fa-3x mb-3"></i>
                    <p>Belum ada data mentor yang ditampilkan.</p>
                </div>
            </div>
            @endforelse
        </div>

        <div id="no-mentor-msg" class="text-center text-white-50 py-5 d-none">
            <i class="far fa-sad-tear fa-2x mb-3 opacity-50"></i>
            <p>Tidak ada mentor untuk kategori ini.</p>
        </div>

    </div>
</section>

<section class="py-5 bg-black-pearl border-top border-secondary">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h3 class="text-white fw-bold mb-2">Ingin Bergabung Menjadi Pengajar?</h3>
                <p class="text-white-50 mb-0">Jika kamu memiliki passion di bidang teknologi dan pendidikan, mari berkarya bersama kami.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="https://wa.me/6281376180003" class="btn btn-outline-light btn-lg px-5 rounded-pill">
                    <i class="fas fa-paper-plane me-2"></i> Kirim CV
                </a>
            </div>
        </div>
    </div>
</section>

{{-- JAVASCRIPT FILTER --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const mentorItems = document.querySelectorAll('.mentor-item');
    const noMsg = document.getElementById('no-mentor-msg');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // 1. Ganti Warna Tombol Aktif
            filterBtns.forEach(b => {
                b.classList.remove('btn-active-cyan');
                b.classList.add('btn-ghost', 'text-white-50');
            });
            this.classList.remove('btn-ghost', 'text-white-50');
            this.classList.add('btn-active-cyan');

            // 2. Filter Item
            const filterValue = this.getAttribute('data-filter');
            let visibleCount = 0;

            mentorItems.forEach(item => {
                // Reset animasi
                item.classList.remove('animate__animated', 'animate__fadeIn');

                // Cek apakah item punya class yang sesuai dengan tombol
                if (filterValue === 'all' || item.classList.contains(filterValue)) {
                    item.classList.remove('d-none');
                    void item.offsetWidth; // Trigger reflow untuk restart animasi
                    item.classList.add('animate__animated', 'animate__fadeIn');
                    visibleCount++;
                } else {
                    item.classList.add('d-none');
                }
            });

            // 3. Cek jika hasil 0
            if(visibleCount === 0) noMsg.classList.remove('d-none');
            else noMsg.classList.add('d-none');
        });
    });
});
</script>

<style>
    .mentor-img-wrapper {
        width: 100%;
        height: 300px;
        background-color: #0f172a;
    }
    .transition-scale { transition: transform 0.5s ease; }
    .mentor-card:hover .transition-scale { transform: scale(1.05); }

    .skill-badge {
        font-size: 0.7rem; padding: 4px 12px; border-radius: 20px;
        background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8; display: inline-block;
    }
</style>

@endsection
