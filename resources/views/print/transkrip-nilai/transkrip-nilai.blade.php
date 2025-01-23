<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSKRIP NILAI {{$mhs->nim}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 8px;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .info-table {
            margin-bottom: 8px;
        }
        .info-table td {
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
    <img src="{{ public_path('lte/dist/img/ikt.png') }}" alt="Logo Universitas">
    <h2>INSTITUT KESEHATAN DAN TEKNOLOGI BUTON RAYA</h2>
    <h3>TRANSKRIP NILAI</h3>
</div>

<table class="info-table">
    <tr>
        <td>Nama</td>
        <td>: {{$mhs->nama_mhs}}</td>
        <td rowspan="7" style="width: 100px; text-align: center;">
            <img src="{{ $foto->profile_picture ? public_path('storage/' .$foto->profile_picture) : public_path('lte/dist/img/default-user-photo.png') }}"  style="width: 80px; height: auto; border-radius: 5px;">
        </td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>: {{$mhs->nim}}</td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>: {{$mhs->prodi_mhs->nama_prodi}}</td>
    </tr>
    <tr>
        <td>IP Kumulatif</td>
        <td>: {{$ips}}</td>
    </tr>
    <tr>
        <td>Total SKS dilulusi</td>
        <td>: {{$jumlah_sks}}</td>
    </tr>
    <tr>
        <td>Total Mata Kuliah diambil</td>
        <td>: {{$jumlah_mk}}</td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Kode Matakuliah</th>
        <th>Nama Matakuliah</th>
        <th>SKS</th>
        <th>Nilai Angka</th>
        <th>Nilai Huruf</th>
        <th>Total (SKS X Nilai Angka)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($khs_mhs as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->matakuliah_id }}</td>
            <td>{{ $item->nilai_matakuliah_mhs->nama_mk }}</td>
            <td>{{ $item->sks }}</td>
            <td>{{ $item->nilai_angka }}</td>
            <td>{{ $item->nilai_huruf }}</td>
            <td>{{ $item->total_nilai }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6" class="text-end"><strong>Total SKS diambil:</strong></td>
        <td id="jumlah_sks"><strong>{{$total_sks}}</strong></td>
    </tr>
    <tr>
        <td colspan="6" class="text-end"><strong>Jumlah Matakuliah Diambil:</strong></td>
        <td id="jumlah_mk"><strong>{{$jumlah_mk}}</strong></td>
    </tr>
    <tr>
        <td colspan="6" class="text-end"><strong>IP Kumulatif:</strong></td>
        <td id="ips"><strong>{{$ips}}</strong></td>
    </tr>

    </tfoot>
</table>

{{--<div class="page-break"></div>--}}
<div class="footer">
    <div class="signature" style="text-align: left; float: left; width: 50%;">
        <p>Wakil Rektor Bidang Akademik dan Kemahasiswaan</p>
        <br><br><br><br>
        <p>Abdul Malik Darmin, S.K.M.,M.P.H</p>
        <p>NIDN. 0726129003</p>
    </div>

    <div class="signature">
        <div class="signature" style="text-align: left; float: right; width: 40%;">
{{--            <p>Baubau, {{$tanggal}}</p>--}}
            <p>Ketua Program Studi</p>
            <br><br><br><br><br>
            <p>{{$ka_prodi->dosen->gelar_depan ?? ''}} {{$ka_prodi->dosen->nama_dosen}}, {{$ka_prodi->dosen->gelar_belakang}}</p>
            <p>NIDN. {{$ka_prodi->dosen->nidn}}</p>
        </div>
    </div>
</div>




</body>
</html>
