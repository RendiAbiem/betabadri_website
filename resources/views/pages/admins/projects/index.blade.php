@extends('layouts.admins')

@section('title', 'Kelola Project Program')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Daftar Project Program</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Project</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span class="badge bg-info text-dark">{{ strtoupper($item->category) }}</span></td>
                <td class="text-white fw-bold">{{ $item->title }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.projects.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.projects.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
