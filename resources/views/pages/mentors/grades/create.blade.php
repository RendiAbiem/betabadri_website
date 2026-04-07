@extends('layouts.admins')

@section('title', 'Input Nilai Siswa')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-edit text-primary me-2"></i>Input Nilai Project
            </h4>
            <p class="text-secondary small m-0">Masukkan nilai evaluasi siswa berdasarkan kriteria project.</p>
        </div>
        <a href="{{ route('mentor.grades.index') }}" class="btn btn-navy-lighter btn-sm px-4 fw-bold shadow-sm rounded-pill text-white">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat
        </a>
    </div>

    <div class="content-card mb-4 shadow-sm border-start border-primary border-4">
        <div class="card-body-tech p-4">
            <form action="{{ route('mentor.grades.create') }}" method="GET">
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
                                {{-- Filter program sesuai sekolah yang dipilih --}}
                                @if(request('school_id') && $p->school_id != request('school_id'))
                                    @continue
                                @endif

                                <option value="{{ $p->id }}" {{ request('program_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="text-end">
                            <span class="badge bg-dark border border-secondary border-opacity-25 py-2 px-3 text-secondary w-100">
                                <i class="fas fa-filter me-1"></i> Filter Mode
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request('school_id') && request('program_id'))
        @if(count($students) > 0)
        <form action="{{ route('mentor.grades.store') }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ request('school_id') }}">
            <input type="hidden" name="program_id" value="{{ request('program_id') }}">

            <div class="content-card shadow-lg">

                <div class="p-4 border-bottom border-secondary border-opacity-10 bg-black bg-opacity-20 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                        <i class="fas fa-edit me-2 text-warning"></i>FORM PENILAIAN
                    </h6>
                    <span class="badge bg-primary bg-opacity-20 text-primary border border-primary border-opacity-25 px-3 py-2">
                        {{ count($students) }} Siswa Terdaftar
                    </span>
                </div>

                <div class="card-body-tech p-0">

                    <div class="p-4 bg-dark bg-opacity-50 border-bottom border-secondary border-opacity-10">
                        <label class="form-label-tech text-secondary mb-2">JUDUL PROJECT / MATERI UJIAN <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-white" style="border-radius: 10px 0 0 10px;">
                                <i class="fas fa-cube"></i>
                            </span>
                            <input type="text" name="project_name"
                                class="form-control-tech py-3 fw-bold text-white border-start-0"
                                style="border-radius: 0 10px 10px 0; font-size: 1.1rem;"
                                placeholder="Contoh: Membuat Website Profile Sekolah / Ujian Robotika Dasar" required>
                        </div>
                        <div class="form-text text-secondary opacity-50 small mt-2">
                            <i class="fas fa-info-circle me-1"></i> Nama project ini akan muncul di riwayat penilaian dan rapor siswa.
                        </div>
                    </div>

                    <div class="table-responsive custom-scrollbar" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-dark-custom m-0 align-middle">
                            <thead class="sticky-top bg-dark border-bottom border-secondary border-opacity-10" style="z-index: 10;">
                                <tr class="text-secondary x-small text-uppercase ls-1">
                                    <th class="ps-4 py-3 bg-dark" width="25%">Nama Siswa</th>
                                    <th width="15%" class="text-center bg-dark">Sikap <br><span class="text-white-50 x-small">(Attitude)</span></th>
                                    <th width="15%" class="text-center bg-dark">Keterampilan <br><span class="text-white-50 x-small">(Skill)</span></th>
                                    <th width="15%" class="text-center bg-dark">Pengetahuan <br><span class="text-white-50 x-small">(Knowledge)</span></th>
                                    <th width="30%" class="pe-4 bg-dark">Catatan Mentor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr class="hover-row border-bottom border-secondary border-opacity-10 transition-all">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial me-3 rounded-circle bg-navy-lighter border border-secondary border-opacity-25 d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 35px; height: 35px;">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h6 class="text-white fw-bold small mb-0">{{ $student->name }}</h6>
                                                <small class="text-secondary x-small font-monospace">{{ $student->nis ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2">
                                        <input type="number" name="grades[{{ $student->id }}][attitude]"
                                            class="form-control-tech text-center fw-bold score-input"
                                            min="0" max="100" placeholder="0" required>
                                    </td>
                                    <td class="px-2">
                                        <input type="number" name="grades[{{ $student->id }}][skill]"
                                            class="form-control-tech text-center fw-bold score-input"
                                            min="0" max="100" placeholder="0" required>
                                    </td>
                                    <td class="px-2">
                                        <input type="number" name="grades[{{ $student->id }}][knowledge]"
                                            class="form-control-tech text-center fw-bold score-input"
                                            min="0" max="100" placeholder="0" required>
                                    </td>
                                    <td class="pe-4">
                                        <input type="text" name="grades[{{ $student->id }}][notes]"
                                            class="form-control-tech text-secondary small"
                                            placeholder="Catatan...">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer-tech p-4 bg-black bg-opacity-20 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                    <div class="text-secondary x-small">
                        <i class="fas fa-info-circle me-1"></i> Pastikan semua nilai terisi.
                    </div>
                    <button type="submit" class="btn btn-warning px-5 py-2 fw-bold shadow-sm text-dark rounded-pill">
                        <i class="fas fa-save me-2"></i> SIMPAN NILAI
                    </button>
                </div>
            </div>
        </form>
        @else
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="text-center p-5 rounded-4 border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.02);">
                        <i class="fas fa-user-slash fa-4x text-secondary opacity-25 mb-4"></i>
                        <h5 class="text-white fw-bold">Data Siswa Kosong</h5>
                        <p class="text-secondary small">Tidak ditemukan siswa aktif di kelas ini.</p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row justify-content-center mt-5 opacity-50">
            <div class="col-12 text-center">
                <i class="fas fa-arrow-up fa-3x text-primary mb-3 animate__animated animate__bounce"></i>
                <h5 class="text-white-50">Pilih Sekolah & Program di atas untuk memulai penilaian.</h5>
            </div>
        </div>
    @endif

</div>

<style>
    /* Styling Khusus Input Nilai */
    .form-label-tech { font-size: 0.75rem; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 8px; display: block; text-transform: uppercase; }

    .form-select-tech, .form-control-tech {
        background-color: #0b1120; border: 1px solid rgba(255,255,255,0.15); color: white; border-radius: 8px; padding: 0.6rem 1rem; width: 100%; transition: 0.3s;
    }
    .form-select-tech:focus, .form-control-tech:focus {
        border-color: #4361ee; box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15); outline: none; background-color: #0f172a;
    }

    /* Score Input Special Style */
    .score-input:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15); }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #0f172a; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }

    .btn-navy-lighter { background: #1e293b; color: #f1f5f9; border: 1px solid rgba(255,255,255,0.1); }
    .btn-navy-lighter:hover { background: #334155; color: white; }

    .ls-1 { letter-spacing: 1px; }
    .uppercase { text-transform: uppercase; }
</style>

<script>
    // Script Auto-Color untuk Nilai
    // Jika nilai < 75, text jadi merah. Jika >= 90, text jadi hijau.
    document.querySelectorAll('.score-input').forEach(input => {
        input.addEventListener('input', function() {
            let val = parseInt(this.value);
            if(val < 75) {
                this.style.color = '#ef4444'; // Merah
            } else if (val >= 90) {
                this.style.color = '#10b981'; // Hijau
            } else {
                this.style.color = 'white'; // Putih
            }
        });
    });
</script>
@endsection
