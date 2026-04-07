<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-hidden="true"
     style="z-index: 9999;">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg" style="background: #161625; border: 1px solid rgba(255,255,255,0.1); color: white;">

            <div class="modal-header border-secondary border-opacity-10 bg-navy-lighter">
                <h5 class="modal-title fw-bold text-white fs-6">
                    <i class="fas fa-cash-register me-2 text-success"></i> Konfirmasi Pembayaran
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closePayModal()" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.finance.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" id="modalStudentId">

                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-4 p-3 rounded bg-primary bg-opacity-10 border border-primary border-opacity-20">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <small class="text-white-50 text-uppercase ls-1" style="font-size: 0.65rem;">Nama Siswa</small>
                            <h6 class="mb-0 fw-bold text-white" id="modalStudentName">...</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-white-50 small mb-2">Tanggal Transaksi</label>
                            <input type="date" name="payment_date" class="form-control form-control-dark"
                                   value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-white-50 small mb-2">Tagihan Bruto (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary border-opacity-25 text-success small">Rp</span>
                                <input type="number" name="amount" id="modalAmount"
                                       class="form-control form-control-dark fw-bold text-success" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-white-50 small mb-2">Potongan / Diskon (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-warning small">Rp</span>
                            <input type="number" name="discount" class="form-control form-control-dark"
                                   placeholder="0" value="0">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-white-50 small mb-2">Catatan Pembayaran</label>
                        <textarea name="notes" class="form-control form-control-dark" rows="2"
                                  placeholder="Contoh: Pembayaran tunai via loket..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-secondary border-opacity-10 bg-navy-lighter">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" onclick="closePayModal()">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm px-4 fw-bold">
                        <i class="fas fa-check-circle me-1"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div onclick="closePayModal()" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: -1;"></div>
</div>

<script>
    /**
     * Fungsi untuk menampilkan modal secara manual
     */
    function openPayModalRaw(id, name, price) {
        // Mapping Data ke Input
        const inputId = document.getElementById('modalStudentId');
        const inputName = document.getElementById('modalStudentName');
        const inputAmount = document.getElementById('modalAmount');

        if(inputId) inputId.value = id;
        if(inputName) inputName.innerText = name;
        if(inputAmount) inputAmount.value = price;

        // Trigger Tampilan Modal
        const modal = document.getElementById('payModal');
        modal.style.display = 'block';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
        document.body.style.overflow = 'hidden'; // Kunci scroll halaman utama
    }

    /**
     * Fungsi untuk menutup modal secara manual
     */
    function closePayModal() {
        const modal = document.getElementById('payModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
        document.body.style.overflow = 'auto'; // Aktifkan kembali scroll
    }
</script>

<style>
    /* Transisi Halus Modal Manual */
    #payModal {
        transition: opacity 0.3s linear;
        background: rgba(0,0,0,0.5);
    }
    #payModal.show {
        opacity: 1;
        display: block;
    }
    .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: translateY(-20px);
    }
    #payModal.show .modal-dialog {
        transform: translateY(0);
    }
</style>
