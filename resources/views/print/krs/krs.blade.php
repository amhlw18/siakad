<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARTU RENCANA STUDI {{$mhs->nim}} </title>
    <link rel="icon" href="{{ asset('lte/dist/img/favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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
    <h3>KARTU RENCANA STUDI</h3>
    <h3>{{$tahun_akademik->tahun_akademik}}</h3>
</div>

<table class="info-table">
    <tr>
        <td>Nama</td>
        <td>: {{$mhs->nama_mhs}}</td>
        <td rowspan="3" style="width: 100px; text-align: center;">
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
</table>



<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Kode Matakuliah</th>
        <th>Nama Matakuliah </th>
        <th>Semester</th>
        <th>SKS </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($krs_mhs as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->matakuliah_id }}</td>
            <td>{{ $item->krs_matkul->nama_mk}}</td>
            <td>{{ $item->krs_matkul->semester}}</td>
            <td>{{ $item->total_sks}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4" class="text-end"><strong>Jumlah SKS:</strong></td>
        <td id="jumlah_sks"><strong>{{$sum_krs}}</strong></td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>Jumlah Matakuliah Diambil:</strong></td>
        <td id="jumlah_mk"><strong>{{$jumlah_mk}}</strong></td>
    </tr>
    </tfoot>
</table>

<div class="footer">
    <div class="signature" style="text-align: left; float: left; width: 60%;">
        <p>Menyetujui</p>
        <p>Penasehat Akademik</p>
        <br><br><br><br><br><br><br>
        <p>{{$pa->pa_dosen->gelar_depan ?? ''}} {{$pa->pa_dosen->nama_dosen ?? ''}}, {{$pa->pa_dosen->gelar_belakang ?? ''}}</p>
        <p>NIDN. {{$pa->nidn ?? ''}}</p>
    </div>

    <div class="signature">
        <div class="signature" style="text-align: left; float: right; width: 40%;">
            <p>Baubau, {{$tanggal}}</p>
            <p>Mengetahui</p>
            <p>Ketua Program Studi</p>
            <br><br><br><br><br>
            <p>{{$ka_prodi->dosen->gelar_depan ?? ''}} {{$ka_prodi->dosen->nama_dosen}}, {{$ka_prodi->dosen->gelar_belakang}}</p>
            <p>NIDN. {{$ka_prodi->dosen->nidn}}</p>
        </div>
    </div>

    <div class="signature">
        <div class="signature" style="text-align: left; float: right; width: 25%;">
            {{--            <p>Baubau, {{$tanggal}}</p>--}}
            <p>Mahasiswa</p>
            <br><br><br><br><br><br><br><br><br>
            <p>{{$mhs->nama_mhs ?? ''}}</p>
            <p>NIM. {{$mhs->nim}}</p>
        </div>
    </div>
</div>
</body>
</html>
