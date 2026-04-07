@extends('layouts.admins')

@section('title', 'Data Testimonial')

@section('content')

{{-- HEADER & SEARCH BAR --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">Daftar Testimonial</h4>
        <p class="text-secondary small mb-0">Kelola ulasan yang akan ditampilkan di landing page.</p>
    </div>

    <div class="d-flex flex-column flex-sm-row gap-2 align-items-sm-center">
        {{-- Form Pencarian --}}
        <form action="{{ route('admin.testimonials.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-dark border-secondary text-white"
                       placeholder="Cari nama, role, sekolah..." value="{{ request('search') }}"
                       style="background-color: rgba(255, 255, 255, 0.05);">
                <button class="btn btn-outline-secondary px-3" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                {{-- Tombol Reset/Clear (muncul jika sedang mencari) --}}
                @if(request('search'))
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-danger px-3" title="Hapus Pencarian">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>

        {{-- Tombol Tambah --}}
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary fw-bold shadow-sm text-nowrap">
            <i class="fas fa-plus me-2"></i> Tambah
        </a>
    </div>
</div>

{{-- TABEL DATA --}}
<div class="content-card">
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th class="ps-4" width="5%">No</th>
                    <th width="30%">Penulis</th>
                    <th width="20%">Status/Role</th>
                    <th width="35%">Isi Ulasan</th>
                    <th width="10%" class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $item)
                <tr class="border-bottom border-secondary border-opacity-10 hover-row">
                    <td class="ps-4 text-secondary">{{ $loop->iteration + $testimonials->firstItem() - 1 }}</td>

                    {{-- NAMA PENULIS & FOTO --}}
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($item->photo && Storage::disk('public')->exists($item->photo))
                                <img src="{{ asset('storage/' . $item->photo) }}"
                                    class="rounded-circle border border-secondary border-opacity-50"
                                    width="40" height="40"
                                    style="object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center fw-bold border border-primary border-opacity-25"
                                    style="width: 40px; height: 40px;">
                                    {{ substr($item->name, 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <h6 class="text-white mb-0 small fw-bold">{{ $item->name }}</h6>
                            </div>
                        </div>
                    </td>

                    {{-- ROLE, JABATAN, & SEKOLAH --}}
                    <td>
                        <div class="d-flex flex-column align-items-start">
                            @php
                                $badgeColor = match($item->role) {
                                    'Siswa' => 'info',
                                    'Sekolah' => 'success',
                                    'Orang Tua' => 'warning',
                                    default => 'secondary'
                                };
                            @endphp

                            {{-- Badge Role --}}
                            <span class="badge bg-{{ $badgeColor }} bg-opacity-10 text-{{ $badgeColor }} border border-{{ $badgeColor }} border-opacity-25 rounded-pill mb-1" style="font-size: 0.65rem;">
                                {{ $item->role }}
                            </span>

                            {{-- Teks Jabatan --}}
                            @if(!empty($item->position))
                                <span class="text-white-50 x-small mt-1">
                                    <i class="fas fa-id-card-alt me-1 opacity-50"></i> {{ $item->position }}
                                </span>
                            @endif

                            {{-- Menampilkan Asal Sekolah --}}
                            @if($item->school_id && $item->school)
                                <span class="text-primary x-small mt-1">
                                    <i class="fas fa-school me-1 opacity-50"></i> {{ $item->school->name }}
                                </span>
                            @endif

                            {{-- Jika tidak ada jabatan DAN tidak ada sekolah --}}
                            @if(empty($item->position) && !$item->school_id)
                                <span class="text-secondary x-small opacity-25 mt-1">-</span>
                            @endif
                        </div>
                    </td>

                    {{-- ISI ULASAN --}}
                    <td>
                        <p class="text-white-50 small mb-0 text-truncate" style="max-width: 300px;">
                            "{{ Str::limit($item->content, 60) }}"
                        </p>
                    </td>

                    {{-- AKSI --}}
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn btn-sm btn-outline-info rounded-circle">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimonial ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="fas fa-search fs-1 text-secondary opacity-25 mb-3"></i>
                        <p class="text-secondary">
                            @if(request('search'))
                                Tidak ditemukan testimonial dengan kata kunci "<strong>{{ request('search') }}</strong>".
                            @else
                                Belum ada data testimonial.
                            @endif
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($testimonials->hasPages())
    <div class="p-3 border-top border-secondary border-opacity-25">
        {{ $testimonials->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
