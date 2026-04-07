@extends('layouts.admins')

@section('title', 'Riwayat KBM')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-history text-primary me-2"></i>Riwayat Kegiatan Belajar
            </h4>
            <p class="text-secondary small m-0">Daftar jurnal mengajar yang sudah Anda input.</p>
        </div>
        <div>
            <a href="{{ route('mentor.activity.create') }}" class="btn btn-primary btn-sm px-4 fw-bold shadow-blue rounded-pill">
                <i class="fas fa-plus me-2"></i> Input Jurnal Baru
            </a>
        </div>
    </div>

    <div class="content-card shadow-lg">
        <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center bg-black bg-opacity-20">
            <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                <span class="badge bg-primary me-2">LOG</span> Aktivitas Terakhir
            </h6>
            </div>

        <div class="card-body-tech p-0">
            <div class="table-responsive">
                <table class="table table-dark-custom m-0 align-middle">
                    <thead>
                        <tr class="text-secondary small text-uppercase letter-spacing-1 bg-dark bg-opacity-50">
                            <th class="ps-4 py-3" width="15%">Tanggal</th>
                            <th width="25%">Sekolah & Kelas</th>
                            <th width="35%">Materi (Topic)</th>
                            <th class="text-center" width="15%">Dokumentasi</th>
                            <th class="text-end pe-4" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($journals as $journal)
                        <tr class="hover-row border-bottom border-secondary border-opacity-10 transition-all">
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-square bg-dark bg-opacity-50 text-secondary me-3 rounded-2 d-flex align-items-center justify-content-center border border-secondary border-opacity-10" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">{{ \Carbon\Carbon::parse($journal->date)->format('d') }}</span>
                                    </div>
                                    <div>
                                        <div class="text-white fw-bold small">{{ \Carbon\Carbon::parse($journal->date)->format('M Y') }}</div>
                                        <small class="text-secondary x-small">{{ $journal->created_at->format('H:i') }} WIB</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h6 class="text-white mb-0 fw-bold small">{{ $journal->school->name }}</h6>
                                <div class="d-flex align-items-center mt-1">
                                    <span class="badge bg-navy-lighter text-info border border-info border-opacity-25 x-small me-2">
                                        {{ $journal->class_name }}
                                    </span>
                                    <span class="text-secondary x-small">{{ $journal->program->name }}</span>
                                </div>
                            </td>
                            <td>
                                <p class="text-white-50 mb-0 small text-truncate" style="max-width: 250px;" title="{{ $journal->topic }}">
                                    {{ Str::limit($journal->topic, 60) }}
                                </p>
                            </td>
                            <td class="text-center">
                                @if($journal->photo_proof)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 x-small">
                                        <i class="fas fa-check me-1"></i> Ada
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1 x-small">
                                        <i class="fas fa-times me-1"></i> Kosong
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('mentor.activity.show', $journal->id) }}" class="btn btn-icon-only text-primary btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="opacity-50">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                    <h6 class="text-secondary">Belum ada riwayat mengajar.</h6>
                                    <a href="{{ route('mentor.activity.create') }}" class="btn btn-link text-primary text-decoration-none small">
                                        Mulai input jurnal pertama Anda
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($journals->hasPages())
        <div class="card-footer-tech p-4 border-top border-secondary border-opacity-10 bg-black bg-opacity-20">
            <div class="d-flex justify-content-between align-items-center">
                <p class="small text-secondary mb-0">
                    Menampilkan <b>{{ $journals->firstItem() }}</b> - <b>{{ $journals->lastItem() }}</b> dari <b>{{ $journals->total() }}</b> data
                </p>
                <div>
                    {{ $journals->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Styling Tambahan */
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }

    .hover-row:hover { background: rgba(67, 97, 238, 0.03) !important; }
    .transition-all { transition: all 0.2s ease; }

    .btn-icon-only {
        width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; transition: 0.2s; border: 1px solid transparent;
        background: rgba(255,255,255,0.05);
    }
    .btn-icon-only:hover { background: rgba(67, 97, 238, 0.1); border-color: rgba(67, 97, 238, 0.3); transform: scale(1.05); }

    .shadow-blue { box-shadow: 0 4px 20px -5px rgba(67, 97, 238, 0.4); }
    .btn-navy-lighter { background: #1e293b; color: #f1f5f9; }
</style>
@endsection
