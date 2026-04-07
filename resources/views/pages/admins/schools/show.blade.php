@extends('layouts.admins')

@section('title', 'Detail Sekolah - ' . $school->name)

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">
            <i class="fas fa-school me-2 text-primary"></i>Profil Sekolah
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.schools.index') }}" class="text-secondary text-decoration-none">Sekolah</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $school->name }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.schools.index') }}" class="btn btn-outline-secondary btn-sm border-secondary border-opacity-25 text-white px-3">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="content-card h-100 p-4" style="background: linear-gradient(45deg, #161625, #1c1c2d); border-left: 5px solid #4361ee;">
            <div class="row align-items-center">
                <div class="col-md-auto mb-3 mb-md-0">
                    <div class="school-icon-avatar shadow-sm">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
                <div class="col-md">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h2 class="text-white fw-bold mb-0">{{ $school->name }}</h2>
                            <p class="text-secondary small mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $school->address ?? 'Alamat belum diatur' }}
                            </p>
                        </div>
                        <span class="badge {{ $school->students->count() > 0 ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 text-{{ $school->students->count() > 0 ? 'success' : 'secondary' }} border border-{{ $school->students->count() > 0 ? 'success' : 'secondary' }} border-opacity-25 px-3">
                            {{ $school->students->count() > 0 ? 'Mitra Aktif' : 'Non-Aktif' }}
                        </span>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-10 h-100">
                                <small class="text-white-50 d-block mb-1 text-uppercase fw-bold ls-1" style="font-size: 0.65rem;">Person in Charge (PIC)</small>
                                <div class="text-white fw-bold small">
                                    <i class="fas fa-user-tie me-2 text-primary"></i>{{ $school->pic_name ?? 'N/A' }}
                                </div>
                                <div class="x-small text-secondary mt-1">
                                    <i class="fas fa-phone-alt me-2"></i>{{ $school->pic_phone ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-10 h-100 d-flex flex-column justify-content-center">
                                <small class="text-white-50 d-block mb-1 text-uppercase fw-bold ls-1" style="font-size: 0.65rem;">Total Siswa Terdaftar</small>
                                <div class="text-white fw-bold fs-5">
                                    <i class="fas fa-users me-2 text-primary"></i>{{ $school->students->count() }}
                                    <span class="small fw-normal text-secondary">Siswa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card h-100 p-4 border-start border-warning border-4">
            <h6 class="text-warning fw-bold mb-3 ls-1 text-uppercase small">
                <i class="fas fa-bolt me-2"></i>Aksi Cepat
            </h6>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.students.create', ['school_id' => $school->id]) }}" class="btn btn-primary btn-sm py-2 fw-bold">
                    <i class="fas fa-plus me-2"></i>Tambah Siswa Baru
                </a>
                <a href="{{ route('admin.schools.export_pdf', $school->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm py-2 text-white border-secondary border-opacity-25">
                    <i class="fas fa-file-pdf me-2 text-danger"></i>Export Daftar (PDF)
                </a>
                <div class="mt-3 p-3 bg-dark bg-opacity-50 rounded-3 border border-secondary border-opacity-10">
                    <p class="x-small text-secondary mb-0 italic">
                        <i class="fas fa-info-circle me-1"></i> Tips: Selalu sinkronkan data siswa sebelum melakukan penagihan bulanan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-card overflow-hidden">
    <div class="p-4 border-bottom border-secondary border-opacity-10">
        <div class="row g-3 align-items-center">
            <div class="col-lg-4">
                <h5 class="m-0 text-white fw-bold">Daftar Siswa Terdaftar</h5>
                <p class="x-small text-secondary mb-0">Daftar lengkap akademik & status siswa.</p>
            </div>

            <div class="col-lg-8">
                <form action="{{ route('admin.schools.show', $school->id) }}" method="GET" class="row g-2 justify-content-lg-end">
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-dark border-secondary text-secondary border-opacity-25">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control bg-dark text-white border-secondary border-opacity-25 select-tech-sm"
                                   placeholder="Cari nama siswa..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-dark border-secondary text-secondary border-opacity-25">
                                <i class="fas fa-filter"></i>
                            </span>
                            <select name="program_id" class="form-select bg-dark text-white border-secondary border-opacity-25 select-tech-sm" onchange="this.form.submit()">
                                <option value="all">Semua Program</option>
                                @foreach($programs as $prog)
                                    <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                                        {{ $prog->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-auto">
                        @if(request('search') || (request('program_id') && request('program_id') != 'all'))
                            <a href="{{ route('admin.schools.show', $school->id) }}" class="btn btn-navy-lighter btn-sm border-secondary border-opacity-25" title="Reset">
                                <i class="fas fa-undo"></i>
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary btn-sm px-3">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom m-0 align-middle">
            <thead>
                <tr class="text-secondary small text-uppercase ls-1">
                    <th class="ps-4 py-3" width="60">No</th>
                    <th>Info Siswa</th>
                    <th>Kelas & Gender</th>
                    <th>Program Studi</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr class="hover-row border-bottom border-secondary border-opacity-10">
                    <td class="ps-4">
                        <span class="text-secondary font-monospace x-small">{{ $loop->iteration + $students->firstItem() - 1 }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-initials me-3">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-white fw-bold mb-0 small">{{ $student->name }}</div>
                                <div class="x-small text-secondary font-monospace">ID: STU-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-1">
                            <span class="badge bg-navy-lighter text-white-50 fw-normal border border-secondary border-opacity-10" style="font-size: 0.65rem;">
                                Kelas {{ $student->class_name }}
                            </span>
                        </div>
                        <div class="x-small">
                            {!! $student->gender == 'L' ? '<i class="fas fa-mars text-info me-1"></i>Laki-laki' : '<i class="fas fa-venus text-danger me-1"></i>Perempuan' !!}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center small">
                            <div class="dot-indicator bg-primary me-2"></div>
                            <span class="text-white-50">{{ $student->program->name ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($student->is_active)
                            <div class="d-flex align-items-center text-success x-small fw-bold">
                                <span class="pulse-green me-2"></span> AKTIF
                            </div>
                        @else
                            <div class="d-flex align-items-center text-secondary x-small">
                                <span class="dot-static me-2 bg-secondary" style="width:8px; height:8px; border-radius:50%"></span> NON-AKTIF
                            </div>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-1">
                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-icon-only text-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-icon-only text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="opacity-25">
                            <i class="fas fa-user-slash fa-3x mb-3 text-secondary"></i>
                            <h6 class="text-secondary">Tidak ada siswa ditemukan.</h6>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($students->hasPages())
    <div class="p-4 border-top border-secondary border-opacity-10">
        <div class="d-flex justify-content-between align-items-center">
            <p class="x-small text-secondary mb-0">
                Menampilkan <b>{{ $students->firstItem() }}</b> - <b>{{ $students->lastItem() }}</b> dari <b>{{ $students->total() }}</b> siswa
            </p>
            <div>
                {{ $students->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .x-small { font-size: 0.72rem; }
    .ls-1 { letter-spacing: 1px; }
    .italic { font-style: italic; }

    .school-icon-avatar {
        width: 70px; height: 70px;
        background: rgba(67, 97, 238, 0.15);
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: #4361ee;
    }

    .avatar-initials {
        width: 32px; height: 32px; background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #4361ee; font-weight: bold; font-size: 0.8rem;
    }

    .dot-indicator { width: 6px; height: 6px; border-radius: 50%; }

    .pulse-green {
        width: 8px; height: 8px; background: #10b981; border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .hover-row:hover { background: rgba(255,255,255,0.02) !important; transition: 0.2s; }

    .btn-icon-only {
        width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;
        border-radius: 6px; transition: 0.2s; border: none; background: transparent;
    }
    .btn-icon-only:hover { background: rgba(255,255,255,0.05); }

    .bg-navy-lighter { background: rgba(67, 97, 238, 0.05); }
</style>

@endsection
