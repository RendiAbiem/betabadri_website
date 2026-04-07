@extends('layouts.admins')

@section('title', 'Laporan Keuangan')

@section('content')

{{-- HEADER HALAMAN: STATISTIK BALANCE --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="content-card p-4 d-flex align-items-center justify-content-between"
             style="background: linear-gradient(45deg, #161625, #1c1c2d); border-left: 5px solid #10b981; border-radius: 12px;">
            <div>
                <h6 class="text-white-50 text-uppercase small fw-bold mb-1 ls-1">Balance Now (Bulan Ini)</h6>
                <h2 class="text-success fw-bold mb-0">Rp {{ number_format($balanceNow, 0, ',', '.') }}</h2>
            </div>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-navy-lighter btn-sm border-secondary border-opacity-25 text-white px-3">
                    <i class="fas fa-cog me-2 text-primary"></i> Atur Harga Program
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- KOLOM KIRI: TABEL SEKOLAH --}}
    <div class="col-lg-8 mb-4">
        <div class="content-card h-100 shadow-lg">

            {{-- HEADER CARD DENGAN SEARCH BAR --}}
            <div class="p-3 border-bottom border-secondary border-opacity-10">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    {{-- Judul --}}
                    <div>
                        <h5 class="text-white fw-bold mb-0">Laporan per Sekolah</h5>
                        <span class="badge bg-navy-lighter text-secondary x-small border border-secondary border-opacity-10 mt-1">
                            {{ count($mainTable) }} Sekolah Aktif
                        </span>
                    </div>

                    {{-- Search Form --}}
                    <form action="{{ route('admin.finance.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="input-group input-group-sm" style="min-width: 250px;">
                            <span class="input-group-text bg-navy-lighter border-secondary border-opacity-25 text-secondary">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text"
                                name="search"
                                class="form-control border-secondary border-opacity-25"
                                style="background-color: rgba(255, 255, 255, 0.05); color: white;"
                                placeholder="Cari Sekolah..."
                                value="{{ request('search') }}">
                        </div>
                    </form>

                </div>
            </div>

            {{-- TABEL DATA SEKOLAH --}}
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4 py-3">Nama Sekolah</th>
                            <th class="text-center">Siswa</th>
                            <th width="35%">Program Diikuti</th>
                            <th>Fee Sekolah</th>
                            <th>Total Masuk</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mainTable as $row)
                        <tr class="hover-row">
                            <td class="ps-4">
                                <span class="text-info fw-bold">{{ $row->school_name }}</span>
                            </td>
                            <td class="text-center text-white">
                                <span class="badge bg-dark border border-secondary border-opacity-25">{{ $row->total_students }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1 py-2">
                                    @if($row->program_list)
                                        @foreach(explode(',', $row->program_list) as $prog)
                                            <span class="badge bg-navy-lighter text-white-50 border border-secondary border-opacity-25 py-1" style="font-size: 0.65rem; font-weight: normal;">
                                                {{ trim($prog) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-secondary x-small">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-danger small fw-bold">
                                Rp{{ number_format($row->total_fee, 0, ',', '.') }}
                            </td>
                            <td class="text-white fw-bold">
                                Rp{{ number_format($row->total_collected, 0, ',', '.') }}
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.finance.show', $row->school_id) }}" class="btn btn-icon-only text-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary opacity-50">
                                <i class="fas fa-search fa-3x mb-3 opacity-50"></i>
                                <p>Sekolah tidak ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: TREND BULANAN --}}
    <div class="col-lg-4 mb-4">
        <div class="content-card h-100 border-start border-warning border-4 shadow-lg d-flex flex-column">

            <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                <h6 class="text-warning fw-bold mb-0">
                    <i class="fas fa-chart-line me-2"></i>Trend Bulanan
                </h6>
                <span class="badge bg-warning bg-opacity-10 text-warning x-small">{{ date('Y') }} Analysis</span>
            </div>

            <div class="table-responsive flex-grow-1" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-dark-custom mb-0 align-middle">
                    <thead>
                        <tr class="text-white-50 x-small text-uppercase letter-spacing-1 sticky-top bg-dark" style="z-index: 2;">
                            <th class="ps-4 py-3">Bulan</th>
                            <th class="text-end">Revenue</th>
                            <th class="text-end pe-4">Growth</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyBalance as $index => $mb)
                            @php
                                $prev = $monthlyBalance[$index - 1] ?? null;
                                $growth = 0;
                                if($prev && $prev->total > 0) {
                                    $growth = (($mb->total - $prev->total) / $prev->total) * 100;
                                } elseif ($prev && $prev->total == 0 && $mb->total > 0) {
                                    $growth = 100;
                                }
                            @endphp
                            <tr class="hover-row">
                                <td class="ps-4 py-3">
                                    <span class="text-white fw-bold">{{ $mb->month_name }}</span>
                                </td>
                                <td class="text-end text-success fw-bold">
                                    Rp{{ number_format($mb->total, 0, ',', '.') }}
                                </td>
                                <td class="text-end pe-4">
                                    @if($prev)
                                        <span class="badge {{ $growth >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $growth >= 0 ? 'text-success' : 'text-danger' }} py-1 px-2" style="font-size: 0.65rem;">
                                            <i class="fas fa-caret-{{ $growth >= 0 ? 'up' : 'down' }} me-1"></i>
                                            {{ number_format(abs($growth), 1) }}%
                                        </span>
                                    @else
                                        <span class="text-secondary x-small italic">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FOOTER KANAN --}}
            <div class="p-4 mt-auto border-top border-secondary border-opacity-10">
                <h6 class="text-white small fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i>Insight Keuangan</h6>
                @php
                    $collection = collect($monthlyBalance);
                    $avgRevenue = $collection->avg('total');
                @endphp
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary x-small">Rata-rata Pendapatan</span>
                    <span class="text-white x-small fw-bold">Rp {{ number_format($avgRevenue, 0, ',', '.') }}</span>
                </div>

                 @php
                    $currentTotal = $monthlyBalance[date('n')-1]->total ?? 0;
                    $percent = ($currentTotal / 10000000) * 100; // Contoh target 10 Juta
                @endphp
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-secondary x-small">Target Bulan Ini</span>
                    <span class="text-success x-small fw-bold">{{ number_format($percent, 0) }}%</span>
                </div>
                <div class="progress mb-3" style="height: 6px; background: rgba(255,255,255,0.05);">
                    <div class="progress-bar bg-success" style="width: {{ min($percent, 100) }}%"></div>
                </div>

                <div class="bg-navy-lighter p-2 rounded border border-info border-opacity-10">
                    <p class="x-small text-info mb-0 italic">
                        <i class="fas fa-info-circle me-1"></i>
                        Data ditampilkan real-time berdasarkan transaksi lunas tahun {{ date('Y') }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .ls-1 { letter-spacing: 1px; }
    .bg-navy-lighter { background-color: rgba(67, 97, 238, 0.05); }
    .hover-row { transition: all 0.2s; }
    .hover-row:hover { background: rgba(255,255,255,0.02) !important; }
    .btn-icon-only {
        width: 32px; height: 32px; display: inline-flex; align-items: center;
        justify-content: center; border-radius: 8px; transition: 0.2s;
        border: none; background: rgba(255,255,255,0.05);
    }
    .btn-icon-only:hover { background: rgba(67, 97, 238, 0.2); }
    .table-responsive::-webkit-scrollbar { width: 4px; }
    .table-responsive::-webkit-scrollbar-track { background: transparent; }
    .table-responsive::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
</style>

@endsection
