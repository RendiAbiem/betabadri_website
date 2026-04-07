@extends('layouts.admins')

@section('title', 'Master Program')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Program Belajar</h4>
        <p class="text-secondary small mb-0">Daftar harga kursus dan pembagian fee per sekolah.</p>
    </div>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary fw-bold shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Program
    </a>
</div>

{{-- SECTION: FILTER & PENCARIAN --}}
<div class="content-card mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.programs.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                {{-- 1. Filter Sekolah --}}
                <div class="col-md-4">
                    <label class="text-secondary x-small fw-bold text-uppercase mb-1">Filter Sekolah</label>
                    <select name="school_id" class="form-control bg-dark text-white border-secondary" onchange="this.form.submit()">
                        <option value="">-- Semua Sekolah --</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 2. Filter Tipe Bayar --}}
                <div class="col-md-3">
                    <label class="text-secondary x-small fw-bold text-uppercase mb-1">Tipe Pembayaran</label>
                    <select name="type" class="form-control bg-dark text-white border-secondary" onchange="this.form.submit()">
                        <option value="">-- Semua Tipe --</option>
                        <option value="Per Siswa" {{ request('type') == 'Per Siswa' ? 'selected' : '' }}>Per Siswa</option>
                        <option value="Per Semester" {{ request('type') == 'Per Semester' ? 'selected' : '' }}>Per Semester</option>
                        <option value="Per Sekolah" {{ request('type') == 'Per Sekolah' ? 'selected' : '' }}>Per Sekolah</option>
                    </select>
                </div>

                {{-- 3. Search Bar --}}
                <div class="col-md-3">
                    <label class="text-secondary x-small fw-bold text-uppercase mb-1">Cari Program</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" class="form-control bg-dark text-white border-secondary border-start-0"
                               placeholder="Nama program..." value="{{ request('q') }}">
                    </div>
                </div>

                {{-- 4. Tombol Aksi --}}
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-info w-100 text-white fw-bold">
                            Cari
                        </button>
                        @if(request()->has('q') || request()->has('school_id') || request()->has('type'))
                            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th width="5%" class="ps-4">No</th>
                    <th width="25%">Sekolah (Mitra)</th>
                    <th width="20%">Nama Program</th>
                    <th width="10%">Tipe</th>
                    <th width="15%">Harga Siswa</th>
                    <th width="15%">Fee Sekolah</th>
                    <th width="10%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $program)
                <tr class="border-bottom border-secondary border-opacity-10">
                    <td class="ps-4 text-secondary">{{ $loop->iteration + $programs->firstItem() - 1 }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-25 text-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                 style="width: 32px; height: 32px; font-size: 0.8rem; font-weight: bold;">
                                {{ substr($program->school->name ?? '?', 0, 1) }}
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-white fw-bold small">{{ $program->school->name ?? 'Sekolah Dihapus' }}</span>
                                <span class="text-secondary x-small" style="font-size: 0.7rem;">{{ $program->school->address ?? '' }}</span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column">
                            <span class="text-white fw-bold">{{ $program->name }}</span>
                            @if(request('q'))
                                {{-- Highlight text pencarian (Opsional) --}}
                                <small class="text-warning x-small fst-italic">Hasil pencarian</small>
                            @endif
                        </div>
                    </td>

                    <td>
                        @if($program->payment_type == 'Per Siswa')
                            <span class="badge bg-navy-lighter text-info border border-info border-opacity-25 rounded-pill px-2">
                                Siswa
                            </span>
                        @elseif($program->payment_type == 'Per Semester')
                            <span class="badge bg-navy-lighter text-success border border-success border-opacity-25 rounded-pill px-2">
                                Semester
                            </span>
                        @else
                            <span class="badge bg-navy-lighter text-warning border border-warning border-opacity-25 rounded-pill px-2">
                                Sekolah
                            </span>
                        @endif
                    </td>

                    <td>
                        <span class="text-cyan fw-bold small">Rp {{ number_format($program->price, 0, ',', '.') }}</span>
                    </td>

                    <td>
                        <span class="text-danger small">
                            <i class="fas fa-hand-holding-usd me-1 opacity-50"></i>
                            Rp {{ number_format($program->school_fee, 0, ',', '.') }}
                        </span>
                    </td>

                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.programs.edit', $program->id) }}"
                               class="btn btn-sm btn-outline-info rounded-circle" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>

                            <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Yakin hapus program ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center opacity-50">
                            <i class="fas fa-search fa-3x mb-3 text-secondary"></i>
                            <h6 class="text-white">Data tidak ditemukan</h6>
                            <p class="text-secondary small">Coba ubah kata kunci pencarian atau reset filter.</p>
                            @if(request()->has('q') || request()->has('school_id'))
                                <a href="{{ route('admin.programs.index') }}" class="btn btn-sm btn-outline-light mt-2">Reset Filter</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($programs->hasPages())
    <div class="card-footer-tech p-3 border-top border-secondary border-opacity-25">
        {{ $programs->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
    /* Utility Class untuk font kecil */
    .x-small { font-size: 0.75rem; }

    /* Mempercantik input di dark mode */
    .form-control:focus, .form-select:focus {
        background-color: #0f172a; /* Warna dark sedikit terang */
        color: white;
        border-color: #0ea5e9; /* Warna biru */
        box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
    }
</style>

@endsection
