<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARTU HASIL STUDI</title>
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
        <img src="{{ asset('lte/dist/img/ikt.png') }}" alt="Logo Universitas">
        <h2>INSTITUT KESEHATAN DAN TEKNOLOGI BUTON RAYA</h2>
        <h3>KARTU HASIL STUDI</h3>
        <h3>{{$tahun_akademik->tahun_akademik}}</h3>
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

{{--    <div class="footer">--}}
{{--        <div class="signature">--}}
{{--            <br>--}}
{{--            <p>Wakil Dekan Bidang Akademik dan Kemahasiswaan</p>--}}
{{--            <br><br><br><br>--}}
{{--            <p>Dr. Amil Ahmad Ilham, S.T., M.IT.</p>--}}
{{--            <p>NIP. 19731010 199802 1 001</p>--}}
{{--        </div>--}}

{{--        <div class="signature">--}}
{{--            <p>Baubau,  <span id="dynamic-date"></span></p>--}}
{{--            <p>Ketua Program Studi</p>--}}
{{--            <br><br><br>--}}
{{--            <p>Dr. Ir. Zahir Zainuddin, M.Sc.</p>--}}
{{--            <p>NIP. 19640427 198910 1 002</p>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="rektor-signature">--}}
{{--        <p>Rektor</p>--}}
{{--        <br><br><br>--}}
{{--        <p>Prof. Dr. Dwia Aries Tina Pulubuhu, M.A.</p>--}}
{{--        <p>NIP. 19640814 198601 2 001</p>--}}
{{--    </div>--}}

    <script>
        window.addEventListener("load", window.print());
    </script>

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', () => {--}}
{{--            const today = new Date();--}}
{{--            const options = { year: 'numeric', month: 'long', day: 'numeric' };--}}
{{--            const formattedDate = today.toLocaleDateString('id-ID', options);--}}
{{--            document.getElementById('dynamic-date').textContent = formattedDate;--}}
{{--        });--}}
{{--    </script>--}}
</body>
</html>
