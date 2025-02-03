<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Matakuliah</title>
    <link rel="icon" href="{{ asset('lte/dist/img/favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 10px;
            text-align: center;
            position: relative;

        }
        .logo {
            position: absolute;
            width: 80px;
            left: 20px;
        }
        .header-content {
            text-align: center;
        }
        .title {
            font-weight: bold;
            font-size: 18px;
        }
        .subtitle {
            font-size: 16px;
        }
        .address {
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }
        .info-table {
            font-size: 12px;
            margin-bottom: 8px;
        }
        .info-table td {
            text-align: left;
            border: none;
            padding: 5px;
        }

        .footer {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .footer .signature {
            text-align: center;
            page-break-inside: avoid;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('lte/dist/img/ikt.png') }}" alt="Logo" class="logo">
    <div class="header-content">
        <div class="title">INSTITUT KESEHATAN DAN TEKNOLOGI BUTON RAYA</div>
        <div class="subtitle">KOTA BAUBAU</div>
        <div class="subtitle">SK KEMENDIKBUDRISTEK RI NOMOR 448/E/O/2021</div>
        <div class="address">Jalan Latsitarda No. 17 Kel. Lamangga Kec. Murhum Kota Baubau. No. Telp. (0402) 2827023</div>
    </div>
</div>

<h5 style="text-align: center;">DAFTAR HADIR MAHASISWA</h5>

<table class="info-table">
    <tr>
        <td>Dosen</td>
        <td>: {{$jadwal->dosen->nama_dosen ?? ''}}</td>

        <td>Program Studi</td>
        <td>: {{$jadwal->prodi_jadwal->nama_prodi}}</td>
    </tr>
    <tr>
        <td>Matakuliah</td>
        <td>: {{$jadwal->jadwal_matakuliah->nama_mk}}</td>

        <td>Semester</td>
        <td>: {{$jadwal->jadwal_matakuliah->semester}}</td>
    </tr>
    <tr>
        <td>Hari</td>
        <td>: {{$jadwal->hari}}</td>

        <td>Tahun Akademik</td>
        <td>: {{$tahun_aktif->tahun_akademik}}</td>
    </tr>

    <tr>
        <td>Jam</td>
        <td>: {{$jadwal->jam}} WITA</td>
    </tr>
</table>

<table>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">NIM</th>
        <th rowspan="2">Nama</th>
        <th colspan="16">PERTEMUAN KE/TANGGAL</th>
        <th rowspan="2">Absen</th>
        <th rowspan="2">Izin</th>
        <th rowspan="2">Sakit</th>
    </tr>
    <tr>
        @for($i = 1; $i <= 16; $i++)
            <th>{{ $i }}</th>
        @endfor
    </tr>
    @foreach($mhs as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->krs_mhs->nim }}</td>
            <td>{{ $item->krs_mhs->nama_mhs }}</td>
            @for($i = 1; $i <= 16; $i++)
                <td></td>
            @endfor
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"><strong>Paraf Dosen</strong></td>
        @for($i = 1; $i <= 19; $i++)
            <td></td>
        @endfor
    </tr>
</table>

<div class="page-break"></div>
<h3 style="text-align: center;">Pelaksanan Perkuliahan</h3>
<table class="info-table">
    <tr>
        <td>Dosen</td>
        <td>: {{$jadwal->dosen->nama_dosen ?? ''}}</td>

        <td>Program Studi</td>
        <td>: {{$jadwal->prodi_jadwal->nama_prodi}}</td>
    </tr>
    <tr>
        <td>Matakuliah</td>
        <td>: {{$jadwal->jadwal_matakuliah->nama_mk}}</td>

        <td>Semester</td>
        <td>: {{$jadwal->jadwal_matakuliah->semester}}</td>
    </tr>
    <tr>
        <td>Hari</td>
        <td>: {{$jadwal->hari}}</td>

        <td>Tahun Akademik</td>
        <td>: {{$tahun_aktif->tahun_akademik}}</td>
    </tr>

    <tr>
        <td>Jam</td>
        <td>: {{$jadwal->jam}}</td>
    </tr>
</table>
<table>
    <tr>
        <th>TANGGAL/<br>PERTEMUAN KE</th>
        <th>POKOK BAHASAN/ SUB POKOK BAHASAN</th>
        <th>KEHADIRAN</th>
        <th>PARAF</th>
        <th>KETERANGAN</th>
    </tr>
    @for($i = 1; $i <= 16; $i++)
        <tr>
            <td>{{ $i }}</td>
            <td></td>
            <td>Hadir: [___] Orang<br>Alpa: [___]  Orang<br>Izin: [___] Orang</td>
            <td></td>
            <td></td>
        </tr>
    @endfor
</table>

<div class="footer">
    <div class="signature">
        <div class="signature" style="text-align: left; float: left; width: 40%;">
            <br>
            <p>Dosen Pengajar</p>
            <br><br><br><br><br><br><br>
            <p>{{$jadwal->dosen->gelar_depan ?? ''}} {{$jadwal->dosen->nama_dosen}}, {{$jadwal->dosen->gelar_belakang}}</p>
            <p>NIDN. {{$jadwal->dosen->nidn}}</p>
        </div>
    </div>

    <div class="signature" style="text-align: left; float: right; width: 50%;">
        <p>Baubau,  </p>
        <p>Institut Kesehatan dan Teknologi Buton Raya</p>
        <p>Wakil Rektor Bidang Akademik dan Kemahasiswaan</p>
        <br><br><br><br>
        <p>Abdul Malik Darmin, S.K.M.,M.P.H</p>
        <p>NIDN. 0726129003</p>
    </div>


</div>
</body>
</html>
