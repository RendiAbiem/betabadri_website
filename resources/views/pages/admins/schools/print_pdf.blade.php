<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Siswa - {{ $school->name }}</title>
    <style>
        /* Desain Khusus PDF / Cetak */
        @page { size: A4; margin: 2cm; }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header Style */
        .kop-surat {
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 22px;
            color: #000;
            text-transform: uppercase;
        }
        .kop-surat p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }

        /* Dokumen Info */
        .doc-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .doc-title h2 {
            margin: 0;
            font-size: 18px;
            text-decoration: underline;
        }
        .meta-info {
            width: 100%;
            font-size: 11px;
            margin-bottom: 10px;
        }

        /* Table Design */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background-color: #f2f2f2;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            border: 1px solid #ccc;
            padding: 10px 5px;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            font-size: 11px;
            vertical-align: middle;
        }
        tr:nth-child(even) { background-color: #fafafa; }

        /* Gender Badge Style (Text only for PDF) */
        .text-center { text-align: center; }

        /* Footer/Tanda Tangan */
        .signature-wrapper {
            margin-top: 50px;
            width: 100%;
        }
        .signature-box {
            float: right;
            width: 200px;
            text-align: center;
            font-size: 12px;
        }
        .space { height: 70px; }

        .watermark {
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 10px;
            color: #ccc;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <h1>BETA BADRI EDUCATION</h1>
        <p>Pusat Pelatihan Robotik & Pemrograman Anak</p>
        <p>{{ $school->address }}</p>
        <p>Email: info@betabadri.com | Web: www.betabadri.com</p>
    </div>

    <div class="doc-title">
        <h2>LAPORAN DATA SISWA</h2>
        <p style="font-size: 12px; margin-top: 5px;">Sekolah: {{ $school->name }}</p>
    </div>

    <table class="meta-info" style="border: none;">
        <tr>
            <td style="border: none; padding: 0;">Dicetak oleh: Admin Dashboard</td>
            <td style="border: none; padding: 0; text-align: right;">Tanggal: {{ date('d F Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Lengkap</th>
                <th width="15%">Kelas</th>
                <th width="10%">L/P</th>
                <th width="40%">Program Pilihan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td style="font-weight: bold;">{{ strtoupper($student->name) }}</td>
                <td class="text-center">{{ $student->class_name }}</td>
                <td class="text-center">{{ $student->gender }}</td>
                <td>{{ $student->program->name ?? 'Belum Terdaftar' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data siswa terdaftar untuk sekolah ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-wrapper">
        <div class="signature-box">
            <p>Pekanbaru, {{ date('d M Y') }}</p>
            <p>Petugas Administrasi,</p>
            <div class="space"></div>
            <p><strong>( ____________________ )</strong></p>
            <p>Staff Akademik</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="watermark">
        Generatad by Beta Badri Admin System - {{ date('Y') }}
    </div>

</body>
</html>
