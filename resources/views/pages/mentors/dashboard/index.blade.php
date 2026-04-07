@extends('layouts.admins')

@section('title', 'Dashboard Overview')

@section('content')
<div class="container-fluid py-2">

    <div class="row mb-4">
        <div class="col-12">
            <div class="alert-tech d-flex align-items-center p-3 rounded-3 shadow-sm border border-primary border-opacity-25"
                 style="background: rgba(67, 97, 238, 0.1);">
                <div class="alert-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width: 45px; height: 45px; min-width: 45px;">
                    <i class="fas fa-bullhorn fa-lg"></i>
                </div>
                <div class="alert-body w-100">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h6 class="fw-bold text-white mb-0">Pengumuman Admin</h6>
                        <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25" style="font-size: 0.65rem;">INFO TERBARU</span>
                    </div>
                    <p class="mb-0 text-white-50 small">{{ $announcement ?? 'Belum ada pengumuman baru untuk saat ini.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="content-card h-100 shadow-lg border-start border-primary border-4 p-4 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h6 class="text-secondary text-uppercase small fw-bold ls-1 mb-1">Highlight Mengajar</h6>
                        <h3 class="text-white fw-bold mb-0">Statistik Bulanan</h3>
                    </div>
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-chart-pie fa-lg"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50 x-small">Target Jam Mengajar</span>
                        <span class="text-primary fw-bold x-small">75%</span>
                    </div>
                    <div class="progress" style="height: 8px; background: rgba(255,255,255,0.05);">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>

                <div class="row g-3 mt-auto">
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-10">
                            <i class="fas fa-users text-info mb-2"></i>
                            <div class="text-white fw-bold fs-5">1,240</div>
                            <div class="text-secondary x-small">Siswa Hadir</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-10">
                            <i class="fas fa-clock text-warning mb-2"></i>
                            <div class="text-white fw-bold fs-5">48 Jam</div>
                            <div class="text-secondary x-small">Total Mengajar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100 shadow-lg border-start border-success border-4 p-4 d-flex flex-column justify-content-center text-center position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-4 opacity-10">
                    <i class="fas fa-chalkboard-teacher fa-5x text-success"></i>
                </div>

                <h6 class="text-success text-uppercase small fw-bold ls-1 mb-2">Total Sesi Bulan Ini</h6>
                <h1 class="display-3 fw-bold text-white mb-0">{{ $totalSessions ?? 0 }}</h1>
                <p class="text-secondary small mt-2 mb-0">Sesi kelas yang telah diselesaikan</p>

                <div class="mt-4">
                    <a href="{{ route('mentor.activity.index') }}" class="btn btn-outline-success btn-sm rounded-pill px-4">
                        Lihat Riwayat <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100 shadow-lg border-start border-warning border-4 p-0">
                <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                    <h6 class="text-white fw-bold mb-0">
                        <i class="far fa-calendar-check text-warning me-2"></i> Jadwal Hari Ini
                    </h6>
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ now()->format('d M') }}</span>
                </div>

                <div class="card-body-scrollable custom-scrollbar p-0" style="max-height: 250px; overflow-y: auto;">
                    @forelse($todaySchedules ?? [] as $schedule)
                        <div class="p-3 border-bottom border-secondary border-opacity-10 hover-bg-dark">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-dark border border-secondary border-opacity-25 text-white-50 x-small">
                                    <i class="far fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($schedule->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->time_end)->format('H:i') }}
                                </span>
                                <a href="{{ route('mentor.activity.create', ['school_id' => $schedule->school_id, 'program_id' => $schedule->program_id]) }}" class="btn btn-sm btn-icon-only text-success bg-success bg-opacity-10">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <h6 class="text-white fw-bold mb-0 small">{{ $schedule->school->name }}</h6>
                            <p class="text-secondary x-small mb-0">{{ $schedule->program->name }} • {{ $schedule->class_name }}</p>
                        </div>
                    @empty
                        <div class="text-center py-5 px-4">
                            <i class="fas fa-mug-hot fa-2x text-secondary opacity-25 mb-3"></i>
                            <p class="text-secondary x-small mb-0">Tidak ada jadwal hari ini.<br>Selamat beristirahat!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="content-card shadow-lg">
                <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="text-white fw-bold mb-0">Aktivitas Mengajar Terakhir</h5>
                        <p class="text-secondary x-small mb-0">Laporan realtime dari lapangan.</p>
                    </div>
                    <a href="{{ route('mentor.activity.index') }}" class="btn btn-navy-lighter btn-sm px-3">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark-custom align-middle mb-0">
                        <thead>
                            <tr class="text-secondary x-small text-uppercase ls-1">
                                <th class="ps-4 py-3">Sekolah & Kelas</th>
                                <th>Materi Pembelajaran</th>
                                <th>Waktu & Tanggal</th>
                                <th class="text-end pe-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh Data Statis (Ganti dengan Foreach Nanti) --}}
                            <tr class="hover-row border-bottom border-secondary border-opacity-10">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square bg-dark bg-opacity-50 text-white me-3 rounded-2 d-flex align-items-center justify-content-center border border-secondary border-opacity-10" style="width: 35px; height: 35px;">
                                            <span class="fw-bold small">7A</span>
                                        </div>
                                        <div>
                                            <div class="text-white fw-bold small">SMP Negeri 1</div>
                                            <div class="text-secondary x-small">Reguler Program</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-info fw-bold small">Dasar Robotika</span>
                                    <div class="text-secondary x-small">Modul 1: Pengenalan Komponen</div>
                                </td>
                                <td>
                                    <div class="text-white small">24 Des 2025</div>
                                    <div class="text-secondary x-small">08:00 - 09:30 WIB</div>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill x-small">
                                        <i class="fas fa-check-circle me-1"></i> Selesai
                                    </span>
                                </td>
                            </tr>
                            {{-- End Contoh --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .bg-gradient-primary { background: linear-gradient(45deg, #4361ee, #3a0ca3); }

    .icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

    .content-card {
        background: #161625; /* Sesuaikan dengan warna card tema admin Anda */
        border-radius: 12px;
        overflow: hidden;
    }

    .hover-bg-dark:hover { background: rgba(255,255,255,0.02); transition: 0.2s; }

    .btn-icon-only { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; }

    /* Custom Scrollbar untuk Jadwal */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
</style>
@endsection
