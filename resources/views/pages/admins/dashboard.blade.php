@extends('layouts.admins')

@section('title', 'Dashboard')
@section('page-title', 'Overview Dashboard')

@section('content')

{{-- ========================================== --}}
{{-- 1. SECTION WIDGET STATISTIK (WARNA-WARNI) --}}
{{-- ========================================== --}}
<div class="row g-4 mb-4">

    {{-- KARTU 1: TOTAL SISWA (BIRU) --}}
    <div class="col-md-3">
        <div class="stat-card bg-blue-gradient">
            <div class="stat-content">
                <p class="text-white-50 small mb-1 text-uppercase fw-bold">Total Siswa</p>
                <h3 class="text-white fw-bold mb-0">{{ $total_students }}</h3>
                <small class="text-white-50"><i class="fas fa-users me-1"></i> Seluruh Data</small>
            </div>
            <div class="stat-icon text-primary bg-white bg-opacity-25">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    {{-- KARTU 2: SISWA AKTIF (CYAN/TOSCA) --}}
    <div class="col-md-3">
        <div class="stat-card bg-cyan-gradient">
            <div class="stat-content">
                <p class="text-white-50 small mb-1 text-uppercase fw-bold">Siswa Aktif</p>
                <h3 class="text-white fw-bold mb-0">{{ $activeStudents }}</h3>
                <small class="text-white-50"><i class="fas fa-check-circle me-1"></i> Sedang Belajar</small>
            </div>
            <div class="stat-icon text-info bg-white bg-opacity-25">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>

    {{-- KARTU 3: TOTAL SEKOLAH (UNGU) --}}
    <div class="col-md-3">
        <div class="stat-card bg-purple-gradient">
            <div class="stat-content">
                <p class="text-white-50 small mb-1 text-uppercase fw-bold">Total Sekolah</p>
                <h3 class="text-white fw-bold mb-0">{{ $total_schools }}</h3>
                <small class="text-white-50"><i class="fas fa-handshake me-1"></i> Mitra Terdaftar</small>
            </div>
            <div class="stat-icon text-warning bg-white bg-opacity-25">
                <i class="fas fa-school"></i>
            </div>
        </div>
    </div>

    {{-- KARTU 4: PEMASUKAN (HIJAU) - KHUSUS ADMIN --}}
    @if(auth()->user()->role === 'admin')
    <div class="col-md-3">
        <div class="stat-card bg-green-gradient">
            <div class="stat-content">
                <p class="text-white-50 small mb-1 text-uppercase fw-bold">Pemasukan (Bln)</p>
                <h3 class="text-white fw-bold mb-0">{{ $monthly_revenue }}</h3>
                <small class="text-white-50"><i class="fas fa-chart-line me-1"></i> Cashflow Aman</small>
            </div>
            <div class="stat-icon text-success bg-white bg-opacity-25">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>
    @endif

</div>

{{-- ========================================== --}}
{{-- 2. SECTION KONTEN UTAMA (TABEL & SIDEBAR) --}}
{{-- ========================================== --}}
<div class="row g-4">

    {{-- KOLOM KIRI: TABEL PENDAFTARAN SISWA TERBARU --}}
    <div class="col-lg-8">
        <div class="content-card mb-4 h-100"> {{-- h-100 agar tinggi sama rata --}}

            {{-- Header Card --}}
            <div class="card-header d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary border-opacity-25 pb-3">
                <h6 class="text-white fw-bold mb-0">
                    <i class="fas fa-user-plus text-primary me-2"></i> Pendaftaran Siswa Terbaru
                </h6>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
            </div>

            {{-- Tabel Responsif --}}
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr class="text-uppercase text-secondary x-small fw-bold">
                            <th>Nama Siswa</th>
                            <th>Program</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_students as $student)
                        <tr>
                            {{-- Kolom Nama & Sekolah --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-pic-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 35px; height: 35px;">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">{{ $student->name }}</div>
                                        <small class="text-secondary" style="font-size: 0.75rem;">{{ $student->school->name ?? 'Umum / Pribadi' }}</small>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Program --}}
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-1 rounded-pill">
                                    {{ $student->program->name ?? '-' }}
                                </span>
                            </td>

                            {{-- Kolom Tanggal --}}
                            <td class="text-secondary small">
                                <i class="far fa-calendar-alt me-1"></i> {{ $student->created_at->format('d M Y') }}
                            </td>

                            {{-- Kolom Status --}}
                            <td>
                                @if($student->is_active)
                                    <span class="badge bg-success rounded-pill px-3"><i class="fas fa-check-circle me-1"></i> Aktif</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3">Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <div class="opacity-50">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="m-0">Belum ada pendaftaran siswa baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: KEHADIRAN HARI INI --}}
    <div class="col-lg-4">
        <div class="content-card h-100">

            {{-- Header Card --}}
            <div class="card-header border-bottom border-secondary border-opacity-25 pb-3 mb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white fw-bold mb-0">
                    <i class="fas fa-clock text-success me-2"></i> Kehadiran Hari Ini
                </h6>
                <small class="text-secondary badge bg-dark border border-secondary">{{ date('d M Y') }}</small>
            </div>

            {{-- List Kehadiran --}}
            <div class="attendance-list">
                @forelse($todays_attendance as $attendance)
                    <div class="d-flex align-items-center mb-3 p-2 rounded hover-bg-dark transition-all">
                        {{-- Avatar --}}
                        <div class="profile-pic-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            {{ substr($attendance->user->name ?? 'X', 0, 1) }}
                        </div>

                        {{-- Info User --}}
                        <div class="flex-grow-1">
                            <h6 class="text-white small fw-bold mb-0">{{ $attendance->user->name ?? 'User Terhapus' }}</h6>
                            <small class="text-success" style="font-size: 0.75rem;">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk: {{ $attendance->created_at->format('H:i') }} WIB
                            </small>
                        </div>

                        {{-- Icon Check --}}
                        <span class="badge bg-success bg-opacity-25 text-success rounded-circle p-2">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>
                @empty
                    <div class="text-center py-5 text-secondary opacity-75">
                        <div class="mb-3">
                            <i class="fas fa-user-clock fa-3x text-secondary opacity-25"></i>
                        </div>
                        <h6 class="text-white-50">Belum ada data absen</h6>
                        <p class="small m-0">Data kehadiran hari ini masih kosong.</p>
                    </div>
                @endforelse
            </div>

            {{-- Footer Link --}}
            <div class="mt-auto pt-3 text-center border-top border-secondary border-opacity-10">
                <a href="{{ route('admin.attendance.index') }}" class="text-cyan small text-decoration-none fw-bold hover-underline">
                    Lihat Rekap Absensi Lengkap <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
