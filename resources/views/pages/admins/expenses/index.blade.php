@extends('layouts.admins')

@section('title', 'Cashout / Pengeluaran')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Cashout & Pengeluaran</h4>
        <p class="text-secondary small mb-0">Laporan keuangan operasional Tahun {{ date('Y') }}</p>
    </div>
    <div class="d-flex gap-2">
        @if(auth()->user()->role === 'admin')
        <div class="bg-dark border border-secondary border-opacity-25 rounded px-3 py-1 d-flex flex-column justify-content-center">
            <span class="text-secondary x-small">Total Disetujui (All Time)</span>
            <span class="text-success fw-bold">Rp {{ number_format($totalApproved, 0, ',', '.') }}</span>
        </div>
        @endif

        <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary fw-bold shadow-sm d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Input Pengeluaran
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ================================================= --}}
{{-- 1. SECTION CARD BULANAN (JANUARI - DESEMBER)      --}}
{{-- ================================================= --}}
<div class="row g-3 mb-4">
    @foreach($monthlyRecap as $recap)
    <div class="col-6 col-md-4 col-xl-2">
        <div class="p-3 rounded-3 border h-100 position-relative overflow-hidden transition-hover
            {{ $recap->is_current ? 'bg-primary bg-opacity-10 border-primary' : 'bg-dark border-secondary border-opacity-10' }}">

            <div class="d-flex flex-column position-relative z-2">
                <span class="x-small text-uppercase fw-bold letter-spacing-1 mb-1 {{ $recap->is_current ? 'text-primary' : 'text-secondary' }}">
                    {{ $recap->month_name }}
                </span>

                {{-- Nominal Uang Rekap (Hanya Admin) --}}
                <h6 class="fw-bold mb-0 {{ $recap->total > 0 ? 'text-white' : 'text-white-50' }}">
                    @if(auth()->user()->role === 'admin')
                        @if($recap->total > 0)
                            Rp {{ number_format($recap->total, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    @else
                        @if($recap->total > 0)
                            <span class="text-secondary small fst-italic"><i class="fas fa-lock me-1"></i> Rahasia</span>
                        @else
                            -
                        @endif
                    @endif
                </h6>
            </div>

            @if($recap->count > 0)
            <div class="position-absolute bottom-0 end-0 p-2 opacity-10">
                <i class="fas fa-chart-bar fa-2x text-white"></i>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>


<div class="row g-4">

    {{-- ================================================= --}}
    {{-- 2. TABEL HISTORY BULANAN (REKAPITULASI)           --}}
    {{-- ================================================= --}}
    <div class="col-lg-4">
        <div class="content-card h-100">
            <div class="card-header border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                <h6 class="text-white fw-bold mb-0">
                    <i class="fas fa-history text-warning me-2"></i> Rekap Bulanan
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0 table-sm">
                    <thead>
                        <tr class="text-secondary x-small text-uppercase">
                            <th>Bulan</th>
                            <th class="text-center">Trx</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyRecap as $recap)
                        @if($recap->month_num <= date('n'))
                        <tr style="{{ $recap->is_current ? 'background-color: rgba(255, 255, 255, 0.05);' : '' }}">
                            <td class="fw-bold text-white">{{ $recap->month_name }}</td>
                            <td class="text-center">
                                @if($recap->count > 0)
                                    <span class="badge bg-secondary rounded-pill">{{ $recap->count }}</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td class="text-end fw-bold {{ $recap->total > 0 ? 'text-success' : 'text-secondary' }}">
                                @if(auth()->user()->role === 'admin')
                                    @if($recap->total > 0)
                                        Rp {{ number_format($recap->total, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                @else
                                    @if($recap->total > 0)
                                        <i class="fas fa-lock text-secondary opacity-50"></i>
                                    @else
                                        -
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot class="border-top border-secondary border-opacity-50">
                        <tr>
                            <td class="fw-bold text-white pt-3">TOTAL TAHUN INI</td>
                            <td class="text-center pt-3 fw-bold">{{ $monthlyRecap->sum('count') }}</td>
                            <td class="text-end pt-3 fw-bold text-warning">
                                @if(auth()->user()->role === 'admin')
                                    Rp {{ number_format($monthlyRecap->sum('total'), 0, ',', '.') }}
                                @else
                                    <i class="fas fa-lock text-secondary opacity-50"></i>
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ================================================= --}}
    {{-- 3. TABEL DETAIL TRANSAKSI                         --}}
    {{-- ================================================= --}}
    <div class="col-lg-8">
        <div class="content-card h-100">
            <div class="card-header border-bottom border-secondary border-opacity-25 pb-3 mb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white fw-bold mb-0">
                    <i class="fas fa-list text-primary me-2"></i> Riwayat Transaksi
                </h6>
            </div>

            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr class="text-secondary x-small text-uppercase">
                            <th class="ps-3">Tgl</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)

                        {{-- Logika untuk mengecek jumlah gambar (JSON / Fallback String Lama) --}}
                        @php
                            $images = json_decode($expense->image, true);
                            $imgCount = is_array($images) ? count($images) : ($expense->image ? 1 : 0);
                        @endphp

                        <tr class="border-bottom border-secondary border-opacity-10">
                            <td class="ps-3 text-secondary small">{{ $expense->date->format('d/m/y') }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-white fw-bold small">{{ Str::limit($expense->title, 25) }}</span>
                                    <span class="text-secondary x-small">{{ Str::limit($expense->description, 20) }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-white fw-bold small">Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($expense->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">OK</span>
                                @elseif($expense->status == 'rejected')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">NO</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">Wait</span>
                                @endif

                                {{-- Icon Clip jika ada lampiran --}}
                                @if($imgCount > 0)
                                    <i class="fas fa-paperclip text-info ms-2 opacity-75" title="{{ $imgCount }} Lampiran"></i>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-flex justify-content-end gap-1">
                                    {{-- TOMBOL LIHAT DETAIL --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $expense->id }}" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    @if(auth()->user()->role === 'admin' && $expense->status == 'pending')
                                        <form action="{{ route('admin.expenses.approve', $expense->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-success" onclick="return confirm('Acc pengeluaran ini?')"><i class="fas fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('admin.expenses.reject', $expense->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-warning" onclick="return confirm('Tolak pengeluaran ini?')"><i class="fas fa-times"></i></button>
                                        </form>
                                    @endif

                                    {{-- Hapus (Admin semua, User cuma miliknya yg pending) --}}
                                    @if(auth()->user()->role === 'admin' || ($expense->user_id == auth()->id() && $expense->status == 'pending'))
                                    <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" onclick="return confirm('Hapus data pengeluaran ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- ================================================= --}}
                        {{-- MODAL DETAIL TRANSAKSI                            --}}
                        {{-- ================================================= --}}
                        <div class="modal fade" id="detailModal{{ $expense->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" style="background-color: #1e293b; border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="modal-header border-bottom border-secondary border-opacity-25">
                                        <h5 class="modal-title text-white fw-bold"><i class="fas fa-file-invoice-dollar text-primary me-2"></i> Detail Pengeluaran</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <small class="text-secondary d-block text-uppercase letter-spacing-1">Tanggal</small>
                                                <span class="text-white">{{ $expense->date->format('d F Y') }}</span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-secondary d-block text-uppercase letter-spacing-1">Status</small>
                                                @if($expense->status == 'approved')
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 mt-1">Disetujui</span>
                                                @elseif($expense->status == 'rejected')
                                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 mt-1">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 mt-1">Menunggu</span>
                                                @endif
                                            </div>
                                        </div>

                                        <hr class="border-secondary border-opacity-25">

                                        <div class="mb-3">
                                            <small class="text-secondary d-block text-uppercase letter-spacing-1">Judul / Keterangan Singkat</small>
                                            <span class="text-white fw-bold fs-5">{{ $expense->title }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <small class="text-secondary d-block text-uppercase letter-spacing-1">Deskripsi Lengkap</small>
                                            <p class="text-white-50 mb-0" style="white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">
                                                {{ $expense->description ?: 'Tidak ada deskripsi tambahan.' }}
                                            </p>
                                        </div>

                                        <div class="mb-4 p-3 rounded bg-dark border border-secondary border-opacity-25">
                                            <small class="text-secondary d-block text-uppercase letter-spacing-1 mb-1">Total Nominal</small>
                                            <span class="text-success fw-bold fs-4">Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                                        </div>

                                        {{-- Galeri Lampiran --}}
                                        @if($imgCount > 0)
                                            <div class="mt-4">
                                                <small class="text-secondary d-block text-uppercase letter-spacing-1 mb-2">Lampiran / Bukti Nota ({{ $imgCount }} File)</small>

                                                @if(is_array($images))
                                                    <div class="row g-2">
                                                        @foreach($images as $img)
                                                        <div class="col-6">
                                                            <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                                                <img src="{{ asset('storage/' . $img) }}" alt="Bukti" class="img-fluid rounded border border-secondary border-opacity-25 w-100 object-fit-cover" style="height: 120px;">
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    {{-- Fallback jika data lama formatnya string tunggal --}}
                                                    <a href="{{ asset('storage/' . $expense->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $expense->image) }}" alt="Bukti" class="img-fluid rounded border border-secondary border-opacity-25 w-100 object-fit-cover" style="max-height: 250px;">
                                                    </a>
                                                @endif

                                                <small class="text-muted d-block mt-2 text-center"><i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar</small>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="modal-footer border-top border-secondary border-opacity-25">
                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}

                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted small">Belum ada data pengeluaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top border-secondary border-opacity-25">
                {{ $expenses->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    .btn-icon {
        width: 28px;
        height: 28px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
    .transition-hover { transition: all 0.2s; }
    .transition-hover:hover { transform: translateY(-3px); border-color: rgba(255,255,255,0.2) !important; }
</style>

@endsection
