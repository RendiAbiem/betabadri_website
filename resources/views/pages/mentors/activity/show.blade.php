@extends('layouts.admins')

@section('title', 'Detail Jurnal Mengajar')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-file-invoice text-primary me-2"></i>Detail Jurnal Mengajar
            </h4>
            <div class="d-flex align-items-center gap-2 text-secondary small">
                <span><i class="far fa-clock me-1"></i> Diinput pada {{ $journal->created_at->format('d M Y, H:i') }}</span>
                <span class="text-secondary opacity-50">•</span>
                <span>Oleh: <span class="text-white fw-bold">{{ auth()->user()->name }}</span></span>
            </div>
        </div>
        <div>
            <a href="{{ route('mentor.activity.index') }}" class="btn btn-navy-lighter btn-sm px-4 fw-bold shadow-sm rounded-pill text-white">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            {{-- <a href="#" class="btn btn-warning btn-sm px-4 fw-bold shadow-sm rounded-pill text-dark ms-2">
                <i class="fas fa-edit me-2"></i> Edit
            </a> --}}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="content-card shadow-lg mb-4">
                <div class="p-4 border-bottom border-secondary border-opacity-10 bg-black bg-opacity-20 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                        <i class="fas fa-info-circle me-2 text-info"></i>DATA KEGIATAN
                    </h6>
                    <span class="badge bg-primary bg-opacity-20 text-primary border border-primary border-opacity-25 px-3">
                        {{ \Carbon\Carbon::parse($journal->date)->format('l, d F Y') }}
                    </span>
                </div>
                <div class="card-body-tech p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-secondary x-small fw-bold text-uppercase mb-1">SEKOLAH MITRA</label>
                            <div class="d-flex align-items-center bg-dark bg-opacity-50 p-3 rounded-3 border border-secondary border-opacity-10">
                                <div class="icon-square bg-primary bg-opacity-20 text-primary me-3 rounded-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div>
                                    <h6 class="text-white fw-bold mb-0 small">{{ $journal->school->name }}</h6>
                                    <small class="text-secondary x-small">Program: {{ $journal->program->name }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-secondary x-small fw-bold text-uppercase mb-1">KELAS / ROMBEL</label>
                            <div class="d-flex align-items-center bg-dark bg-opacity-50 p-3 rounded-3 border border-secondary border-opacity-10">
                                <div class="icon-square bg-success bg-opacity-20 text-success me-3 rounded-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h6 class="text-white fw-bold mb-0 small">{{ $journal->class_name }}</h6>
                                    <small class="text-secondary x-small">{{ $journal->attendances->count() }} Siswa Terdaftar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="text-secondary x-small fw-bold text-uppercase mb-2">MATERI YANG DIAJARKAN</label>
                            <div class="p-3 rounded-3 bg-navy-lighter border border-secondary border-opacity-10">
                                <p class="text-white mb-0 fw-medium"><i class="fas fa-book-open me-2 text-warning"></i> {{ $journal->topic }}</p>
                            </div>
                        </div>

                        @if($journal->notes)
                        <div class="col-12">
                            <label class="text-secondary x-small fw-bold text-uppercase mb-2">CATATAN / KENDALA</label>
                            <div class="p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25">
                                <p class="text-warning small fst-italic mb-0">
                                    <i class="fas fa-exclamation-circle me-2"></i> "{{ $journal->notes }}"
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="content-card shadow-lg">
                <div class="p-4 border-bottom border-secondary border-opacity-10 bg-black bg-opacity-20">
                    <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                        <i class="fas fa-camera me-2 text-warning"></i>BUKTI DOKUMENTASI
                    </h6>
                </div>
                <div class="card-body-tech p-3">
                    @if($journal->photo_proof)
                        <div class="position-relative group-hover-zoom overflow-hidden rounded-3 border border-secondary border-opacity-25" style="max-height: 400px;">
                            <img src="{{ asset('storage/' . $journal->photo_proof) }}"
                                 alt="Dokumentasi Kelas"
                                 class="img-fluid w-100 object-fit-cover"
                                 style="min-height: 300px;">

                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-all">
                                <a href="{{ asset('storage/' . $journal->photo_proof) }}" target="_blank" class="btn btn-light rounded-pill px-4 fw-bold shadow-lg transform-scale">
                                    <i class="fas fa-search-plus me-2"></i> Lihat Ukuran Penuh
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="py-5 text-center">
                            <div class="mb-3">
                                <span class="fa-stack fa-2x opacity-50">
                                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                                    <i class="fas fa-image-slash fa-stack-1x text-secondary"></i>
                                </span>
                            </div>
                            <h6 class="text-white-50">Tidak ada dokumentasi foto.</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="content-card h-100 shadow-lg d-flex flex-column">
                <div class="p-4 border-bottom border-secondary border-opacity-10 bg-black bg-opacity-20 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                        <i class="fas fa-user-check me-2 text-success"></i>REKAP KEHADIRAN
                    </h6>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-25" title="Hadir">
                            {{ $journal->attendances->where('status', 'hadir')->count() }} H
                        </span>
                        <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-25" title="Alpha/Sakit/Izin">
                            {{ $journal->attendances->where('status', '!=', 'hadir')->count() }} TH
                        </span>
                    </div>
                </div>

                <div class="card-body-tech p-0 flex-grow-1 custom-scrollbar" style="max-height: 600px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-dark-custom m-0 align-middle">
                            <thead class="sticky-top bg-dark border-bottom border-secondary border-opacity-10">
                                <tr class="text-secondary x-small text-uppercase">
                                    <th class="ps-4 py-3">Siswa</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($journal->attendances as $attendance)
                                <tr class="hover-row border-bottom border-secondary border-opacity-10 transition-all">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial me-3 rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm"
                                                 style="width: 32px; height: 32px; font-size: 0.75rem; background: {{ $attendance->status == 'hadir' ? '#10b981' : '#ef4444' }};">
                                                {{ strtoupper(substr($attendance->student->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h6 class="text-white fw-bold small mb-0">{{ $attendance->student->name }}</h6>
                                                <small class="text-secondary x-small font-monospace">{{ $attendance->student->nis ?? 'No ID' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($attendance->status == 'hadir')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 x-small fw-bold">
                                                HADIR
                                            </span>
                                        @elseif($attendance->status == 'sakit')
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-1 x-small fw-bold">
                                                SAKIT
                                            </span>
                                        @elseif($attendance->status == 'izin')
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3 py-1 x-small fw-bold">
                                                IZIN
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1 x-small fw-bold">
                                                ALPHA
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-3 bg-black bg-opacity-20 border-top border-secondary border-opacity-10 text-center">
                    <small class="text-secondary x-small">Total {{ $journal->attendances->count() }} siswa dalam rombel ini.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Utility Classes */
    .x-small { font-size: 0.75rem; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .uppercase { text-transform: uppercase; }
    .btn-navy-lighter { background: #1e293b; color: #f1f5f9; border: 1px solid rgba(255,255,255,0.1); }
    .btn-navy-lighter:hover { background: #334155; color: white; transform: translateY(-2px); }

    /* Hover Effects Table */
    .hover-row:hover { background: rgba(255, 255, 255, 0.02) !important; }
    .transition-all { transition: all 0.3s ease; }

    /* Image Hover Effect */
    .group-hover-zoom:hover .hover-opacity-100 { opacity: 1 !important; }
    .hover-opacity-100 { transition: opacity 0.3s ease-in-out; }
    .transform-scale:hover { transform: scale(1.05); }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #0f172a; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
</style>
@endsection
