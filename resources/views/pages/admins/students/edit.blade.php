@extends('layouts.admins')

@section('title', 'Edit Siswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Edit Data Siswa</h4>
        <p class="text-secondary small mb-0">Perbarui profil dan status akademik siswa.</p>
    </div>
    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="content-card p-4">
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Asal Sekolah <span class="text-danger">*</span></label>
                        <select name="school_id" id="schoolSelect" class="form-select form-select-dark" required>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id', $student->school_id) == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Program Belajar <span class="text-danger">*</span></label>
                        <select name="program_id" id="programSelect" class="form-select form-select-dark" required>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $student->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        <div id="programLoading" class="text-info x-small mt-1 d-none">
                            <i class="fas fa-spinner fa-spin me-1"></i> Memuat program...
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-dark"
                               value="{{ old('name', $student->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="class_name" class="form-control form-control-dark"
                               value="{{ old('class_name', $student->class_name) }}" placeholder="Contoh: 7A" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">NISN</label>
                        <input type="number" name="nisn" class="form-control form-control-dark"
                               value="{{ old('nisn', $student->nisn) }}" placeholder="Masukkan 10 digit NISN">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Status Siswa</label>
                        <select name="is_active" class="form-select form-select-dark">
                            <option value="1" {{ old('is_active', $student->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $student->is_active) == 0 ? 'selected' : '' }}>Non-Aktif / Alumni</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="d-flex gap-4 mt-2 p-3 rounded bg-navy-lighter border border-secondary border-opacity-10">
                        <div class="form-check custom-radio">
                            <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" {{ old('gender', $student->gender) == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="genderL">
                                <i class="fas fa-mars me-1 text-info"></i> Laki-laki
                            </label>
                        </div>
                        <div class="form-check custom-radio">
                            <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" {{ old('gender', $student->gender) == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="genderP">
                                <i class="fas fa-venus me-1 text-danger"></i> Perempuan
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end pt-3 border-top border-secondary border-opacity-25 mt-2">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fas fa-save me-2"></i> Update Data Siswa
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="content-card border-start border-4 border-primary">
            <h6 class="text-white fw-bold mb-3">Ringkasan Program</h6>
            <div class="text-secondary small">
                <p>Pastikan <strong>Program Belajar</strong> yang dipilih sesuai dengan sekolah saat ini.</p>
                <hr class="border-secondary opacity-25">
                <p class="mb-0"><i class="fas fa-info-circle me-1 text-primary"></i> Jika Anda mengubah Sekolah, pilihan Program akan otomatis diperbarui.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const schoolSelect = document.getElementById('schoolSelect');
        const programSelect = document.getElementById('programSelect');
        const loadingIndicator = document.getElementById('programLoading');

        // Formatter Rupiah
        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });

        // Event saat Sekolah Berubah
        schoolSelect.addEventListener('change', function() {
            const schoolId = this.value;

            // Tampilkan Loading & Disable Dropdown
            programSelect.disabled = true;
            programSelect.innerHTML = '<option value="">Memuat...</option>';
            loadingIndicator.classList.remove('d-none');

            if (schoolId) {
                // Fetch API Program sesuai ID Sekolah
                fetch(`/api/school-programs/${schoolId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '<option value="">-- Pilih Program --</option>';

                        if(data.length > 0) {
                            data.forEach(program => {
                                let option = document.createElement('option');
                                option.value = program.id;
                                let priceFormatted = rupiah.format(program.price);
                                option.text = `${program.name} (${priceFormatted})`;
                                programSelect.appendChild(option);
                            });
                        } else {
                            programSelect.innerHTML = '<option value="">Tidak ada program di sekolah ini</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        programSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    })
                    .finally(() => {
                        // Sembunyikan Loading & Enable Dropdown
                        programSelect.disabled = false;
                        loadingIndicator.classList.add('d-none');
                    });
            } else {
                programSelect.innerHTML = '<option value="">-- Pilih Sekolah Dulu --</option>';
                loadingIndicator.classList.add('d-none');
            }
        });
    });
</script>

@endsection
