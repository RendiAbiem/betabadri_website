# Beta Badri Education - Admin Panel & Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Beta Badri Education adalah platform manajemen internal yang dirancang untuk mengelola aktivitas akademik, operasional kantor, dan arsip digital. Sistem ini mendukung multi-role (Admin, Staff, Mentor) dengan fokus pada privasi data.

## 🚀 Fitur Utama

### 1. 📌 Pusat Dokumen (Digital Sticky Notes)
Sistem manajemen catatan pribadi yang inovatif dengan tampilan *sticky notes*.
* **Privasi Total:** Setiap user hanya dapat melihat dan mengelola catatan miliknya sendiri.
* **Lampiran Opsional:** Mendukung berbagai format file (PDF, Docs, ZIP, Gambar) sebagai lampiran catatan.
* **Kategorisasi Visual:** Menggunakan warna-warni sticky notes untuk identifikasi cepat.

### 2. 📍 Absensi GPS & Selfie
Sistem kehadiran berbasis lokasi untuk verifikasi akurat.
* **Geolokasi:** Mendeteksi koordinat staff secara real-time saat absen.
* **Bukti Selfie:** Mewajibkan unggah foto lokasi/selfie sebagai bukti fisik kehadiran.
* **Laporan Kerja:** Input ringkasan kegiatan harian dan bukti file sebelum pulang.

### 3. 💸 Cashout & Pengeluaran
Manajemen pengajuan dana operasional yang transparan.
* **Approval System:** Pengajuan dana harus diverifikasi dan disetujui oleh Admin.
* **Rekapitulasi:** Dashboard grafik dan tabel history pengeluaran bulanan.

### 4. 🎓 Manajemen Akademik
* Pengelolaan database sekolah mitra dan data siswa.
* Area Mentor untuk input aktivitas KBM dan nilai proyek.

## 🛠️ Teknologi
* **Backend:** Laravel 12 (PHP 8.2)
* **Frontend:** Bootstrap 5 & FontAwesome 6
* **Data Handling:** Carbon, TomSelect, HTML5 Geolocation API

## ⚙️ Instalasi Cepat
```bash
git clone [https://github.com/RendiAbiem/betabadri_website.git](https://github.com/RendiAbiem/betabadri_website.git)
composer install
php artisan migrate
php artisan storage:link
php artisan serve

Developed by Beta Badri Education © 2026.
