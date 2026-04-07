@extends('layouts.admins')

@section('title', 'Riwayat Cuti & Izin')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="mb-1 text-white fw-bold">Riwayat Pengajuan Cuti</h4>
        <p class="text-secondary small mb-0">Daftar permohonan izin dan cuti kerja.</p>
    </div>
    <div>
        <a href="{{ route('admin.leaves.create') }}" class="btn btn-primary fw-bold shadow-sm rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Buat Pengajuan
        </a>
    </div>
</div>

{{-- ALERT SUCCESS & ERROR --}}
@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="content-card shadow-lg">
    <div class="card-header border-bottom border-secondary border-opacity-25 p-4 bg-black bg-opacity-20">
        <h6 class="text-white fw-bold mb-0 text-uppercase letter-spacing-1"><i class="fas fa-history text-success me-2"></i> Daftar Pengajuan</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary x-small text-uppercase">
                    <th class="ps-4">Pemohon</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th class="text-center">Total Hari</th>
                    <th class="text-center">Status</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $item)
                <tr class="border-bottom border-secondary border-opacity-10 hover-row">
                    <td class="ps-4">
                        <div class="text-white fw-bold">{{ $item->user->name }}</div>
                        <div class="text-secondary x-small">{{ ucfirst($item->user->role) }}</div>
                    </td>
                    <td>
                        <span class="badge bg-dark border border-secondary text-info fw-bold">{{ $item->type }}</span>
                    </td>
                    <td>
                        <div class="text-white small">
                            {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                            <span class="text-secondary mx-1">-</span>
                            {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="text-white fw-bold">{{ $item->total_days }}</span> <span class="text-secondary x-small">Hari</span>
                    </td>
                    <td class="text-center">
                        @if($item->status == 'pending')
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3">Menunggu</span>
                        @elseif($item->status == 'approved')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">Disetujui</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3" title="{{ $item->admin_note }}">Ditolak</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.leaves.show', $item->id) }}" class="btn btn-sm btn-outline-info rounded-circle" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if(auth()->user()->role === 'admin' && $item->status == 'pending')
                                <form action="{{ route('admin.leaves.approve', $item->id) }}" method="POST" onsubmit="return confirm('Setujui pengajuan ini?')">
                                    @csrf @method('PUT')
                                    <button class="btn btn-sm btn-outline-success rounded-circle" title="Setujui"><i class="fas fa-check"></i></button>
                                </form>
                                <button class="btn btn-sm btn-outline-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#rejectModal{{$item->id}}" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>

                {{-- Modal Penolakan Admin --}}
                @if(auth()->user()->role === 'admin' && $item->status == 'pending')
                <div class="modal fade" id="rejectModal{{$item->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                            <form action="{{ route('admin.leaves.reject', $item->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body p-4 text-center">
                                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex p-3 mb-3">
                                        <i class="fas fa-times fa-2x"></i>
                                    </div>
                                    <h6 class="text-white fw-bold mb-3">Tolak Pengajuan?</h6>
                                    <textarea name="admin_note" class="form-control bg-dark text-white border-secondary mb-3" rows="3" placeholder="Tulis alasan penolakan..." required></textarea>
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

                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="fas fa-file-alt fa-3x mb-3 text-secondary"></i>
                            <h6 class="text-white fw-bold">Belum ada riwayat pengajuan cuti.</h6>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($leaves->hasPages())
    <div class="card-footer-tech p-3 border-top border-secondary border-opacity-25">
        {{ $leaves->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .hover-row:hover { background-color: rgba(255, 255, 255, 0.03); }
</style>
@endsection
