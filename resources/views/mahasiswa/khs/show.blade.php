@extends('layouts.main')

@section('title')
    Data KHS Mahasiswa
@endsection()

@section('mainmenu')
    Data KHS Mahasiswa
@endsection()

@section('menu')
    KHS Mahasiswa
@endsection()

@section('submenu')
    Master KHS MAhasiswa
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div id="pesan" class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="fa fa-exclamation-triangle me-2"></i>
            - Untuk menampilkan KHS silahkan pilih tahun akademik terlebih dahulu !.<br>
        </div>

        <!-- Informasi mhs -->
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs?? '-' }}</p>
                <p><strong>Program Studi :</strong> {{ $mhs->prodi_mhs->nama_prodi?? '-' }}</p>
                <p><strong>Semester :</strong> {{ $mhs->semester ?? '-'}}</p>
            </div>
        </div>

        @if(auth()->user()->role== 1 || auth()->user()->role == 5 || auth()->user()->role == 6)

            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="/print/khs" target="_blank" method="post">
                        @csrf
                        <input type="hidden" name="nim" value="{{$mhs->nim}}">
                        <input type="hidden" id="tahun" name="tahun" value="">
                        <button type="submit" id="Button" rel="noopener" target="_blank" class="btn btn-primary "><i class="fas fa-print"></i> Cetak KHS</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 id="judul" class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="filterTahun">Tahun Akademik:</label>
                            <select id="filterTahun" class="form-control">
                                <option value="">-- Semua Tahun Akademik --</option>
                                @foreach($tahun_akademik as $item)
                                    <option value="{{ $item->kode }}">{{ $item->tahun_akademik }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="tabel5" class="table table-bordered table-hover">
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
                </div>
                <!-- /.card-body -->
            </div>
        @endif




        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    @if(auth()->user()->role== 1 || auth()->user()->role == 5 || auth()->user()->role == 6)
        <form id="filterForm">
            {{--        //<input type="hidden" id="prodi_id" value="{{$mhs->prodi_mhs->prodi_id?? '-'}}">--}}
            <input type="hidden" id="nim" value="{{$mhs->nim}}">
        </form>

        <script>
            $(document).ready(function () {
                $('#Button').prop('disabled', true);
                const table = $('#tabel5').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.khs') }}",
                        type: "GET",
                        data: function (d) {
                            d.tahun = $('#filterTahun').val();
                            d.nim = $('#nim').val();
                            const tahun_akademik = document.getElementById('tahun');
                            tahun_akademik.value = $('#filterTahun').val();
                        },
                        dataSrc: function (json) {
                            // Update footer values
                            $('#jumlah_sks').text(json.jumlah_sks);
                            $('#jumlah_mk').text(json.jumlah_mk);
                            $('#ips').text(json.ips);

                            if (!json.jumlah_sks){
                                $('#Button').prop('disabled', true);
                            }
                            return json.data.data; // Return the actual data for the table
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'matakuliah_id', name: 'matakuliah_id' },
                        { data: 'matakuliah', name: 'nilai_matakuliah_mhs.nama_mk' },
                        { data: 'sks', name: 'sks' },
                        { data: 'nilai_angka', name: 'nilai_angka' },
                        { data: 'nilai_huruf', name: 'nilai_huruf' },
                        { data: 'total_nilai', name: 'total_nilai' },
                    ]
                });

                // Refresh table data on filter change
                $('#filterTahun').on('change', function () {
                    table.ajax.reload();
                    $("#pesan").remove();
                    //document.getElementById('judul_tabel').innerHTML = '';
                    $('#Button').prop('disabled', false);
                });
            });
        </script>
    @endif


@endsection()
