@extends('layouts.admins')

@section('title', 'Input Cashout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="text-white fw-bold mb-1">Input Cashout Baru</h4>
        <p class="text-secondary small mb-0">Catat detail pengeluaran untuk pembukuan.</p>
    </div>
    <a href="{{ route('admin.expenses.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

{{-- TANGKAP ERROR VALIDASI DARI CONTROLLER --}}
@if ($errors->any())
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 p-3 rounded mb-4">
        <h6 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i> Gagal Menyimpan!</h6>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="content-card p-4">
            <form action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Nama Pengeluaran <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control form-control-dark @error('title') is-invalid @enderror" placeholder="Contoh: Beli Domain, Bayar Listrik" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Nominal (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-secondary">Rp</span>

                            {{-- Input Text untuk tampilan (dengan titik) --}}
                            <input type="text" id="amount_display" class="form-control form-control-dark @error('amount') is-invalid @enderror" placeholder="0" required>

                            {{-- Input Hidden untuk dikirim ke database (angka murni tanpa titik) --}}
                            <input type="hidden" name="amount" id="amount_actual" value="{{ old('amount') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="text-white-50 small mb-2">Tanggal (Bulan/Tanggal/Tahun) <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control form-control-dark @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Bukti Invoice / Struk (Bisa lebih dari 1)</label>

                    {{-- Tambahkan multiple dan array [] pada name --}}
                    <input type="file" name="images[]" class="form-control form-control-dark text-secondary @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" accept="image/*" multiple>

                    <div class="form-text text-secondary x-small mt-1">
                        *Format: JPG, PNG. Maks 2MB per file. (Tahan tombol CTRL/CMD untuk memilih banyak file)
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-white-50 small mb-2">Catatan Tambahan</label>
                    <textarea name="description" class="form-control form-control-dark @error('description') is-invalid @enderror" rows="3" placeholder="Detail keperluan...">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex justify-content-end pt-3 border-top border-secondary border-opacity-25">
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="content-card border-start border-4 border-warning">
            <h6 class="text-white fw-bold mb-3">Info Alur Cashout</h6>
            <div class="text-secondary small">
                <ul class="ps-3 mb-0">
                    <li class="mb-2">Data yang diinput akan berstatus <strong>Pending</strong>.</li>
                    <li class="mb-2"><strong>Wajib upload foto struk/invoice</strong> jika nominal pengeluaran di atas Rp 100.000 untuk audit.</li>
                    <li class="mb-2">Bisa mengunggah beberapa struk sekaligus jika diperlukan.</li>
                    <li>Pastikan tanggal sesuai dengan yang tertera di bukti pembayaran.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountDisplay = document.getElementById('amount_display');
        const amountActual = document.getElementById('amount_actual');

        // Fungsi untuk memformat angka dengan titik (Ribuan)
        function formatNumber(num) {
            return parseInt(num, 10).toLocaleString('id-ID');
        }

        // Jika form gagal validasi (kembali dari server), kembalikan format angkanya
        if(amountActual.value) {
            amountDisplay.value = formatNumber(amountActual.value);
        }

        amountDisplay.addEventListener('input', function(e) {
            // Hapus semua karakter yang bukan angka
            let rawValue = this.value.replace(/[^0-9]/g, '');

            // Simpan nilai asli (angka murni) ke input hidden untuk dikirim ke server
            amountActual.value = rawValue;

            // Format nilai dengan titik pemisah ribuan standar Indonesia
            if (rawValue) {
                this.value = formatNumber(rawValue);
            } else {
                this.value = '';
            }
        });

        // Pastikan input hidden terisi sebelum form di-submit
        amountDisplay.closest('form').addEventListener('submit', function() {
            if (amountDisplay.value) {
                amountActual.value = amountDisplay.value.replace(/[^0-9]/g, '');
            }
        });
    });
</script>
@endpush

<style>
    /* Memperbaiki kursor pada kalender Chrome agar tetap terlihat jelas dengan background gelap */
    ::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }
    /* Mengubah warna icon kalender bawaan browser menjadi putih */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1); /* Membalik warna hitam menjadi putih */
        cursor: pointer;
        opacity: 0.8; /* Opsional: Biar tidak terlalu mencolok */
    }

    input[type="date"]::-webkit-calendar-picker-indicator:hover {
        opacity: 1;
    }
</style>
@endsection
