@extends('layouts.admins')

@section('title', 'Manajemen Users')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Manajemen Pengguna</h4>
        <p class="text-secondary small mb-0">Kelola hak akses admin, staff, dan mentor.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary fw-bold shadow-sm">
        <i class="fas fa-user-plus me-2"></i> Tambah User
    </a>
</div>

{{-- SECTION: FILTER & PENCARIAN --}}
<div class="content-card mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                {{-- 1. Search Bar --}}
                <div class="col-md-5">
                    <label class="text-secondary x-small fw-bold text-uppercase mb-1">Cari User</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" class="form-control bg-dark text-white border-secondary border-start-0"
                               placeholder="Nama atau Email..." value="{{ request('q') }}">
                    </div>
                </div>

                {{-- 2. Filter Role --}}
                <div class="col-md-4">
                    <label class="text-secondary x-small fw-bold text-uppercase mb-1">Filter Role</label>
                    <select name="role" class="form-control bg-dark text-white border-secondary" onchange="this.form.submit()">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Siswa/User</option>
                    </select>
                </div>

                {{-- 3. Tombol Reset --}}
                <div class="col-md-3">
                    @if(request()->has('q') || request()->has('role'))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sync-alt me-2"></i> Reset Filter
                        </a>
                    @else
                        <button type="submit" class="btn btn-info w-100 text-white fw-bold">
                            <i class="fas fa-filter me-2"></i> Terapkan
                        </button>
                    @endif
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
                    <th width="40%">Identitas Pengguna</th>
                    <th width="20%">Role Akses</th>
                    <th width="20%">Terdaftar Sejak</th>
                    <th width="15%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-bottom border-secondary border-opacity-10 hover-row">
                    <td class="ps-4 text-secondary">{{ $loop->iteration + $users->firstItem() - 1 }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                            {{-- Avatar Inisial --}}
                            <div class="avatar-initial me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                                 style="width: 40px; height: 40px; background: linear-gradient(45deg, #4361ee, #4cc9f0);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-white">{{ $user->name }}</div>
                                <div class="text-secondary small d-flex align-items-center font-monospace" style="font-size: 0.8rem;">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3">
                                <i class="fas fa-crown me-1"></i> Super Admin
                            </span>
                        @elseif($user->role == 'mentor')
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Mentor
                            </span>
                        @elseif($user->role == 'staff')
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3">
                                <i class="fas fa-briefcase me-1"></i> Staff
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3">
                                <i class="fas fa-user me-1"></i> Siswa
                            </span>
                        @endif
                    </td>

                    <td class="text-secondary small">
                        <div class="d-flex flex-column">
                            <span>{{ $user->created_at->format('d M Y') }}</span>
                            <span class="x-small opacity-50">{{ $user->created_at->format('H:i') }} WIB</span>
                        </div>
                    </td>

                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-info rounded-circle" title="Edit Data">
                                <i class="fas fa-pen"></i>
                            </a>

                            {{-- Proteksi: Admin tidak bisa menghapus dirinya sendiri --}}
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $user->name }} secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-dark rounded-circle opacity-25 cursor-not-allowed" title="Anda sedang login" disabled>
                                <i class="fas fa-lock"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center opacity-50">
                            <i class="fas fa-user-slash fa-3x mb-3 text-secondary"></i>
                            <h6 class="text-white">User tidak ditemukan</h6>
                            <p class="text-secondary small">Coba ubah kata kunci pencarian atau reset filter.</p>
                            @if(request()->has('q'))
                                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-light mt-2">Reset Filter</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="card-footer-tech p-3 border-top border-secondary border-opacity-25">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
    /* Styling Tambahan */
    .x-small { font-size: 0.75rem; }
    .cursor-not-allowed { cursor: not-allowed !important; }

    .hover-row:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    /* Style Input Dark Mode */
    .form-control:focus, .form-select:focus {
        background-color: #0f172a;
        color: white;
        border-color: #4361ee;
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
</style>

@endsection
