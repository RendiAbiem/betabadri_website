@extends('layouts.admins')

@section('title', 'Detail Pelamar')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Detail Pelamar</h4>
        <p class="text-secondary small mb-0">Informasi lengkap kandidat dan berkas lamaran.</p>
    </div>
    <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3 mb-4">
                <h5 class="text-white mb-0"><i class="fas fa-user-circle me-2 text-primary"></i> Profil Kandidat</h5>

                @if($applicant->status == 'pending')
                    <span class="badge bg-navy-lighter text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill">
                        <i class="fas fa-clock me-1"></i> Status: Baru
                    </span>
                @else
                    <span class="badge bg-navy-lighter text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                        <i class="fas fa-check-double me-1"></i> Status: Dilihat
                    </span>
                @endif
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <label class="text-white-50 small text-uppercase fw-bold mb-1 ls-1">Nama Lengkap</label>
                    <div class="text-white fs-5 fw-bold">{{ $applicant->first_name }} {{ $applicant->last_name }}</div>
                </div>

                <div class="col-md-6">
                    <label class="text-white-50 small text-uppercase fw-bold mb-1 ls-1">Tanggal Melamar</label>
                    <div class="text-white">
                        <i class="far fa-calendar-alt me-1 text-secondary"></i>
                        {{ $applicant->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-white-50 small text-uppercase fw-bold mb-1 ls-1">Alamat Email</label>
                    <div class="text-white">
                        <a href="mailto:{{ $applicant->email }}" class="text-decoration-none text-cyan hover-bright">
                            <i class="far fa-envelope me-1"></i> {{ $applicant->email }}
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-white-50 small text-uppercase fw-bold mb-1 ls-1">Nomor Telepon / WA</label>
                    <div class="text-white">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $applicant->phone)) }}"
                           target="_blank" class="text-decoration-none text-white hover-bright">
                            <i class="fab fa-whatsapp me-1 text-success"></i> {{ $applicant->phone }}
                        </a>
                    </div>
                </div>

                <div class="col-12">
                    <label class="text-white-50 small text-uppercase fw-bold mb-2 mt-2 ls-1">Pesan / Cover Letter</label>
                    <div class="p-4 rounded position-relative bg-navy-lighter border-start border-4 border-primary">
                        <i class="fas fa-quote-right position-absolute text-secondary" style="top: 15px; right: 20px; opacity: 0.1; font-size: 2rem;"></i>
                        <p class="mb-0 text-white-50 lh-lg" style="white-space: pre-line;">
                            {{ $applicant->message ?? 'Tidak ada pesan tambahan yang dilampirkan.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card mb-4 text-center">
            <h6 class="text-white fw-bold mb-4 border-bottom border-secondary border-opacity-25 pb-2">Berkas Lamaran</h6>

            <div class="py-5 mb-4 rounded d-flex flex-column align-items-center justify-content-center bg-navy-lighter border-2 border-dashed border-secondary border-opacity-25">
                <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                <h6 class="text-white mb-1">Curriculum Vitae</h6>
                <small class="text-secondary">Dokumen Pendukung Pelamar</small>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ asset('storage/' . $applicant->cv_path) }}" target="_blank" class="btn btn-primary fw-bold py-2">
                    <i class="fas fa-external-link-alt me-2"></i> Buka / Download CV
                </a>
            </div>
        </div>

        <div class="content-card border border-danger border-opacity-25">
            <h6 class="text-danger fw-bold mb-3"><i class="fas fa-exclamation-triangle me-2"></i> Zona Berbahaya</h6>
            <p class="text-secondary small mb-3">Tindakan ini akan menghapus data pelamar dan file CV terkait secara permanen.</p>

            <form action="{{ route('admin.careers.destroy', $applicant->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus lamaran dari {{ $applicant->first_name }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100 fw-bold">
                    <i class="fas fa-trash-alt me-2"></i> Hapus Lamaran
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
