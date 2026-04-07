@extends('layouts.admins')

@section('title', 'Kelola Partners')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-white fw-bold">Daftar Partners</h3>
        <p class="text-secondary small mb-0">Kelola logo mitra dan klien yang bekerjasama.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary fw-bold shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Baru
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
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Logo</th>
                    <th>Nama Partner</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $item)
                <tr>
                    <td class="text-secondary">{{ $loop->iteration }}</td>

                    <td>
                        <div class="bg-white rounded p-2 d-inline-flex align-items-center justify-content-center" style="height: 60px; min-width: 80px;">
                            <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->name }}" class="img-fluid" style="max-height: 40px; width: auto;">
                        </div>
                    </td>

                    <td>
                        <div class="fw-bold text-white">{{ $item->name }}</div>
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.partners.edit', $item->id) }}" class="btn btn-sm btn-outline-info rounded-circle" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>

                            <form action="{{ route('admin.partners.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus partner ini?')">
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
                    <td colspan="4" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                            <div class="p-3 bg-secondary bg-opacity-10 rounded-circle mb-3">
                                <i class="fas fa-handshake fa-2x text-secondary"></i>
                            </div>
                            <h6 class="text-white fw-bold">Belum ada data partner</h6>
                            <p class="text-white-50 small mb-0">Silakan tambahkan data baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
