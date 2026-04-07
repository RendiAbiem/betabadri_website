@extends('layouts.admins')

@section('title', 'Manajemen Sekolah')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">Manajemen Sekolah</h4>
        <p class="text-secondary small mb-0">Kelola data mitra sekolah dan informasi kontak PIC.</p>
    </div>
    <div class="d-none d-md-block">
        <span class="badge bg-dark border border-secondary text-secondary px-3 py-2 rounded-pill">
            <i class="fas fa-building me-2"></i> Mitra Aktif
        </span>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Total Sekolah Mitra</p>
                    <h2 class="text-white fw-bold mb-0">{{ $totalSchools }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-school fa-4x text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Total Siswa Terdaftar</p>
                    <h2 class="text-info fw-bold mb-0">{{ $totalStudents }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-user-graduate fa-4x text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Data PIC Belum Lengkap</p>
                    <h2 class="text-warning fw-bold mb-0">{{ $incompleteSchools }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-clipboard-list fa-4x text-white"></i>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="content-card shadow-lg">
    <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <form action="{{ route('admin.schools.index') }}" method="GET" class="w-100 w-md-50">
            <div class="input-group">
                <span class="input-group-text bg-dark border-secondary text-secondary ps-3"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control bg-dark text-white border-secondary border-start-0 py-2"
                       placeholder="Cari nama sekolah, alamat, atau PIC..." value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('admin.schools.index') }}" class="btn btn-outline-secondary border-start-0" title="Reset">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('admin.schools.create') }}" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm rounded-pill px-4 py-2">
            <i class="fas fa-plus me-2"></i> Tambah Sekolah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary x-small text-uppercase bg-black bg-opacity-20 letter-spacing-1">
                    <th width="5%" class="ps-4 py-3">No</th>
                    <th width="35%">Informasi Sekolah</th>
                    <th width="25%">PIC / Kontak</th>
                    <th width="20%" class="text-center">Jumlah Siswa</th>
                    <th width="15%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schools as $key => $school)
                <tr class="border-bottom border-secondary border-opacity-10 hover-row transition-all">
                    <td class="ps-4 text-secondary">{{ $schools->firstItem() + $key }}</td>

                    <td>
                        <div class="d-flex align-items-start">
                            <div class="avatar-initial me-3 rounded-3 d-flex align-items-center justify-content-center text-white fw-bold shadow-sm flex-shrink-0 bg-dark border border-secondary border-opacity-25"
                                 style="width: 42px; height: 42px; font-size: 1.2rem;">
                                {{ strtoupper(substr($school->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-white mb-1">{{ $school->name }}</div>
                                <div class="text-secondary x-small d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-2 opacity-50"></i>
                                    <span class="text-truncate" style="max-width: 250px;">
                                        {{ $school->address ?? 'Alamat belum diisi' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($school->pic_name)
                            <div class="d-flex flex-column">
                                <span class="text-white fw-bold small mb-1">
                                    <i class="fas fa-user-tie me-1 text-secondary opacity-50"></i> {{ $school->pic_name }}
                                </span>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $school->pic_phone)) }}" target="_blank" class="text-success x-small text-decoration-none hover-opacity">
                                    <i class="fab fa-whatsapp me-1"></i> {{ $school->pic_phone }}
                                </a>
                            </div>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3">
                                Pending
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        <span class="badge bg-navy-lighter text-cyan border border-cyan border-opacity-25 px-3 py-2 rounded-pill fw-bold">
                            <i class="fas fa-users me-1"></i> {{ $school->students_count }} Siswa
                        </span>
                    </td>

                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.schools.show', $school->id) }}"
                               class="btn btn-sm btn-icon btn-outline-primary rounded-circle"
                               data-bs-toggle="tooltip" title="Lihat Detail">
                                <i class="fas fa-eye fa-xs"></i>
                            </a>

                            <a href="{{ route('admin.schools.edit', $school->id) }}"
                               class="btn btn-sm btn-icon btn-outline-info rounded-circle"
                               data-bs-toggle="tooltip" title="Edit Data">
                                <i class="fas fa-pen fa-xs"></i>
                            </a>

                            <form action="{{ route('admin.schools.destroy', $school->id) }}" method="POST" onsubmit="return confirm('Yakin hapus sekolah ini? Data siswa terkait mungkin akan hilang.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-icon btn-outline-danger rounded-circle"
                                        data-bs-toggle="tooltip" title="Hapus Sekolah">
                                    <i class="fas fa-trash fa-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center opacity-50 py-4">
                            <div class="bg-dark rounded-circle p-4 mb-3 border border-secondary border-opacity-25">
                                <i class="fas fa-school fa-3x text-secondary"></i>
                            </div>
                            <h6 class="text-white fw-bold mb-1">Belum ada data sekolah</h6>
                            <p class="text-secondary small mb-3">Tambahkan mitra sekolah baru untuk memulai.</p>
                            @if(request('search'))
                                <a href="{{ route('admin.schools.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-4">
                                    Reset Pencarian
                                </a>
                            @else
                                <a href="{{ route('admin.schools.create') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                    <i class="fas fa-plus me-1"></i> Tambah Sekolah
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($schools->hasPages())
    <div class="card-footer-tech p-4 border-top border-secondary border-opacity-10 bg-black bg-opacity-20">
        <div class="d-flex justify-content-between align-items-center">
            <p class="small text-secondary mb-0">
                Menampilkan <b>{{ $schools->firstItem() }}-{{ $schools->lastItem() }}</b> dari <b>{{ $schools->total() }}</b> sekolah
            </p>
            <div>
                {{ $schools->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    /* Menggunakan CSS yang sama dengan student.index untuk konsistensi */
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .bg-navy-lighter { background-color: #1e293b; }
    .bg-black { background-color: #000; }

    .hover-row:hover { background-color: rgba(255, 255, 255, 0.03) !important; }
    .transition-all { transition: all 0.2s ease-in-out; }

    .stat-card {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        border-color: rgba(255,255,255,0.1) !important;
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-control:focus {
        background-color: #0f172a;
        color: white;
        border-color: #4361ee;
        box-shadow: none;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

@endsection
