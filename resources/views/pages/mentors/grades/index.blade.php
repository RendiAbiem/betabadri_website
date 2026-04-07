@extends('layouts.admins')

@section('title', 'Riwayat Penilaian Project')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-star-half-alt text-warning me-2"></i>Riwayat Penilaian
            </h4>
            <p class="text-secondary small m-0">Daftar nilai project siswa yang sudah Anda input.</p>
        </div>
        <div>
            <a href="{{ route('mentor.grades.create') }}" class="btn btn-warning btn-sm px-4 fw-bold shadow-sm rounded-pill text-dark">
                <i class="fas fa-plus me-2"></i> Input Nilai Baru
            </a>
        </div>
    </div>

    <div class="content-card shadow-lg">
        <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center bg-black bg-opacity-20">
            <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                <i class="fas fa-list-ul me-2 text-secondary"></i>DAFTAR NILAI TERBARU
            </h6>
            </div>

        <div class="card-body-tech p-0">
            <div class="table-responsive">
                <table class="table table-dark-custom m-0 align-middle">
                    <thead>
                        <tr class="text-secondary small text-uppercase letter-spacing-1 bg-dark bg-opacity-50">
                            <th class="ps-4 py-3" width="15%">Tanggal Input</th>
                            <th width="30%">Info Project & Sekolah</th>
                            <th width="20%">Nama Siswa</th>
                            <th width="20%">Catatan Mentor</th>
                            <th class="text-center" width="15%">Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                            @php
                                $avg = ($grade->score_attitude + $grade->score_skill + $grade->score_knowledge) / 3;
                                // Tentukan warna badge berdasarkan nilai
                                if($avg >= 90) $badgeClass = 'bg-success text-white';
                                elseif($avg >= 75) $badgeClass = 'bg-primary text-white';
                                else $badgeClass = 'bg-danger text-white';
                            @endphp
                        <tr class="hover-row border-bottom border-secondary border-opacity-10 transition-all">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-square bg-dark bg-opacity-50 text-secondary me-3 rounded-2 d-flex align-items-center justify-content-center border border-secondary border-opacity-10" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">{{ $grade->created_at->format('d') }}</span>
                                    </div>
                                    <div>
                                        <div class="text-white fw-bold small">{{ $grade->created_at->format('M Y') }}</div>
                                        <small class="text-secondary x-small">{{ $grade->created_at->format('H:i') }} WIB</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h6 class="text-white mb-1 fw-bold small">
                                    <i class="fas fa-cube me-1 text-warning x-small"></i> {{ $grade->project_name }}
                                </h6>
                                <div class="d-flex flex-column gap-1">
                                    <small class="text-secondary x-small">
                                        <i class="fas fa-school me-1 text-secondary opacity-50"></i> {{ $grade->student->school->name ?? '-' }}
                                    </small>
                                    <small class="text-info x-small">
                                        <i class="fas fa-code me-1 text-info opacity-50"></i> {{ $grade->program->name ?? '-' }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial me-2 rounded-circle bg-dark border border-secondary border-opacity-25 d-flex align-items-center justify-content-center text-white x-small fw-bold" style="width: 30px; height: 30px;">
                                        {{ strtoupper(substr($grade->student->name, 0, 1)) }}
                                    </div>
                                    <span class="text-white small fw-medium">{{ $grade->student->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($grade->notes)
                                    <div class="p-2 rounded bg-dark bg-opacity-50 border border-secondary border-opacity-10">
                                        <p class="text-white-50 x-small fst-italic mb-0 text-truncate" style="max-width: 200px;" title="{{ $grade->notes }}">
                                            "{{ Str::limit($grade->notes, 40) }}"
                                        </p>
                                    </div>
                                @else
                                    <span class="text-secondary x-small opacity-50">- Tidak ada catatan -</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-pill px-3 py-1 fw-bold small mb-1 border border-light border-opacity-10 {{ $badgeClass }}">
                                        {{ number_format($avg, 1) }}
                                    </div>
                                    <small class="text-secondary x-small">Rata-rata</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="opacity-50">
                                    <i class="fas fa-clipboard-list fa-3x mb-3 text-secondary"></i>
                                    <h6 class="text-secondary">Belum ada data nilai.</h6>
                                    <a href="{{ route('mentor.grades.create') }}" class="btn btn-link text-warning text-decoration-none small">
                                        Input nilai pertama Anda
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($grades->hasPages())
        <div class="card-footer-tech p-4 border-top border-secondary border-opacity-10 bg-black bg-opacity-20">
            <div class="d-flex justify-content-between align-items-center">
                <p class="small text-secondary mb-0">
                    Halaman <b>{{ $grades->currentPage() }}</b> dari <b>{{ $grades->lastPage() }}</b>
                </p>
                <div>
                    {{ $grades->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Utility Classes */
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }

    .hover-row:hover { background: rgba(245, 158, 11, 0.03) !important; } /* Hover effect warna warning/kuning tipis */
    .transition-all { transition: all 0.2s ease; }
</style>
@endsection
