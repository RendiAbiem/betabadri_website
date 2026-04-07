@extends('layouts.admins')

@section('title', 'Form Pengajuan Cuti')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 text-white fw-bold">Formulir Pengajuan</h4>
        <p class="text-secondary small mb-0">Lengkapi data untuk mengajukan cuti atau izin.</p>
    </div>
    <a href="{{ route('admin.leaves.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

{{-- TANGKAP ERROR DARI CONTROLLER --}}
@if(session('error'))
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card shadow-lg p-4 p-md-5">
            <form action="{{ route('admin.leaves.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-secondary small fw-bold text-uppercase mb-2">Nama Lengkap</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary opacity-50" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <label class="text-secondary small fw-bold text-uppercase mb-2">Jenis Cuti/Izin <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control bg-dark text-white border-secondary @error('type') is-invalid @enderror" required>
                            <option value="" selected disabled>-- Pilih Jenis --</option>
                            <option value="Cuti Tahunan/Libur" {{ old('type') == 'Cuti Tahunan/Libur' ? 'selected' : '' }}>Cuti Tahunan/Libur</option>
                            <option value="Cuti Sakit" {{ old('type') == 'Cuti Sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                            <option value="Izin Keperluan Mendesak" {{ old('type') == 'Izin Keperluan Mendesak' ? 'selected' : '' }}>Izin Keperluan Mendesak</option>
                            <option value="Cuti Khusus" {{ old('type') == 'Cuti Khusus' ? 'selected' : '' }}>Cuti Khusus (Menikah/Melahirkan/Duka)</option>
                        </select>
                        @error('type') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div id="notice_box" class="mb-4 d-none">
                    <div class="alert alert-warning bg-warning bg-opacity-10 text-warning border-warning border-opacity-25 py-2 px-3 small mb-0">
                        <i class="fas fa-info-circle me-2"></i> <span id="notice_text"></span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-5">
                        <label class="text-secondary small fw-bold text-uppercase mb-2">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control bg-dark text-white border-secondary @error('start_date') is-invalid @enderror" required>
                        @error('start_date') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="text-secondary small fw-bold text-uppercase mb-2">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="form-control bg-dark text-white border-secondary @error('end_date') is-invalid @enderror" required>
                        @error('end_date') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-2 d-flex flex-column justify-content-end">
                        <div class="p-2 rounded bg-primary bg-opacity-10 border border-primary border-opacity-25 text-center h-100 d-flex flex-column justify-content-center">
                            <span class="text-secondary" style="font-size: 0.65rem; text-transform: uppercase;">Total</span>
                            <h5 id="total_days_label" class="text-primary fw-bold mb-0">0</h5>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-secondary small fw-bold text-uppercase mb-2">Alasan / Keterangan <span class="text-danger">*</span></label>
                    <textarea name="reason" class="form-control bg-dark text-white border-secondary @error('reason') is-invalid @enderror" rows="4" placeholder="Jelaskan alasan pengajuan secara detail (Min. 10 Karakter)..." required>{{ old('reason') }}</textarea>
                    @error('reason') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>

                <div class="mb-5">
                    <label class="text-secondary small fw-bold text-uppercase mb-2">Unggah Dokumen Pendukung</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-upload"></i></span>
                        <input type="file" name="attachment" class="form-control bg-dark text-white border-secondary @error('attachment') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <small class="text-secondary opacity-50 fst-italic mt-1 d-block">Format: PDF/JPG/PNG. Maksimal 2MB. Diperlukan untuk Cuti Sakit/Khusus.</small>
                    @error('attachment') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>

                <div class="d-flex justify-content-end pt-3 border-top border-secondary border-opacity-25">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const leaveType = document.getElementById('type'); // Sesuai dengan id baru
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const totalLabel = document.getElementById('total_days_label');
    const noticeBox = document.getElementById('notice_box');
    const noticeText = document.getElementById('notice_text');

    function updateCalculations() {
        if (startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            start.setHours(0,0,0,0);
            end.setHours(0,0,0,0);

            if (end >= start) {
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                totalLabel.innerText = diffDays;
                totalLabel.classList.replace('text-danger', 'text-primary');
            } else {
                totalLabel.innerText = "Err";
                totalLabel.classList.replace('text-primary', 'text-danger');
            }
        }

        if (leaveType.value) {
            noticeBox.classList.remove('d-none');
            const val = leaveType.value;
            if (val === 'Cuti Sakit') {
                noticeText.innerText = "Wajib melampirkan Surat Dokter pada kolom Unggah Dokumen.";
            } else if (val === 'Cuti Khusus') {
                noticeText.innerText = "Sertakan bukti pendukung (Surat Nikah/Keterangan Duka/Lahir).";
            } else if (val === 'Cuti Tahunan/Libur') {
                noticeText.innerText = "Cuti tahunan minimal diajukan 7 hari sebelum tanggal pelaksanaan.";
            } else {
                noticeBox.classList.add('d-none');
            }
        }
    }

    startDate.addEventListener('change', updateCalculations);
    endDate.addEventListener('change', updateCalculations);
    leaveType.addEventListener('change', updateCalculations);

    // Trigger saat pertama kali load (berguna jika user kena validasi back)
    updateCalculations();
});
</script>
@endpush

<style>
    ::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }
</style>
@endsection
