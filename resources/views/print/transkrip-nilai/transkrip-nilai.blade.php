<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSKRIP NILAI {{$mhs->nim}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .info-table {
            margin-bottom: 20px;
        }
        .info-table td {
            border: none;
            padding: 5px;
        }
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .footer .signature {
            text-align: center;
        }
        .rektor-signature {
            margin-top: 50px;
            text-align: center;
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
        <td colspan="6" class="text-end"><strong>Jumlah SKS:</strong></td>
        <td id="jumlah_sks"><strong>{{$jumlah_sks}}</strong></td>
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

<script>
    window.addEventListener("load", function () {
        window.print();
    });
</script>
</body>
</html>
