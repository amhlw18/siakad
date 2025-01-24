<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARTU HASIL STUDI {{$mhs->nim}} </title>
    <link rel="icon" href="{{ asset('lte/dist/img/favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 8px;
            font-size: 10px;
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
        <h3>KARTU HASIL STUDI</h3>
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
            <th>SKS</th>
            <th>Nilai Angka </th>
            <th>Nilai Huruf </th>
            <th>Total (SKS X Nilai Angka)</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($khs_mhs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->matakuliah_id }}</td>
                <td>{{ $item->nilai_matakuliah_mhs->nama_mk}}</td>
                <td>{{ $item->sks}}</td>
                @if($item->nilai_huruf == 'A')
                    <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                    <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                    <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                @endif

                @if($item->nilai_huruf == 'B')
                    <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                    <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                    <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                @endif

                @if($item->nilai_huruf == 'C')
                    <td><label class="badge badge-warning">{{ $item->nilai_angka }}</label></td>
                    <td><label class="badge badge-warning">{{ $item->nilai_huruf }}</label></td>
                    <td><label class="badge badge-warning">{{ $item->total_nilai }}</label></td>
                @endif

                @if($item->nilai_huruf == 'D')
                    <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                    <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                    <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                @endif

                @if($item->nilai_huruf == 'E')
                    <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                    <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                    <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                @endif
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
            <td colspan="6" class="text-end"><strong>IP Semester:</strong></td>
            @if($ips >= 0 &&  $ips <= 2.50  )
                <td id="ips"> <label class="badge badge-danger"><strong>{{$ips}}</strong></label> </td>
            @endif

            @if($ips >= 2.51 &&  $ips <= 3.10  )
                <td id="ips"> <label class="badge badge-warning"><strong>{{$ips}}</strong></label> </td>
            @endif

            @if($ips >= 3.11 &&  $ips <= 4.00  )
                <td id="ips"> <label class="badge badge-success"><strong>{{$ips}}</strong></label> </td>
            @endif
        </tr>
        </tfoot>
    </table>

    <div class="footer">
{{--        <div class="signature" style="text-align: left; float: left; width: 40%;">--}}
{{--            <br><br>--}}
{{--            <p>Wakil Dekan Bidang Akademik dan Kemahasiswaan</p>--}}
{{--            <br><br><br><br>--}}
{{--            <p>Dr. Amil Ahmad Ilham, S.T., M.IT.</p>--}}
{{--            <p>NIP. 19731010 199802 1 001</p>--}}
{{--        </div>--}}

        <div class="signature">
            <div class="signature" style="text-align: left; float: right; width: 40%;">
                <p>Baubau, {{$tanggal}}</p>
                <p>Ketua Program Studi</p>
                <br><br><br><br><br>
                <p>{{$ka_prodi->dosen->gelar_depan ?? ''}} {{$ka_prodi->dosen->nama_dosen}}, {{$ka_prodi->dosen->gelar_belakang}}</p>
                <p>NIDN. {{$ka_prodi->dosen->nidn}}</p>
            </div>
        </div>
    </div>




</body>
</html>
