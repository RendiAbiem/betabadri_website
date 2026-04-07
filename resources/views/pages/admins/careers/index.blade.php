@extends('layouts.admins')

@section('title', 'Data Pelamar Kerja')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white fw-bold">Pelamar Karir</h3>
        <p class="text-secondary small mb-0">Daftar kandidat yang mengirimkan CV melalui website.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success bg-success-soft text-success border-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">Nama Lengkap</th>
                    <th width="25%">Email</th>
                    <th width="15%">Tanggal</th>
                    <th width="10%">Status</th>
                    <th width="15%" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applicants as $item)
                <tr>
                    <td class="text-secondary">{{ $loop->iteration }}</td>

                    <td class="fw-bold text-white">
                        {{ $item->first_name }} {{ $item->last_name }}
                    </td>

                    <td class="text-secondary">
                        <i class="far fa-envelope me-1 opacity-50"></i> {{ $item->email }}
                    </td>

                    <td class="text-secondary small">
                        {{ $item->created_at->format('d M Y') }}
                    </td>

                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-navy-lighter text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">
                                <i class="fas fa-clock me-1"></i> Baru
                            </span>
                        @else
                            <span class="badge bg-navy-lighter text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                                <i class="fas fa-check-double me-1"></i> Dilihat
                            </span>
                        @endif
                    </td>

                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.careers.show', $item->id) }}" class="btn btn-sm btn-outline-info rounded-circle" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>

                            <form action="{{ route('admin.careers.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pelamar ini beserta CV-nya?')">
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
                    <td colspan="6" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center opacity-50">
                            <i class="fas fa-user-tie fa-3x mb-3 text-secondary"></i>
                            <h6 class="text-white fw-bold">Belum ada pelamar masuk</h6>
                            <p class="text-white-50 small mb-0">Data kandidat akan muncul di sini setelah mereka mengisi form karir.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
