<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Beta Badri Education</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/admin/navbar.css') }}?v=4" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}?v=4" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <style>
        .animate-pulse {
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 5px rgba(220, 53, 69, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
        }

        .x-small { font-size: 0.65rem; }

        /* PERBAIKAN ICON KALENDER UNTUK INPUT DATE */
        input[type="date"] {
            color-scheme: dark; /* Memaksa browser menggunakan UI Date Picker mode gelap */
        }

        /* Fallback jika browser tidak mendukung color-scheme */
        .form-control-dark::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
            opacity: 0.8;
        }
        .form-control-dark::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>

    @stack('styles')
</head>
<body class="admin-body">

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <nav class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a href="{{ url('/') }}" class="d-block text-center">
                <img src="{{ asset('img/logo-betabadri-dark.png') }}" alt="Logo Admin" class="img-fluid" style="max-height: 40px;">
            </a>
            <button class="btn btn-icon-only d-lg-none text-white position-absolute end-0 top-0 mt-3 me-3" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sidebar-menu-wrapper custom-scrollbar">
            <div class="sidebar-menu">
                <div class="menu-label">Main Menu</div>

                @php
                    $role = auth()->user()->role;

                    if ($role === 'mentor') {
                        $dashRoute = route('mentor.dashboard');
                        $dashActive = request()->routeIs('mentor.dashboard');
                    } else {
                        $dashRoute = route('admin.dashboard');
                        $dashActive = request()->routeIs('admin.dashboard');
                    }
                @endphp

                <a href="{{ $dashRoute }}" class="nav-link {{ $dashActive ? 'active' : '' }}">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>

                @if($role === 'admin' || $role === 'staff')
                    <div class="menu-label mt-4">Marketing & Konten</div>

                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="fas fa-quote-right"></i> <span>Testimoni</span>
                    </a>
                    <a href="{{ route('admin.partners.index') }}" class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i> <span>Partners</span>
                    </a>
                    <a href="{{ route('admin.mentors.index') }}" class="nav-link {{ request()->routeIs('admin.mentors.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i> <span>Data Mentor</span>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i> <span>Galeri</span>
                    </a>
                @endif

                @if($role === 'admin' || $role === 'mentor')
                    <div class="menu-label mt-4">Akademik</div>
                    <a href="{{ route('admin.schools.index') }}" class="nav-link {{ request()->routeIs('admin.schools.*') ? 'active' : '' }}">
                        <i class="fas fa-school"></i> <span>Data Sekolah</span>
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i> <span>Data Siswa</span>
                    </a>
                @endif

                @if($role === 'mentor')
                    <div class="menu-label mt-4">Area Pengajar</div>

                    <a href="{{ route('mentor.activity.index') }}" class="nav-link {{ request()->routeIs('mentor.activity.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i> <span>Aktivitas KBM</span>
                    </a>
                    <a href="{{ route('mentor.grades.index') }}" class="nav-link {{ request()->routeIs('mentor.grades.*') ? 'active' : '' }}">
                        <i class="fas fa-star-half-alt"></i> <span>Input Nilai Project</span>
                    </a>
                @endif

                {{-- ========================================= --}}
                {{-- MENU ARSIP DIGITAL (AKSES SEMUA ROLE) --}}
                {{-- ========================================= --}}
                <div class="menu-label mt-4">Arsip Digital</div>

                <a href="{{ route('admin.documents.index') }}" class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> <span>Pusat Dokumen</span>
                </a>

                <div class="menu-label mt-4">Kepegawaian</div>

                {{-- Menu Absensi (Sekarang untuk SEMUA ROLE) --}}
                <a href="{{ route('admin.attendance.index') }}" class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }} d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fas fa-calendar-check"></i>
                        <span>Absensi Kantor</span>
                    </div>

                    @if($role === 'admin' && isset($attendanceNotification) && $attendanceNotification > 0)
                        <span class="badge rounded-pill bg-danger animate-pulse" style="font-size: 0.65rem;">
                            {{ $attendanceNotification }}
                        </span>
                    @endif
                </a>

                {{-- Menu Cuti (Semua Role) --}}
                <a href="{{ route('admin.leaves.index') }}" class="nav-link {{ request()->routeIs('admin.leaves.*') ? 'active' : '' }} d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fas fa-plane-departure"></i>
                        <span>Pengajuan Cuti</span>
                    </div>

                    @if($role === 'admin' && isset($pendingLeaveCount) && $pendingLeaveCount > 0)
                        <span class="badge rounded-pill bg-warning text-dark animate-pulse" style="font-size: 0.65rem;">
                            {{ $pendingLeaveCount }}
                        </span>
                    @endif
                </a>

                <div class="menu-label mt-4">Keuangan</div>
                <a href="{{ route('admin.expenses.index') }}" class="nav-link {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar"></i> <span>Cashout PT</span>
                </a>

                @if($role === 'admin')
                    <a href="{{ route('admin.finance.index') }}" class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}">
                        <i class="fas fa-wallet"></i> <span>Laporan Keuangan</span>
                    </a>
                    <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> <span>Master Harga</span>
                    </a>

                    <div class="menu-label mt-4">Konfigurasi</div>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i> <span>Manajemen User</span>
                    </a>
                    <a href="{{ route('admin.careers.index') }}" class="nav-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase"></i> <span>Data Karir</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-logout w-100 text-start d-flex align-items-center gap-3">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        <header class="top-navbar shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn-toggle-sidebar d-lg-none border-0 bg-transparent text-white" onclick="toggleSidebar()">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div class="admin-title">
                    <h5 class="mb-0 text-white fw-bold">@yield('title', 'Dashboard')</h5>
                    <small class="text-white-50" style="font-size: 0.8rem;">
                        Selamat datang, <span class="text-warning">{{ auth()->user()->name ?? 'Guest' }}</span>
                    </small>
                </div>
            </div>

            <div class="admin-profile d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="text-white fw-bold small">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="text-white-50 x-small text-uppercase">{{ auth()->user()->role ?? 'Role' }}</div>
                </div>
                <div class="profile-pic bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                     style="width: 40px; height: 40px; cursor: default; background: linear-gradient(45deg, #4361ee, #4cc9f0);">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <div class="content-body p-4">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            // PASTIKAN CLASS INI SAMA DENGAN DI CSS (@media max-width: 991.98px)
            sidebar.classList.toggle('mobile-active');
            overlay.classList.toggle('active');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector('.sidebar-menu-wrapper');
            if (sidebarWrapper) {
                const storedScroll = localStorage.getItem('sidebarScrollPos');
                if (storedScroll) {
                    sidebarWrapper.scrollTop = storedScroll;
                }
                window.addEventListener('beforeunload', function() {
                    localStorage.setItem('sidebarScrollPos', sidebarWrapper.scrollTop);
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
