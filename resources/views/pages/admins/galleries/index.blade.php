@extends('layouts.admins')

@section('title', 'Kelola Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white fw-bold">Galeri Foto</h3>
        <p class="text-secondary small mb-0">Dokumentasi kegiatan dan portfolio.</p>
    </div>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary fw-bold shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Foto
    </a>
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
                    <th style="width: 5%;">#</th>
                    <th style="width: 15%;">Foto</th>
                    <th style="width: 15%;">Kategori</th>
                    <th>Judul</th>
                    <th style="width: 10%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $item)
                <tr>
                    <td class="text-secondary">{{ $loop->iteration }}</td>

                    <td>
                        <div class="rounded overflow-hidden border border-secondary border-opacity-25" style="height: 60px; width: 90px;">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Foto" class="w-100 h-100 object-fit-cover">
                        </div>
                    </td>

                    <td>
                        <span class="badge bg-navy-lighter text-cyan border border-cyan border-opacity-25 rounded-pill px-3">
                            {{ strtoupper($item->category) }}
                        </span>
                    </td>

                    <td>
                        <div class="fw-bold text-white">{{ $item->title ?? '-' }}</div>
                    </td>

                    <td class="text-center">
                        <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                            <i class="fas fa-images fa-2x mb-3 text-secondary"></i>
                            <h6 class="text-white fw-bold">Belum ada foto</h6>
                            <p class="text-white-50 small mb-0">Silakan upload dokumentasi baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
