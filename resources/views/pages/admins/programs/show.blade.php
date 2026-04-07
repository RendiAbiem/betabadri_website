@extends('layouts.admins')

@section('title', 'Detail Program Sekolah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Detail Program Sekolah</h4>
        <p class="text-secondary small mb-0">Informasi biaya, pembagian fee, dan profitabilitas.</p>
    </div>
    <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-6 col-lg-5">
        <div class="content-card p-4">

            <div class="d-flex align-items-center mb-4 pb-4 border-bottom border-secondary border-opacity-25">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    {{ substr($program->school->name ?? '?', 0, 1) }}
                </div>
                <div>
                    <h6 class="text-white fw-bold mb-0">{{ $program->school->name ?? 'Sekolah Terhapus' }}</h6>
                    <small class="text-secondary">Program Khusus Sekolah Ini</small>
                </div>
            </div>

            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center border border-primary border-opacity-25" style="width: 80px; height: 80px;">
                    <i class="fas fa-tags fa-2x"></i>
                </div>
                <h3 class="text-white mt-3 fw-bold">{{ $program->name }}</h3>

                <div class="mt-2">
                    @if($program->payment_type == 'Per Siswa')
                        <span class="badge bg-navy-lighter text-info border border-info border-opacity-25 rounded-pill px-3 py-2">
                            <i class="fas fa-calendar-alt me-1"></i> Per Siswa
                        </span>
                    @elseif($program->payment_type == 'Per Semester')
                        <span class="badge bg-navy-lighter text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Per Semester
                        </span>
                    @else
                        <span class="badge bg-navy-lighter text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">
                            <i class="fas fa-file-invoice-dollar me-1"></i> {{ $program->payment_type }}
                        </span>
                    @endif
                </div>
            </div>

            <ul class="list-group list-group-flush bg-transparent mt-4">
                <li class="list-group-item bg-transparent text-white d-flex justify-content-between border-secondary border-opacity-25 px-0 py-3">
                    <span class="text-secondary small text-uppercase fw-bold ls-1">Harga ke Siswa</span>
                    <span class="fw-bold text-cyan">Rp {{ number_format($program->price, 0, ',', '.') }}</span>
                </li>
                <li class="list-group-item bg-transparent text-white d-flex justify-content-between border-secondary border-opacity-25 px-0 py-3">
                    <span class="text-secondary small text-uppercase fw-bold ls-1">Fee untuk Sekolah</span>
                    <span class="fw-bold text-danger">Rp {{ number_format($program->school_fee, 0, ',', '.') }}</span>
                </li>

                <li class="list-group-item bg-navy-lighter text-white d-flex justify-content-between border border-success border-opacity-10 rounded-3 px-3 py-3 my-2">
                    <span class="text-success small text-uppercase fw-bold ls-1">Netto (Profit Kotor)</span>
                    <span class="fw-bold text-success" style="font-size: 1.1rem;">
                        Rp {{ number_format($program->price - $program->school_fee, 0, ',', '.') }}
                    </span>
                </li>

                <li class="list-group-item bg-transparent text-white d-flex justify-content-between border-0 px-0 py-3">
                    <span class="text-secondary small text-uppercase fw-bold ls-1">Dibuat Pada</span>
                    <span class="text-white-50">{{ $program->created_at->format('d M Y') }}</span>
                </li>
            </ul>

            <div class="mt-4 d-grid gap-2">
                <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-primary fw-bold shadow-sm">
                    <i class="fas fa-pen me-2"></i> Edit Data Program
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="content-card border-start border-4 border-info">
            <h6 class="text-white fw-bold mb-3"><i class="fas fa-chart-line me-2 text-info"></i>Informasi</h6>
            <div class="text-secondary small">
                <p>Program ini terikat secara khusus dengan sekolah yang tertera di atas.</p>
                <hr class="border-secondary opacity-25">
                <p>Harga <strong>Netto</strong> adalah pendapatan bersih lembaga setelah dikurangi setoran wajib (Fee) ke pihak sekolah.</p>
            </div>
        </div>
    </div>
</div>

@endsection
