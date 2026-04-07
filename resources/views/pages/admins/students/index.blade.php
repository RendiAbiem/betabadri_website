@extends('layouts.admins')

@section('title', 'Manajemen Siswa')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">Manajemen Siswa</h4>
        <p class="text-secondary small mb-0">Kelola data peserta didik, status aktif, dan alumni.</p>
    </div>
    <div class="d-none d-md-block">
        <span class="badge bg-dark border border-secondary text-secondary px-3 py-2 rounded-pill">
            <i class="fas fa-calendar-alt me-2"></i> {{ date('d F Y') }}
        </span>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Total Siswa</p>
                    <h2 class="text-white fw-bold mb-0">{{ $totalStudents }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-users fa-4x text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Siswa Aktif</p>
                    <h2 class="text-success fw-bold mb-0">{{ $activeStudents }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-user-check fa-4x text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Alumni / Off</p>
                    <h2 class="text-secondary fw-bold mb-0">{{ $alumniStudents }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-user-graduate fa-4x text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card bg-navy-lighter border border-secondary border-opacity-25 p-4 rounded-4 h-100 position-relative overflow-hidden shadow-sm">
            <div class="d-flex justify-content-between align-items-center position-relative z-2">
                <div>
                    <p class="text-secondary x-small text-uppercase fw-bold letter-spacing-1 mb-1">Asal Sekolah</p>
                    <h2 class="text-info fw-bold mb-0">{{ $totalSchools }}</h2>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                <i class="fas fa-school fa-4x text-white"></i>
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
        <form action="{{ route('admin.students.index') }}" method="GET" class="w-100 w-md-50">
            <div class="input-group">
                <span class="input-group-text bg-dark border-secondary text-secondary ps-3"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control bg-dark text-white border-secondary border-start-0 py-2"
                       placeholder="Cari nama siswa atau sekolah..." value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary border-start-0" title="Reset">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('admin.students.create') }}" class="btn btn-primary d-flex align-items-center fw-bold shadow-sm rounded-pill px-4 py-2">
            <i class="fas fa-user-plus me-2"></i> Tambah Siswa
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary x-small text-uppercase bg-black bg-opacity-20 letter-spacing-1">
                    <th width="5%" class="ps-4 py-3">No</th>
                    <th width="30%">Identitas Siswa</th>
                    <th width="20%">Program Studi</th>
                    <th width="15%" class="text-center">Kelas</th>
                    <th width="15%" class="text-center">Status</th>
                    <th width="15%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $key => $student)
                <tr class="border-bottom border-secondary border-opacity-10 hover-row transition-all">
                    <td class="ps-4 text-secondary">{{ $students->firstItem() + $key }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-initial me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm flex-shrink-0"
                                 style="width: 42px; height: 42px; background: linear-gradient(135deg, #4361ee, #4cc9f0); font-size: 1rem;">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-white mb-1">{{ $student->name }}</div>
                                <div class="text-secondary x-small d-flex flex-wrap align-items-center gap-2">
                                    <span class="badge bg-dark border border-secondary text-secondary fw-normal px-2">
                                        {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                    <span class="text-secondary opacity-50 d-none d-sm-inline">|</span>
                                    <span class="text-info opacity-75"><i class="fas fa-school me-1"></i> {{ $student->school->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($student->program)
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                    <i class="fas fa-cube me-1"></i> {{ $student->program->name }}
                                </span>
                            </div>
                        @else
                            <span class="text-secondary x-small fst-italic opacity-50">Belum pilih program</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <span class="fw-bold text-white small">
                            {{ $student->class_name }}
                        </span>
                    </td>

                    <td class="text-center">
                        @if($student->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                Active
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3">
                                Alumni
                            </span>
                        @endif
                    </td>

                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.students.edit', $student->id) }}"
                               class="btn btn-sm btn-icon btn-outline-info rounded-circle"
                               data-bs-toggle="tooltip" title="Edit Data">
                                <i class="fas fa-pen fa-xs"></i>
                            </a>

                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-icon btn-outline-danger rounded-circle"
                                        data-bs-toggle="tooltip" title="Hapus Siswa">
                                    <i class="fas fa-trash fa-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center opacity-50 py-4">
                            <div class="bg-dark rounded-circle p-4 mb-3 border border-secondary border-opacity-25">
                                <i class="fas fa-user-graduate fa-3x text-secondary"></i>
                            </div>
                            <h6 class="text-white fw-bold mb-1">Belum ada data siswa</h6>
                            <p class="text-secondary small mb-3">Silakan tambahkan siswa baru atau ubah pencarian.</p>
                            @if(request('search'))
                                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-4">
                                    Reset Pencarian
                                </a>
                            @else
                                <a href="{{ route('admin.students.create') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                    <i class="fas fa-plus me-1"></i> Input Siswa
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($students->hasPages())
    <div class="card-footer-tech p-4 border-top border-secondary border-opacity-10 bg-black bg-opacity-20">
        <div class="d-flex justify-content-between align-items-center">
            <p class="small text-secondary mb-0">
                Menampilkan <b>{{ $students->firstItem() }}-{{ $students->lastItem() }}</b> dari <b>{{ $students->total() }}</b> siswa
            </p>
            <div>
                {{ $students->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    /* Utility Classes */
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .bg-navy-lighter { background-color: #1e293b; }
    .bg-black { background-color: #000; }

    /* Hover Effects */
    .hover-row:hover { background-color: rgba(255, 255, 255, 0.03) !important; }
    .transition-all { transition: all 0.2s ease-in-out; }

    /* Card Styles */
    .stat-card {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        border-color: rgba(255,255,255,0.1) !important;
    }

    /* Icon Circle */
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Input Search Focus */
    .form-control:focus {
        background-color: #0f172a;
        color: white;
        border-color: #4361ee;
        box-shadow: none;
    }

    /* Button Icon */
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
