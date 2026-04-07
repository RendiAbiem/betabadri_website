@extends('layouts.admins')

@section('title', 'Absensi & Kehadiran')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h3 class="mb-1 text-white fw-bold">Dashboard Absensi</h3>
        <p class="text-secondary small mb-0">Pantau kehadiran tim dan kelola absensi harian Anda.</p>
    </div>
    <div class="text-md-end p-3 rounded-3 bg-navy-lighter border border-secondary border-opacity-25 shadow-sm d-flex align-items-center gap-3">
        <div class="text-end">
            <h2 id="clock-display" class="text-white fw-bold mb-0" style="letter-spacing: 2px; font-family: monospace;">00.00.00</h2>
            <div class="text-cyan small fw-bold text-uppercase ls-1">
                {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
        <i class="fas fa-clock fa-2x text-secondary opacity-25"></i>
    </div>
</div>

{{-- Pesan Error Validasi --}}
@if ($errors->any())
    <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-danger border-opacity-25 mb-4 small">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success bg-success bg-opacity-10 text-success border-success border-opacity-25 mb-4">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
    </div>
@endif

<div class="row g-3 mb-4">
    {{-- Stat Cards --}}
    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center p-3 h-100 border-start border-4 border-success bg-navy-lighter">
            <div class="p-3 rounded-circle bg-success bg-opacity-10 text-success me-3">
                <i class="fas fa-user-check fa-lg"></i>
            </div>
            <div>
                <p class="text-secondary small mb-0 text-uppercase fw-bold">Hadir (Sesuai Filter)</p>
                <h3 class="text-white fw-bold mb-0">{{ $summary['present'] ?? 0 }}</h3>
                <small class="text-success small"><i class="fas fa-arrow-up"></i> Tepat Waktu</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center p-3 h-100 border-start border-4 border-warning bg-navy-lighter">
            <div class="p-3 rounded-circle bg-warning bg-opacity-10 text-warning me-3">
                <i class="fas fa-user-clock fa-lg"></i>
            </div>
            <div>
                <p class="text-secondary small mb-0 text-uppercase fw-bold">Terlambat</p>
                <h3 class="text-white fw-bold mb-0">{{ $summary['late'] ?? 0 }}</h3>
                <small class="text-warning small">Perlu Perhatian</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card d-flex align-items-center p-3 h-100 border-start border-4 border-danger bg-navy-lighter">
            <div class="p-3 rounded-circle bg-danger bg-opacity-10 text-danger me-3">
                <i class="fas fa-user-times fa-lg"></i>
            </div>
            <div>
                <p class="text-secondary small mb-0 text-uppercase fw-bold">Tidak Masuk</p>
                <h3 class="text-white fw-bold mb-0">{{ $summary['absent'] ?? 0 }}</h3>
                <small class="text-danger small">Izin / Alpha</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-4 order-lg-2">
        <div class="content-card sticky-top" style="top: 100px; z-index: 10;">
            <div class="card-header border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                <h6 class="text-white fw-bold mb-0">
                    <i class="fas fa-fingerprint text-primary me-2"></i> Absensi Saya
                </h6>
            </div>
            <div class="text-center">
                @if(!$todayAttendance)
                    <div class="py-3">
                        <div class="avatar-lg bg-secondary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px; height:80px;">
                            <i class="fas fa-camera fa-2x text-white-50"></i>
                        </div>
                        <h5 class="text-white fw-bold">Belum Absen</h5>
                        <p class="text-white-50 small px-2 mb-4">Unggah foto selfie/lokasi untuk melakukan Absen Masuk.</p>
                    </div>

                    {{-- Form Clock In: Wajib Foto --}}
                    <form id="form-clock-in" action="{{ route('admin.attendance.clockIn') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">

                        <div class="form-group mb-3 text-start">
                            <label class="text-white-50 small mb-2">Foto Selfie / Lokasi <span class="text-danger">*</span></label>
                            <input type="file" name="image_in" class="form-control form-control-dark" accept="image/*" required>
                        </div>

                        <button type="button" onclick="handleClockIn()" class="btn btn-primary w-100 py-3 fw-bold shadow-lg icon-link-hover">
                            <span>ABSEN MASUK</span> <i class="fas fa-map-marker-alt ms-2"></i>
                        </button>
                    </form>

                @elseif($todayAttendance->clock_out == null)
                    <div class="mb-4 text-start">
                        <div class="d-flex align-items-center mb-2 p-3 bg-success bg-opacity-10 rounded border border-success border-opacity-25">
                            <div class="me-3"><i class="fas fa-check-circle fa-2x text-success"></i></div>
                            <div>
                                <small class="text-success fw-bold text-uppercase">Berhasil Masuk ({{ $todayAttendance->work_mode }})</small>
                                <h4 class="text-white fw-bold mb-0">{{ $todayAttendance->clock_in }}</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Form Clock Out: Paragraf Singkat & Bukti Kerja --}}
                    <form action="{{ route('admin.attendance.clockOut', $todayAttendance->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3 text-start">
                            <label class="text-white-50 small mb-2">Ringkasan Kegiatan Hari Ini <span class="text-danger">*</span></label>
                            <textarea name="activity" class="form-control form-control-dark" rows="3" placeholder="Ceritakan singkat apa yang Anda kerjakan..." required maxlength="255">{{ old('activity') }}</textarea>
                            <small class="text-muted" style="font-size: 0.65rem;">Maksimal 255 karakter.</small>
                        </div>
                        <div class="form-group mb-4 text-start">
                            <label class="text-white-50 small mb-2">Upload Bukti Kerja (File/Doc/Gambar) <span class="text-danger">*</span></label>
                            <input type="file" name="report_file" class="form-control form-control-dark text-sm" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                            <i class="fas fa-sign-out-alt me-2"></i> KIRIM & PULANG
                        </button>
                    </form>

                @else
                    <div class="py-4">
                        <i class="fas fa-clipboard-check fa-4x text-success mb-3"></i>
                        <h4 class="text-white fw-bold">Tugas Selesai!</h4>
                        <p class="text-white-50 small">Terima kasih atas dedikasinya hari ini.</p>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <div class="text-center px-3 py-2 bg-navy-lighter rounded">
                                <small class="text-secondary d-block" style="font-size:0.6rem">MASUK ({{ $todayAttendance->work_mode }})</small>
                                <span class="text-white fw-bold">{{ $todayAttendance->clock_in }}</span>
                            </div>
                            <div class="text-center px-3 py-2 bg-navy-lighter rounded">
                                <small class="text-secondary d-block" style="font-size:0.6rem">PULANG</small>
                                <span class="text-white fw-bold">{{ $todayAttendance->clock_out }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8 order-lg-1">
        {{-- Filter Data --}}
        <div class="content-card mb-4 p-4">
            <h5 class="text-white fw-bold mb-3"><i class="fas fa-filter me-2 text-primary"></i> Filter Data</h5>
            <form action="" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="text-white-50 small mb-2">Rentang Waktu</label>
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control form-control-dark" value="{{ request('start_date', date('Y-m-01')) }}">
                            <span class="input-group-text bg-dark border-secondary border-opacity-25 text-white">-</span>
                            <input type="date" name="end_date" class="form-control form-control-dark" value="{{ request('end_date', date('Y-m-d')) }}">
                        </div>
                    </div>
                    @if(auth()->user()->role === 'admin')
                    <div class="col-md-3">
                        <label class="text-white-50 small mb-2">Role Staff</label>
                        <select name="role" class="form-control form-control-dark form-select-dark">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary fw-bold flex-grow-1"><i class="fas fa-search me-1"></i> Cari</button>
                            <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-secondary"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <h6 class="text-white fw-bold mb-0">Riwayat Kehadiran</h6>
                <a href="{{ route('admin.attendance.export', request()->query()) }}" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-file-excel me-1"></i> Export .CSV
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Staff</th>
                            <th>Mode</th>
                            <th>Waktu</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $key => $item)
                        <tr>
                            <td class="text-secondary">{{ $attendances->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="text-white fw-bold small">{{ $item->user->name }}</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-opacity-10 {{ $item->work_mode == 'WFO' ? 'bg-info text-info border-info' : 'bg-primary text-primary border-primary' }} border small">
                                    {{ $item->work_mode ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <span class="text-success fw-bold d-block" style="font-size: 0.75rem;">{{ $item->clock_in ?? '-' }}</span>
                                    <span class="text-white-50 d-block mt-1" style="font-size: 0.75rem;">{{ $item->clock_out ?? '--:--' }}</span>
                                </div>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-icon btn-outline-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#showModal{{ $item->id }}"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- MODAL SHOW DETAIL --}}
                        <div class="modal fade" id="showModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                                    <div class="modal-header border-bottom border-secondary border-opacity-25 p-4">
                                        <h5 class="modal-title text-white fw-bold">
                                            <i class="fas fa-clipboard-list text-primary me-2"></i> Detail Kehadiran
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-4">
                                            {{-- Foto Absen Masuk --}}
                                            @if($item->image_in)
                                            <div class="col-12">
                                                <label class="text-secondary small text-uppercase ls-1 mb-2" style="font-size: 0.65rem;">Foto Absen Masuk</label>
                                                <div class="rounded border border-secondary border-opacity-25 overflow-hidden" style="max-height: 300px;">
                                                    <img src="{{ asset('storage/' . $item->image_in) }}" class="w-100 object-fit-cover" alt="Foto Masuk" style="max-height: 300px;">
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-md-6">
                                                <div class="p-3 rounded bg-dark bg-opacity-50 border border-secondary border-opacity-10">
                                                    <small class="text-secondary d-block text-uppercase ls-1 mb-1" style="font-size: 0.65rem;">Nama Karyawan</small>
                                                    <h6 class="text-white fw-bold mb-0">{{ $item->user->name }}</h6>
                                                    <span class="badge bg-primary bg-opacity-10 text-primary mt-2">{{ ucfirst($item->user->role) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="p-3 rounded bg-dark bg-opacity-50 border border-secondary border-opacity-10">
                                                    <small class="text-secondary d-block text-uppercase ls-1 mb-1" style="font-size: 0.65rem;">Tanggal & Mode</small>
                                                    <h6 class="text-white fw-bold mb-0">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</h6>
                                                    <span class="text-cyan small fw-bold"><i class="fas fa-map-marker-alt me-1"></i> Bekerja via {{ $item->work_mode }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="text-center p-3 rounded border border-success border-opacity-25">
                                                    <small class="text-success d-block fw-bold mb-1" style="font-size: 0.6rem;">JAM MASUK</small>
                                                    <h5 class="text-white mb-0">{{ $item->clock_in ?? '--:--' }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3 rounded border border-danger border-opacity-25">
                                                    <small class="text-danger d-block fw-bold mb-1" style="font-size: 0.6rem;">JAM PULANG</small>
                                                    <h5 class="text-white mb-0">{{ $item->clock_out ?? '--:--' }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3 rounded border border-info border-opacity-25">
                                                    <small class="text-info d-block fw-bold mb-1" style="font-size: 0.6rem;">TOTAL DURASI</small>
                                                    <h5 class="text-white mb-0">
                                                        @if($item->clock_in && $item->clock_out)
                                                            {{ \Carbon\Carbon::parse($item->clock_in)->diff(\Carbon\Carbon::parse($item->clock_out))->format('%Hj %Im') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="text-secondary small text-uppercase ls-1 mb-2" style="font-size: 0.65rem;">Laporan Aktivitas Harian</label>
                                                <div class="p-3 rounded bg-navy-lighter border border-secondary border-opacity-10 text-white-50" style="white-space: pre-wrap; min-height: 80px; font-size: 0.9rem;">
                                                    {{ $item->activity ?? 'Laporan belum diisi.' }}
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="text-secondary small text-uppercase ls-1 mb-2" style="font-size: 0.65rem;">Berkas Pendukung</label>
                                                @if($item->report_file)
                                                    <div class="d-flex align-items-center p-3 rounded border border-primary border-opacity-25 bg-primary bg-opacity-5">
                                                        <i class="fas fa-file-alt fa-2x text-primary me-3"></i>
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-white mb-0 small">Dokumen_Laporan_{{ $item->id }}.{{ pathinfo($item->report_file, PATHINFO_EXTENSION) }}</h6>
                                                            <small class="text-secondary" style="font-size: 0.7rem;">Lampiran bukti kerja harian</small>
                                                        </div>
                                                        <a href="{{ asset('storage/' . $item->report_file) }}" target="_blank" class="btn btn-primary btn-sm px-3 fw-bold">
                                                            <i class="fas fa-download me-1"></i> BUKA
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="text-center py-3 border border-dashed border-secondary border-opacity-25 rounded text-secondary small fst-italic">
                                                        Tidak ada lampiran file.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top border-secondary border-opacity-25 p-3">
                                        <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal">TUTUP</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}

                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-white-50 small">Tidak ada data ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 px-2">
                {{ $attendances->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
        document.getElementById('clock-display').textContent = timeString.replace(/:/g, '.');
    }
    setInterval(updateClock, 1000);
    updateClock();

    function handleClockIn() {
        const btn = event.currentTarget;
        const form = document.getElementById('form-clock-in');
        const fileInput = form.querySelector('input[name="image_in"]');
        const originalText = btn.innerHTML;

        // Validasi file dulu
        if (!fileInput.value) {
            alert("Harap pilih/ambil foto terlebih dahulu.");
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mendeteksi Lokasi...';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lng').value = position.coords.longitude;
                    form.submit();
                },
                function(error) {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    alert("GPS tidak aktif atau akses lokasi ditolak browser. Lokasi dibutuhkan untuk verifikasi.");
                },
                { enableHighAccuracy: true }
            );
        } else {
            alert("Browser tidak mendukung geolokasi.");
            btn.disabled = false;
        }
    }
</script>

<style>
    .ls-1 { letter-spacing: 1px; }
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .bg-navy-lighter { background-color: rgba(30, 41, 59, 0.5); }
    .border-dashed { border-style: dashed !important; }
</style>
@endsection
