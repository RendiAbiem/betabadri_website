@extends('layouts.admins')

@section('title', 'Detail Keuangan Sekolah')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">{{ $school->name }}</h4>
        <p class="text-secondary small mb-0">Manajemen tagihan per siswa dan riwayat transaksi.</p>
    </div>
    <a href="{{ route('admin.finance.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

{{-- CARD DATA TAGIHAN SISWA --}}
<div class="content-card mb-5">

    {{-- HEADER CARD DENGAN SEARCH & FILTER --}}
    <div class="p-3 border-bottom border-secondary border-opacity-10">
        <div class="row g-3 align-items-center justify-content-between">

            {{-- JUDUL --}}
            <div class="col-md-4">
                <h5 class="text-white fw-bold mb-0">
                    <i class="fas fa-file-invoice-dollar me-2 text-primary"></i> Data Tagihan Siswa
                </h5>
            </div>

            {{-- FORM SEARCH & FILTER (GABUNGAN) --}}
            <div class="col-md-8">
                <form action="{{ route('admin.finance.show', $school->id) }}" method="GET" class="d-flex gap-2 justify-content-md-end">

                    {{-- 1. Search Bar --}}
                    <div class="input-group input-group-sm" style="max-width: 250px;">
                        <span class="input-group-text bg-navy-lighter border-secondary border-opacity-25 text-secondary">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control form-control-dark bg-navy-lighter border-secondary border-opacity-25 text-white"
                               placeholder="Cari Nama Siswa..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- 2. Filter Program --}}
                    <div class="input-group input-group-sm" style="max-width: 200px;">
                        <span class="input-group-text bg-navy-lighter border-secondary border-opacity-25 text-secondary">
                            <i class="fas fa-filter"></i>
                        </span>
                        <select name="program_id" class="form-select form-select-dark bg-navy-lighter border-secondary border-opacity-25 text-white" onchange="this.form.submit()">
                            <option value="all">Semua Program</option>
                            @foreach($programs as $prog)
                                <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                                    {{ $prog->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Submit Search (Optional, enter juga bisa) --}}
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-right"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>

    {{-- TABEL SISWA --}}
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th width="5%" class="ps-4">No</th>
                    <th width="25%">Informasi Siswa</th>
                    <th width="20%">Program Belajar</th>
                    <th width="15%">Tagihan Bruto</th>
                    <th width="15%">Fee Sekolah</th>
                    <th width="10%">Status</th>
                    <th width="10%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                @php
                    $payment = $student->payments->first();
                    $programPrice = $student->program->price;
                    $bonusFee = $student->program->school_fee;
                @endphp
                <tr>
                    <td class="ps-4 text-secondary">{{ $loop->iteration }}</td>

                    <td>
                        <div class="fw-bold text-white">{{ $student->name }}</div>
                        <div class="text-secondary small" style="font-size: 0.75rem;">Kelas: {{ $student->class_name }}</div>
                    </td>

                    <td>
                        <span class="badge bg-navy-lighter text-cyan border border-cyan border-opacity-10 fw-normal">
                            {{ $student->program->name }}
                        </span>
                    </td>

                    <td class="text-white fw-bold">
                        Rp {{ number_format($programPrice, 0, ',', '.') }}
                    </td>

                    <td class="text-danger small">
                        <i class="fas fa-hand-holding-usd me-1 opacity-50"></i>
                        Rp {{ number_format($bonusFee, 0, ',', '.') }}
                    </td>

                    <td>
                        @if($payment)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 rounded-pill px-3">
                                <i class="fas fa-check-circle me-1"></i> Lunas
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 rounded-pill px-3">
                                <i class="fas fa-exclamation-circle me-1"></i> Belum
                            </span>
                        @endif
                    </td>

                    <td class="text-end pe-4">
                        @if(!$payment)
                            <button type="button"
                                    class="btn btn-sm btn-primary shadow-sm btn-pay-action"
                                    data-id="{{ $student->id }}"
                                    data-name="{{ $student->name }}"
                                    data-price="{{ $programPrice }}">
                                <i class="fas fa-money-bill-wave me-1"></i> Bayar
                            </button>
                        @else
                            <span class="text-secondary small fst-italic">
                                <i class="fas fa-check-double text-success me-1"></i> Selesai
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary opacity-50">
                        <i class="fas fa-search fa-2x mb-3 opacity-50"></i>
                        <p class="mb-0">Tidak ada data siswa ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION (JIKA ADA) --}}
    @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="p-3 border-top border-secondary border-opacity-10">
        {{ $students->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- CARD RIWAYAT TRANSAKSI --}}
<div class="content-card">
    <div class="p-3 border-bottom border-secondary border-opacity-10 border-top border-success border-3">
        <h6 class="text-success fw-bold mb-1">
            <i class="fas fa-history me-2"></i> Transaksi Terkonfirmasi
        </h6>
        <p class="text-secondary small mb-0" style="font-size: 0.8rem;">
            Aliran dana yang sudah masuk ke kas lembaga.
        </p>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0 table-sm">
            <thead>
                <tr class="text-white-50">
                    <th class="ps-4 small">TGL TRANSAKSI</th>
                    <th class="small">NAMA SISWA</th>
                    <th class="small">PROGRAM</th>
                    <th class="small">NOMINAL NETTO</th>
                    <th class="small">DISKON</th>
                    <th class="small">METODE</th>
                    <th class="pe-4 small">CATATAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paymentHistory as $history)
                <tr>
                    <td class="ps-4 text-white">{{ \Carbon\Carbon::parse($history->payment_date)->format('d M Y') }}</td>
                    <td class="fw-bold text-white">{{ $history->student->name }}</td>
                    <td class="text-secondary">{{ $history->student->program->name }}</td>
                    <td class="fw-bold text-success">Rp {{ number_format($history->final_amount, 0, ',', '.') }}</td>
                    <td class="text-warning small">
                        @if($history->discount > 0)
                            Rp {{ number_format($history->discount, 0, ',', '.') }}
                        @else - @endif
                    </td>
                    <td>
                        <span class="badge bg-navy-lighter text-primary border border-primary border-opacity-25" style="font-size: 0.65rem;">
                            Direct Cash
                        </span>
                    </td>
                    <td class="text-secondary small fst-italic pe-4">
                        {{ $history->notes ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted small">Belum ada riwayat transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('pages.admins.finance.partials.modal_pay')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payButtons = document.querySelectorAll('.btn-pay-action');

        payButtons.forEach(button => {
            button.addEventListener('click', function() {
                // 1. Ambil Data
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');

                // 2. Isi Form Modal
                const inputId = document.getElementById('modalStudentId');
                const inputName = document.getElementById('modalStudentName');
                const inputAmount = document.getElementById('modalAmount');

                if(inputId) inputId.value = id;
                if(inputName) inputName.innerText = name;
                if(inputAmount) inputAmount.value = price;

                // 3. Tampilkan Modal
                const modalEl = document.getElementById('payModal');
                if(modalEl) {
                    if (window.bootstrap) {
                        const myModal = new bootstrap.Modal(modalEl);
                        myModal.show();
                    } else if (window.jQuery) {
                        $(modalEl).modal('show');
                    }
                }
            });
        });
    });
</script>
@endpush
