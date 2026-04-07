@extends('layouts.admins')

@section('title', 'Tambah Program Sekolah')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="text-white fw-bold mb-1">
            <i class="fas fa-plus-circle text-primary me-2"></i>Konfigurasi Program Sekolah
        </h4>
        <p class="text-secondary small mb-0">Pengaturan biaya (pricing) dan pembagian hasil (fee) per institusi.</p>
    </div>
    <a href="{{ route('admin.programs.index') }}" class="btn btn-navy-lighter btn-sm px-3">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">

        {{-- [ALERT ERROR] --}}
        @if ($errors->any())
        <div class="alert alert-danger border-danger border-opacity-25 bg-danger bg-opacity-10 text-danger mb-4 shadow-sm">
            <div class="d-flex">
                <div class="me-3 mt-1">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Gagal Menyimpan Data!</h6>
                    <ul class="mb-0 ps-3 small opacity-75">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        {{-- END ALERT --}}

        <div class="card-modern shadow-lg">
            <div class="card-body-tech p-4">
                <form action="{{ route('admin.programs.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label-tech">
                            <i class="fas fa-school me-2 text-primary opacity-50"></i>Pilih Target Sekolah <span class="text-danger">*</span>
                        </label>

                        {{-- [DROPDOWN SEKOLAH DENGAN TOMSELECT] --}}
                        {{-- ID 'select-school' digunakan oleh script di bawah --}}
                        <select id="select-school" name="school_id" class="form-select-tech @error('school_id') is-invalid @enderror" required>
                            <option value="">-- Cari & Pilih Sekolah --</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('school_id')
                            <div class="invalid-feedback text-danger x-small d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="border-secondary border-opacity-10 my-4">

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-tech">Jenis Program Baku</label>
                            <select name="name" class="form-select-tech select-tech-sm @error('name') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Program --</option>
                                <option value="Robotik Modular" {{ old('name') == 'Robotik Modular' ? 'selected' : '' }}>Robotik Modular</option>
                                <option value="Robotik Elektronik" {{ old('name') == 'Robotik Elektronik' ? 'selected' : '' }}>Robotik Elektronik</option>
                                <option value="Programming" {{ old('name') == 'Programming' ? 'selected' : '' }}>Programming (Coding)</option>
                                <option value="Cyber Security" {{ old('name') == 'Cyber Security' ? 'selected' : '' }}>Cyber Security</option>
                                <option value="Game Development" {{ old('name') == 'Game Development' ? 'selected' : '' }}>Game Development</option>
                            </select>
                            @error('name')
                                <div class="invalid-feedback text-danger x-small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-tech">Metode Penagihan</label>
                            <select name="payment_type" class="form-select-tech select-tech-sm" required>
                                <option value="Per Siswa" {{ old('payment_type') == 'Per Siswa' ? 'selected' : '' }}>Per Siswa</option>
                                <option value="Per Semester" {{ old('payment_type') == 'Per Semester' ? 'selected' : '' }}>Per Semester</option>
                                <option value="Per Sekolah" {{ old('payment_type') == 'Per Sekolah' ? 'selected' : '' }}>Per Sekolah</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-dark bg-opacity-25 border border-secondary border-opacity-10">
                                <label class="form-label-tech text-white">Harga Jual (Bruto)</label>
                                <div class="input-group-tech mt-2">
                                    <span class="input-group-text-tech">Rp</span>
                                    <input type="number" name="price" class="form-control-tech"
                                           placeholder="0" value="{{ old('price') }}" required min="0">
                                </div>
                                <div class="form-text text-secondary x-small mt-2">Harga yang muncul pada tagihan siswa.</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-dark bg-opacity-25 border border-secondary border-opacity-10">
                                <label class="form-label-tech text-warning">Fee Mitra (Sekolah)</label>
                                <div class="input-group-tech mt-2">
                                    <span class="input-group-text-tech text-warning">Rp</span>
                                    <input type="number" name="school_fee" class="form-control-tech text-warning"
                                           placeholder="0" value="{{ old('school_fee') }}" required min="0">
                                </div>
                                <div class="form-text text-secondary x-small mt-2">Nominal cashback/bagi hasil untuk sekolah.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-10">
                        <p class="small text-secondary mb-0"><span class="text-danger">*</span> Wajib diisi</p>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-navy-lighter px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-blue">
                                <i class="fas fa-save me-2"></i>Simpan Konfigurasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-modern bg-gradient-navy border-0 mb-4">
            <div class="card-body-tech p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h6 class="text-white fw-bold mb-0">Petunjuk Pengisian</h6>
                </div>
                <div class="small text-secondary lh-lg">
                    <ol class="ps-3 mb-0">
                        <li class="mb-2">Pastikan <strong>Sekolah</strong> terpilih dengan benar untuk menghindari kesalahan billing.</li>
                        <li class="mb-2"><strong>Fee Sekolah</strong> otomatis akan tercatat sebagai hutang operasional pada sistem accounting.</li>
                        <li>Nama Program harus sesuai standar <strong>Kurikulum Pusat</strong> agar sertifikat siswa valid.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card-modern border-dashed border-secondary border-opacity-25">
            <div class="card-body-tech p-4 text-center">
                <h2 class="text-white-50 mb-1"><i class="fas fa-calculator small"></i></h2>
                <h6 class="text-white small mb-0">Estimasi Net Profit</h6>
                <p class="text-secondary x-small mb-3">Otomatis dihitung sistem</p>
                <div class="fs-4 fw-bold text-success font-monospace">Rp 0</div>
            </div>
        </div>
    </div>
</div>

{{-- [STYLE & SCRIPT KHUSUS TOMSELECT] --}}
<style>
    /* CSS Dasar Form */
    .form-label-tech { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; display: block; margin-bottom: 8px; }
    .form-select-tech, .form-control-tech { background-color: #0b1120; border: 1px solid rgba(255,255,255,0.1); color: white; padding: 0.6rem 1rem; border-radius: 10px; transition: 0.3s; width: 100%; }
    .form-select-tech:focus, .form-control-tech:focus { border-color: #4361ee; box-shadow: 0 0 0 4px rgba(67,97,238,0.15); outline: none; background-color: #0f172a; }

    /* Validasi Error */
    .form-select-tech.is-invalid, .form-control-tech.is-invalid { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15); }
    .invalid-feedback { font-size: 0.75rem; margin-top: 5px; }

    /* Input Group & Lainnya */
    .input-group-tech { display: flex; align-items: stretch; }
    .input-group-text-tech { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-right: 0; border-radius: 10px 0 0 10px; padding: 0 1rem; display: flex; align-items: center; color: #64748b; font-weight: bold; }
    .input-group-tech .form-control-tech { border-radius: 0 10px 10px 0; }
    .shadow-blue { box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3); }
    .icon-circle { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .border-dashed { border-style: dashed !important; }

    /* --- TOMSELECT DARK THEME --- */
    .ts-control {
        background-color: #0b1120 !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: white !important;
        border-radius: 10px !important;
        padding: 0.6rem 1rem !important;
        box-shadow: none !important;
    }
    .ts-control.focus {
        border-color: #4361ee !important;
        box-shadow: 0 0 0 4px rgba(67,97,238,0.15) !important;
    }
    /* Handle Error Border di TomSelect */
    .ts-control.is-invalid, .was-validated .ts-control:invalid {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15) !important;
    }
    .ts-control input { color: white !important; }
    .ts-dropdown {
        background-color: #0f172a !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: white !important;
        border-radius: 10px !important;
        margin-top: 5px !important;
        overflow: hidden;
        z-index: 9999;
    }
    .ts-dropdown .option { padding: 10px 15px; cursor: pointer; }
    .ts-dropdown .active, .ts-dropdown .option:hover {
        background-color: #4361ee !important;
        color: white !important;
    }
    .ts-dropdown-content {
        max-height: 200px !important;
        overflow-y: auto !important;
    }
    .ts-wrapper.single .ts-control:after {
        border-color: #64748b transparent transparent transparent !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect("#select-school", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            placeholder: "-- Cari & Pilih Sekolah --",
            maxOptions: null, // Menampilkan semua opsi agar bisa discroll
        });
    });
</script>

@endsection
