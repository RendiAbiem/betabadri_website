@extends('layouts.admins')

@section('title', 'Input Siswa Masal')

@section('content')
<div class="container py-4">
    <div class="top-navbar">
        <div class="admin-title">
            <h4 class="text-white">Registrasi Siswa (Masal)</h4>
            <p class="text-secondary small m-0">Gunakan fitur ini untuk input data kelas dalam jumlah banyak</p>
        </div>
        <a href="{{ route('mentor.dashboard') }}" class="btn btn-outline-info btn-sm px-3">
            <i class="fas fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    <form action="{{ route('mentor.students.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="dashboard-card mb-4 mt-2">
            <div class="card-header-tech">
                <h6 class="m-0 text-white"><i class="fas fa-layer-group me-2 text-primary"></i> Konfigurasi Penempatan</h6>
            </div>
            <div class="card-body-tech p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold tracking-wider">PILIH SEKOLAH</label>
                        <select name="school_id" id="schoolSelect" class="form-select-tech" required>
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold tracking-wider">PROGRAM (AUTO-ASSIGN)</label>
                        <select name="program_id" id="programSelect" class="form-select-tech" required disabled>
                            <option value="">-- Pilih Sekolah Terlebih Dahulu --</option>
                        </select>

                        <div class="mt-2 d-flex align-items-center gap-2">
                            <i class="fas fa-info-circle text-info" style="font-size: 0.8rem;"></i>
                            <span class="text-secondary opacity-75" style="font-size: 0.75rem;">
                                Program akan muncul otomatis sesuai sekolah yang dipilih.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header-tech d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 text-white"><i class="fas fa-user-plus me-2 text-success"></i> Entri Daftar Siswa</h6>
                <button type="button" class="btn btn-sm btn-outline-success border-2 rounded-pill px-3 fw-bold" id="add-row">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Baris
                </button>
            </div>

            <div class="card-body-tech p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom m-0 align-middle">
                        <thead>
                            <tr class="text-secondary small">
                                <th class="ps-4" width="5%">NO</th>
                                <th width="45%">NAMA LENGKAP SISWA</th>
                                <th width="20%">KELAS</th>
                                <th width="20%">GENDER</th>
                                <th class="text-end pe-4" width="10%">HAPUS</th>
                            </tr>
                        </thead>
                        <tbody id="student-table-body">
                            <tr class="student-row transition-all">
                                <td class="ps-4 text-secondary row-number fw-bold">1</td>
                                <td>
                                    <input type="text" name="inputs[0][name]" class="form-control-tech py-2" placeholder="Ketik nama lengkap..." required>
                                </td>
                                <td>
                                    <input type="text" name="inputs[0][class_name]" class="form-control-tech py-2" placeholder="Misal: 8-B" required>
                                </td>
                                <td>
                                    <select name="inputs[0][gender]" class="form-select-tech py-2" required>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-icon text-danger remove-row" disabled>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer-tech p-4 text-end bg-dark-soft">
                <button type="submit" class="btn btn-sm btn-outline-success border-2 rounded-pill px-3 fw-bold">
                    <i class="fas fa-database me-2"></i> PROSES SIMPAN MASAL
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- BAGIAN 1: LOGIKA DEPENDENT DROPDOWN (Sekolah -> Program) ---
        const schoolSelect = document.getElementById('schoolSelect');
        const programSelect = document.getElementById('programSelect');

        schoolSelect.addEventListener('change', function() {
            let schoolId = this.value;

            // Reset Dropdown Program
            programSelect.innerHTML = '<option value="">Loading...</option>';
            programSelect.disabled = true;

            if(schoolId) {
                // Panggil API (Pastikan route API sudah dibuat di web.php)
                fetch(`/api/school-programs/${schoolId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '<option value="">-- Pilih Program --</option>';

                        if(data.length > 0) {
                            data.forEach(program => {
                                let option = document.createElement('option');
                                option.value = program.id;
                                option.text = program.name;
                                programSelect.appendChild(option);
                            });
                            programSelect.disabled = false;
                        } else {
                            programSelect.innerHTML = '<option value="">Sekolah ini belum punya program</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        programSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    });
            } else {
                programSelect.innerHTML = '<option value="">-- Pilih Sekolah Terlebih Dahulu --</option>';
            }
        });


        // --- BAGIAN 2: LOGIKA TAMBAH/HAPUS BARIS TABEL ---
        let rowCount = 1;

        // Fungsi Tambah Baris
        document.getElementById('add-row').addEventListener('click', function() {
            const tableBody = document.getElementById('student-table-body');
            const newRow = document.createElement('tr');
            newRow.classList.add('student-row', 'fade-in'); // Pastikan CSS .fade-in ada

            newRow.innerHTML = `
                <td class="ps-4 text-secondary row-number fw-bold">${rowCount + 1}</td>
                <td>
                    <input type="text" name="inputs[${rowCount}][name]" class="form-control-tech py-2" placeholder="Ketik nama lengkap..." required>
                </td>
                <td>
                    <input type="text" name="inputs[${rowCount}][class_name]" class="form-control-tech py-2" placeholder="Misal: 8-B" required>
                </td>
                <td>
                    <select name="inputs[${rowCount}][gender]" class="form-select-tech py-2" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </td>
                <td class="text-end pe-4">
                    <button type="button" class="btn btn-icon text-danger remove-row">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
            rowCount++;
            updateRowNumbers();
        });

        // Fungsi Hapus Baris
        document.getElementById('student-table-body').addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                const allRows = document.querySelectorAll('.student-row');

                // Jangan hapus jika sisa 1 baris
                if (allRows.length > 1) {
                    row.style.opacity = '0'; // Efek visual sederhana
                    setTimeout(() => {
                        row.remove();
                        updateRowNumbers();
                    }, 200);
                }
            }
        });

        // Update Nomor Urut & Tombol Hapus
        function updateRowNumbers() {
            const rows = document.querySelectorAll('.student-row');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').innerText = index + 1;
                const deleteBtn = row.querySelector('.remove-row');
                // Disable tombol hapus jika cuma ada 1 baris
                deleteBtn.disabled = rows.length === 1;
            });
        }
    });
</script>

<style>
    /* Sedikit CSS Tambahan untuk Animasi */
    .fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .student-row {
        transition: all 0.2s ease;
    }
</style>
@endsection
