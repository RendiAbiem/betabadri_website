@extends('layouts.admins')

@section('title', 'Registrasi Siswa Masal')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="text-white fw-bold mb-1">
                <i class="fas fa-users-viewfinder text-primary me-2"></i>Registrasi Siswa (Masal)
            </h4>
            <p class="text-secondary small m-0">Input data siswa dalam jumlah banyak sekaligus untuk efisiensi waktu.</p>
        </div>
        <a href="{{ route('admin.students.index') }}" class="btn btn-navy-lighter btn-sm px-3 border border-secondary border-opacity-25 text-white">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Data Siswa
        </a>
    </div>

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf

        <div class="card-modern mb-4 shadow-lg">
            <div class="card-header-tech p-4 border-bottom border-secondary border-opacity-10 bg-black bg-opacity-20">
                <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                    <span class="badge bg-primary me-2 px-3 py-2 rounded-pill">01</span>
                    KONFIGURASI PROGRAM & SEKOLAH
                </h6>
            </div>
            <div class="card-body-tech p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-tech">SEKOLAH MITRA <span class="text-danger">*</span></label>
                        <div class="input-group-tech shadow-sm">
                            <span class="input-group-text-tech bg-dark border-secondary border-opacity-25"><i class="fas fa-school"></i></span>
                            <select name="school_id" id="schoolSelect" class="form-select-tech" required>
                                <option value="" selected disabled>-- Pilih Sekolah --</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-tech">PROGRAM BAKU <span class="text-danger">*</span></label>
                        <div class="input-group-tech shadow-sm">
                            <span class="input-group-text-tech bg-dark border-secondary border-opacity-25"><i class="fas fa-tags"></i></span>
                            <select name="program_id" id="programSelect" class="form-select-tech" required disabled>
                                <option value="">-- Pilih Sekolah Dulu --</option>
                            </select>
                        </div>
                        <div class="mt-2 px-1">
                            <small class="text-info opacity-75 italic"><i class="fas fa-info-circle me-1"></i>Hanya menampilkan program aktif di sekolah terpilih.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-modern border-top border-4 border-success shadow-lg">
            <div class="card-header-tech p-4 border-bottom border-secondary border-opacity-10 d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-black bg-opacity-20 gap-3">
                <h6 class="m-0 text-white fw-bold uppercase letter-spacing-1">
                    <span class="badge bg-success me-2 px-3 py-2 rounded-pill">02</span>
                    ENTRI DATA SISWA
                </h6>

                <div class="d-flex gap-2">
                    <a href="{{ asset('templates/format_import_siswa.xlsx') }}" class="btn btn-navy-lighter btn-sm border border-secondary border-opacity-25 text-white-50">
                        <i class="fas fa-download me-1"></i> Format Excel
                    </a>

                    <button type="button" class="btn btn-outline-success btn-sm px-3" onclick="document.getElementById('excel_file').click()">
                        <i class="fas fa-file-excel me-1"></i> Import Excel
                    </button>
                    <input type="file" id="excel_file" class="d-none" accept=".xlsx, .xls">

                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 fw-bold shadow-sm" id="add-row">
                        <i class="fas fa-plus me-1"></i> Tambah Baris
                    </button>
                </div>
            </div>

            <div class="card-body-tech p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom m-0 align-middle">
                        <thead>
                            <tr class="text-secondary small text-uppercase letter-spacing-1 bg-dark bg-opacity-50">
                                <th class="ps-4 py-3" width="60">No</th>
                                <th width="40%">Nama Lengkap Siswa</th>
                                <th width="25%">Kelas / Rombel</th>
                                <th width="20%">Gender</th>
                                <th class="text-end pe-4" width="80">Hapus</th>
                            </tr>
                        </thead>
                        <tbody id="student-table-body">
                            <tr class="student-row transition-all">
                                <td class="ps-4">
                                    <span class="text-secondary row-number font-monospace fw-bold fs-6">1</span>
                                </td>
                                <td>
                                    <input type="text" name="inputs[0][name]" class="form-control-tech py-2" placeholder="Masukkan nama lengkap..." required>
                                </td>
                                <td>
                                    <input type="text" name="inputs[0][class_name]" class="form-control-tech py-2" placeholder="Cth: 7-A / X-TKJ" required>
                                </td>
                                <td>
                                    <select name="inputs[0][gender]" class="form-select-tech py-2" required>
                                        <option value="L">Laki-laki (L)</option>
                                        <option value="P">Perempuan (P)</option>
                                    </select>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-icon-only text-danger remove-row" disabled>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer-tech p-4 border-top border-secondary border-opacity-10 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-secondary small d-flex align-items-center bg-dark bg-opacity-50 px-3 py-2 rounded-pill">
                    <i class="fas fa-keyboard text-primary me-2"></i>
                    <span>Tips: Gunakan tombol <b>TAB</b> di keyboard untuk berpindah kolom lebih cepat.</span>
                </div>
                <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold shadow-blue rounded-pill">
                    <i class="fas fa-cloud-upload-alt me-2"></i>SIMPAN DATA MASAL
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    /* Styling Peningkatan Visual & Label Besar */
    .form-label-tech {
        font-size: 0.85rem;
        font-weight: 800;
        color: #f8fafc;
        letter-spacing: 1.2px;
        margin-bottom: 12px;
        display: block;
        text-transform: uppercase;
    }

    .input-group-tech { display: flex; align-items: stretch; }

    .input-group-text-tech {
        border: 1px solid rgba(255,255,255,0.1);
        border-right: 0;
        border-radius: 12px 0 0 12px;
        padding: 0 1.25rem;
        color: #4361ee;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .form-select-tech, .form-control-tech {
        background-color: #0b1120;
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 1rem;
    }

    .input-group-tech .form-select-tech { border-radius: 0 12px 12px 0; }

    .form-control-tech:focus, .form-select-tech:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 5px rgba(67, 97, 238, 0.2);
        outline: none;
        background-color: #0f172a;
    }

    .student-row { border-bottom: 1px solid rgba(255,255,255,0.05); }
    .student-row:hover { background: rgba(67, 97, 238, 0.05); }
    .transition-all { transition: all 0.2s ease-in-out; }

    .btn-icon-only { width: 38px; height: 38px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s; border: none; background: rgba(220, 53, 69, 0.1); }
    .btn-icon-only:hover:not(:disabled) { background: rgba(220, 53, 69, 0.2); transform: scale(1.1); }
    .btn-icon-only:disabled { opacity: 0.2; cursor: not-allowed; filter: grayscale(1); }

    .shadow-blue { box-shadow: 0 10px 20px -5px rgba(67, 97, 238, 0.5); }
    .letter-spacing-1 { letter-spacing: 1px; }
    .btn-navy-lighter { background: #1e293b; color: #f1f5f9; }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    // --- [BARU] Ambil Role User agar bisa dibaca JS ---
    const currentUserRole = "{{ auth()->user()->role }}";

    document.addEventListener('DOMContentLoaded', function() {
        const schoolSelect = document.getElementById('schoolSelect');
        const programSelect = document.getElementById('programSelect');
        const tableBody = document.getElementById('student-table-body');
        const addRowBtn = document.getElementById('add-row');
        const excelInput = document.getElementById('excel_file');
        const rupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

        // 1. AJAX LOAD PROGRAM
        schoolSelect.addEventListener('change', function() {
            let schoolId = this.value;
            programSelect.innerHTML = '<option value="">Memuat...</option>';
            programSelect.disabled = true;

            if(schoolId) {
                fetch(`/api/school-programs/${schoolId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '<option value="" selected disabled>-- Pilih Program --</option>';
                        if(data.length > 0) {
                            data.forEach(program => {
                                let option = document.createElement('option');
                                option.value = program.id;
                                let priceFormatted = rupiah.format(program.price);

                                // --- [BARU] LOGIKA HIDE HARGA ---
                                if (currentUserRole === 'admin') {
                                    // Admin: Tampilkan lengkap (Nama + Harga)
                                    option.text = `${program.name} — ${priceFormatted} (${program.payment_type})`;
                                } else {
                                    // User Lain: Tampilkan Nama Saja
                                    option.text = program.name;
                                }
                                // --------------------------------

                                programSelect.appendChild(option);
                            });
                            programSelect.disabled = false;
                        } else {
                            programSelect.innerHTML = '<option value="">Sekolah ini tidak punya program aktif</option>';
                        }
                    })
                    .catch(err => console.error("Gagal mengambil data program."));
            }
        });

        // 2. RE-INDEX ROWS
        function updateRowNumbers() {
            const rows = document.querySelectorAll('.student-row');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').innerText = index + 1;
                row.querySelector('input[name*="[name]"]').name = `inputs[${index}][name]`;
                row.querySelector('input[name*="[class_name]"]').name = `inputs[${index}][class_name]`;
                row.querySelector('select[name*="[gender]"]').name = `inputs[${index}][gender]`;
                row.querySelector('.remove-row').disabled = rows.length === 1;
            });
        }

        // 3. ADD ROW
        addRowBtn.addEventListener('click', function() {
            const index = document.querySelectorAll('.student-row').length;
            const newRow = document.createElement('tr');
            newRow.classList.add('student-row', 'transition-all');
            newRow.innerHTML = `
                <td class="ps-4"><span class="text-secondary row-number font-monospace fw-bold fs-6"></span></td>
                <td><input type="text" name="inputs[${index}][name]" class="form-control-tech py-2" placeholder="Masukkan nama lengkap..." required></td>
                <td><input type="text" name="inputs[${index}][class_name]" class="form-control-tech py-2" placeholder="Cth: 7-A / X-TKJ" required></td>
                <td>
                    <select name="inputs[${index}][gender]" class="form-select-tech py-2" required>
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </td>
                <td class="text-end pe-4">
                    <button type="button" class="btn btn-icon-only text-danger remove-row"><i class="fas fa-trash-alt"></i></button>
                </td>
            `;
            tableBody.appendChild(newRow);
            updateRowNumbers();
            newRow.querySelector('input[name*="[name]"]').focus();
        });

        // 4. REMOVE ROW
        tableBody.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                if (document.querySelectorAll('.student-row').length > 1) {
                    row.classList.add('opacity-0');
                    setTimeout(() => {
                        row.remove();
                        updateRowNumbers();
                    }, 200);
                }
            }
        });

        // 5. EXCEL IMPORT LOGIC
        excelInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                const data = new Uint8Array(event.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });

                const rows = jsonData.slice(1); // Lewati header
                if(rows.length > 0) {
                    const firstRowName = document.querySelector('input[name="inputs[0][name]"]');
                    if(firstRowName && firstRowName.value === "") {
                        tableBody.innerHTML = '';
                    }

                    rows.forEach((row) => {
                        if(row[0]) {
                            addRowBtn.click();
                            const lastRow = document.querySelector('.student-row:last-child');
                            lastRow.querySelector('input[name*="[name]"]').value = row[0];
                            lastRow.querySelector('input[name*="[class_name]"]').value = row[1] || '';
                            lastRow.querySelector('select[name*="[gender]"]').value = (row[2] && row[2].toUpperCase() == 'P') ? 'P' : 'L';
                        }
                    });
                }
                excelInput.value = '';
            };
            reader.readAsArrayBuffer(file);
        });
    });
</script>
@endsection
