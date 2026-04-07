@extends('layouts.admins')

@section('title', 'Input Laporan KBM')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-edit text-primary me-2"></i>Laporan KBM & Absensi
            </h4>
            <p class="text-secondary small m-0">Catat aktivitas mengajar dan kehadiran siswa secara real-time.</p>
        </div>
        <a href="{{ route('mentor.activity.export') }}" class="btn btn-outline-success btn-sm px-4 rounded-pill">
            <i class="fas fa-file-excel me-2"></i> Export Laporan
        </a>
    </div>

    <div class="content-card mb-4 shadow-sm" style="border-left: 4px solid #4361ee;">
        <div class="card-body-tech p-4">
            <form action="{{ route('mentor.activity.create') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label-tech text-secondary">SEKOLAH MITRA</label>
                        <select name="school_id" class="form-select-tech" onchange="this.form.submit()">
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach($schools as $s)
                                <option value="{{ $s->id }}" {{ request('school_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label-tech text-secondary">PROGRAM STUDI</label>
                        <select name="program_id" class="form-select-tech" onchange="this.form.submit()">
                            <option value="">-- Pilih Program --</option>
                            @foreach($programs as $p)
                                {{-- PERBAIKAN DI SINI: --}}
                                {{-- Cek jika ada sekolah yang dipilih, tampilkan HANYA program milik sekolah tsb --}}
                                @if(request('school_id') && $p->school_id != request('school_id'))
                                    @continue
                                @endif

                                <option value="{{ $p->id }}" {{ request('program_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="text-end">
                            <span class="badge bg-dark border border-secondary border-opacity-25 py-2 px-3 text-secondary">
                                <i class="fas fa-filter me-1"></i> Filter Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request('school_id') && request('program_id'))
        @if(count($students) > 0)
        <form action="{{ route('mentor.activity.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{ request('school_id') }}">
            <input type="hidden" name="program_id" value="{{ request('program_id') }}">

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="content-card h-100 shadow-lg">
                        <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center bg-black bg-opacity-20">
                            <h6 class="m-0 text-white fw-bold"><i class="fas fa-journal-whills me-2 text-warning"></i>JURNAL MENGAJAR</h6>
                        </div>

                        <div class="card-body-tech p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-tech">TANGGAL KEGIATAN</label>
                                    <input type="date" name="date" class="form-control-tech" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-tech">KELAS / ROMBEL</label>
                                    <input type="text" name="class_name" class="form-control-tech" placeholder="Cth: X RPL 2 / 7A" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-tech">MATERI (TOPIC) <span class="text-danger">*</span></label>
                                    <input type="text" name="topic" class="form-control-tech" placeholder="Cth: Pengenalan Sensor Ultrasonik" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-tech">CATATAN MENTOR (OPSIONAL)</label>
                                    <textarea name="notes" class="form-control-tech" rows="3" placeholder="Catatan kendala teknis, proyektor rusak, atau perilaku siswa..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-tech">DOKUMENTASI KELAS <span class="text-danger">*</span></label>
                                    <div class="upload-area-tech text-center p-4 rounded-3 border-dashed">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-secondary mb-3"></i>
                                        <p class="text-white-50 small mb-2">Klik box ini untuk upload foto</p>
                                        <input type="file" name="photo" class="file-input-tech" accept="image/*" required>
                                        <div id="preview-filename" class="text-info x-small mt-2 fw-bold"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="content-card h-100 shadow-lg d-flex flex-column">
                        <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center bg-black bg-opacity-20">
                            <h6 class="m-0 text-white fw-bold"><i class="fas fa-users me-2 text-success"></i>ABSENSI SISWA</h6>
                            <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-25">{{ count($students) }} Siswa</span>
                        </div>

                        <div class="px-4 py-2 bg-dark border-bottom border-secondary border-opacity-10">
                            <div class="row text-secondary x-small fw-bold text-uppercase ls-1">
                                <div class="col-7">Nama Siswa</div>
                                <div class="col-5 text-center">Status</div>
                            </div>
                        </div>

                        <div class="card-body-tech p-0 flex-grow-1 custom-scrollbar" style="max-height: 500px; overflow-y: auto;">
                            @foreach($students as $student)
                            <div class="attendance-row px-4 py-3 border-bottom border-secondary border-opacity-10 hover-bg">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <div class="text-white fw-bold small mb-0">{{ $student->name }}</div>
                                        <div class="text-secondary x-small font-monospace">NIS: {{ $student->nis ?? '-' }}</div>
                                    </div>
                                    <div class="col-5">
                                        <div class="status-btn-group d-flex justify-content-center gap-1">
                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="h-{{ $student->id }}" value="hadir" checked>
                                            <label class="btn btn-outline-success btn-xs-custom" for="h-{{ $student->id }}">H</label>

                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="s-{{ $student->id }}" value="sakit">
                                            <label class="btn btn-outline-warning btn-xs-custom" for="s-{{ $student->id }}">S</label>

                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="i-{{ $student->id }}" value="izin">
                                            <label class="btn btn-outline-info btn-xs-custom" for="i-{{ $student->id }}">I</label>

                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="a-{{ $student->id }}" value="alpha">
                                            <label class="btn btn-outline-danger btn-xs-custom" for="a-{{ $student->id }}">A</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="p-4 border-top border-secondary border-opacity-10 bg-black bg-opacity-20 mt-auto">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-blue">
                                <i class="fas fa-save me-2"></i> SIMPAN LAPORAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @else
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="text-center p-5 rounded-4 border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.02);">
                        <i class="fas fa-user-slash fa-4x text-secondary opacity-25 mb-4"></i>
                        <h5 class="text-white fw-bold">Data Siswa Tidak Ditemukan</h5>
                        <p class="text-secondary small">Belum ada data siswa terdaftar di sekolah dan program ini. Silakan hubungi Admin untuk input data siswa.</p>
                        <a href="{{ route('mentor.dashboard') }}" class="btn btn-navy-lighter btn-sm mt-3">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row justify-content-center mt-5" style="opacity: 0.5;">
            <div class="col-12 text-center">
                <i class="fas fa-arrow-up fa-3x text-primary mb-3 animate__animated animate__bounce"></i>
                <h5 class="text-white-50">Silakan pilih Sekolah dan Program di atas untuk memulai.</h5>
            </div>
        </div>
    @endif

</div>

<style>
    /* Custom CSS for Form Elements */
    .form-label-tech { font-size: 0.75rem; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 8px; display: block; text-transform: uppercase; }

    .form-select-tech, .form-control-tech {
        background-color: #0b1120; border: 1px solid rgba(255,255,255,0.15); color: white; border-radius: 10px; padding: 0.75rem 1rem; width: 100%; transition: 0.3s;
    }
    .form-select-tech:focus, .form-control-tech:focus {
        border-color: #4361ee; box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15); outline: none; background-color: #0f172a;
    }

    /* Attendance Buttons */
    .btn-xs-custom {
        width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; font-weight: bold; border-radius: 8px; font-size: 0.85rem;
    }
    .btn-check:checked + .btn-outline-success { background-color: #10b981; color: white; border-color: #10b981; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4); }
    .btn-check:checked + .btn-outline-warning { background-color: #f59e0b; color: white; border-color: #f59e0b; }
    .btn-check:checked + .btn-outline-info { background-color: #0ea5e9; color: white; border-color: #0ea5e9; }
    .btn-check:checked + .btn-outline-danger { background-color: #ef4444; color: white; border-color: #ef4444; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.4); }

    /* Upload Area */
    .border-dashed { border: 2px dashed rgba(255,255,255,0.15); transition: 0.3s; position: relative; }
    .border-dashed:hover { border-color: #4361ee; background: rgba(67, 97, 238, 0.05); }
    .file-input-tech { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }

    .hover-bg:hover { background: rgba(255,255,255,0.02); }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #0f172a; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
</style>

<script>
    // Simple Script untuk Preview Nama File
    document.querySelector('.file-input-tech').addEventListener('change', function(e){
        var fileName = e.target.files[0].name;
        document.getElementById('preview-filename').innerText = "File terpilih: " + fileName;
    });
</script>

@endsection
