@extends('layouts.admins')

@section('title', 'Detail Pengajuan Cuti')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-white fw-bold">Detail Pengajuan</h4>
        <p class="text-secondary small mb-0">Informasi lengkap permohonan cuti / izin.</p>
    </div>
    <a href="{{ route('admin.leaves.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="content-card shadow-sm p-4 text-center h-100">
            <div class="avatar-initial mx-auto rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mb-3 shadow"
                 style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #4361ee, #4cc9f0);">
                {{ strtoupper(substr($leave->user->name, 0, 1)) }}
            </div>
            <h5 class="text-white fw-bold mb-1">{{ $leave->user->name }}</h5>
            <p class="text-info small text-uppercase letter-spacing-1 fw-bold mb-4">{{ $leave->user->role }}</p>

            <div class="border-top border-secondary border-opacity-25 pt-4">
                <p class="text-secondary x-small text-uppercase fw-bold mb-2">Status Pengajuan</p>
                @if($leave->status == 'pending')
                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6 w-100 shadow-sm">Menunggu Review</span>
                @elseif($leave->status == 'approved')
                    <span class="badge bg-success px-4 py-2 rounded-pill fs-6 w-100 shadow-sm"><i class="fas fa-check me-1"></i> Disetujui</span>
                @else
                    <span class="badge bg-danger px-4 py-2 rounded-pill fs-6 w-100 shadow-sm"><i class="fas fa-times me-1"></i> Ditolak</span>
                @endif
            </div>

            @if($leave->status == 'rejected' && $leave->admin_note)
            <div class="mt-4 p-3 bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded text-start">
                <p class="text-danger x-small fw-bold text-uppercase mb-1">Catatan Penolakan Admin:</p>
                <p class="text-white small mb-0 fst-italic">"{{ $leave->admin_note }}"</p>
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-8">
        <div class="content-card shadow-sm p-4 p-md-5 h-100">
            <h6 class="text-cyan fw-bold border-bottom border-secondary border-opacity-25 pb-3 mb-4">Informasi Cuti</h6>

            <div class="row mb-4">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <p class="text-secondary x-small text-uppercase fw-bold mb-1">Jenis Cuti</p>
                    <h6 class="text-white">{{ $leave->type }}</h6>
                </div>
                <div class="col-sm-6">
                    <p class="text-secondary x-small text-uppercase fw-bold mb-1">Total Waktu</p>
                    <h6 class="text-white">{{ $leave->total_days }} Hari</h6>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <p class="text-secondary x-small text-uppercase fw-bold mb-1">Tanggal Mulai</p>
                    <div class="d-flex align-items-center text-white">
                        <i class="fas fa-calendar-check text-primary me-2"></i> {{ \Carbon\Carbon::parse($leave->start_date)->format('d F Y') }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <p class="text-secondary x-small text-uppercase fw-bold mb-1">Tanggal Selesai</p>
                    <div class="d-flex align-items-center text-white">
                        <i class="fas fa-calendar-times text-danger me-2"></i> {{ \Carbon\Carbon::parse($leave->end_date)->format('d F Y') }}
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-secondary x-small text-uppercase fw-bold mb-2">Alasan / Keterangan</p>
                <div class="p-3 bg-dark border border-secondary border-opacity-25 rounded text-white-50">
                    {{ $leave->reason }}
                </div>
            </div>

            <div class="mb-0">
                <p class="text-secondary x-small text-uppercase fw-bold mb-2">Dokumen Pendukung</p>
                @if($leave->attachment)
                    <a href="{{ asset('storage/'.$leave->attachment) }}" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-paperclip me-2"></i> Lihat / Unduh Dokumen
                    </a>
                @else
                    <span class="text-secondary small fst-italic">- Tidak ada dokumen dilampirkan -</span>
                @endif
            </div>

            @if(auth()->user()->role === 'admin' && $leave->status == 'pending')
            <div class="d-flex gap-2 pt-4 mt-4 border-top border-secondary border-opacity-25">
                <button class="btn btn-danger px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#rejectModal">Tolak Pengajuan</button>
                <form action="{{ route('admin.leaves.approve', $leave->id) }}" method="POST" class="ms-auto">
                    @csrf @method('PUT')
                    <button type="submit" class="btn btn-success px-4 fw-bold" onclick="return confirm('Setujui pengajuan ini?')">Setujui Pengajuan</button>
                </form>
            </div>
            @endif

        </div>
    </div>
</div>

@if(auth()->user()->role === 'admin' && $leave->status == 'pending')
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
            <form action="{{ route('admin.leaves.reject', $leave->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body p-4 text-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex p-3 mb-3">
                        <i class="fas fa-times fa-2x"></i>
                    </div>
                    <h6 class="text-white fw-bold mb-3">Tolak Pengajuan?</h6>
                    <textarea name="admin_note" class="form-control bg-dark text-white border-secondary mb-3" rows="3" placeholder="Alasan penolakan..." required></textarea>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary flex-grow-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger flex-grow-1 fw-bold">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<style>
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }
</style>
@endsection
