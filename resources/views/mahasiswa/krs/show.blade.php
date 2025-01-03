@extends('layouts.main')

@section('title')
    Data KRS Mahasiswa
@endsection()

@section('mainmenu')
    Data KRS Mahasiswa
@endsection()

@section('menu')
    KRS Mahasiswa
@endsection()

@section('submenu')
    Master KRS MAhasiswa
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
            - Untuk menampilkan KRS silahkan pilih tahun akademik terlebih dahulu !.<br>
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

        @if(auth()->user()->role== 1 || auth()->user()->role == 5)

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
                            <th></th>
                            <th>#</th>
                            <th>Kode Matakuliah</th>
                            <th>Nama Mata Kuliah </th>
                            <th>Semester</th>
                            <th>SKS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($krs as $item)
                            <tr>
                                <td>
{{--                                    <a href="/dashboard/krs-mhs/{{$mhs->nim}}"--}}
{{--                                       class="btn btn-success"--}}
{{--                                       data-id="">--}}
{{--                                        <i class="bi bi-eye"></i>--}}
{{--                                    </a>--}}
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->matakuliah_id }}</td>
                                <td>{{ $item->krs_matkul->nama_mk}}</td>
                                <td>{{ $item->krs_matkul->semester}}</td>
                                <td>{{ $item->total_sks}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif




        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    @if(auth()->user()->role== 1 || auth()->user()->role == 5)
        <form id="filterForm">
            {{--        //<input type="hidden" id="prodi_id" value="{{$mhs->prodi_mhs->prodi_id?? '-'}}">--}}
            <input type="hidden" id="nim" value="{{$mhs->nim}}">
        </form>

        <script>
            $(document).ready(function () {
                $('#tabel5').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.krs') }}",
                        type: "GET",
                        data: function (d) {
                            d.tahun = $('#filterTahun').val();
                            d.nim = $('#nim').val();
                        }
                    },
                    columns: [
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'matakuliah_id', name: 'matakuliah_id' },
                        { data: 'matakuliah', name: 'krs_matkul.nama_mk' },
                        { data: 'semester', name: 'krs_matkul.semester' },
                        { data: 'total_sks', name: 'total_sks' },
                    ]
                });

                // Refresh DataTables on filter change
                $('#filterTahun').on('change', function () {
                    $('#tabel5').DataTable().ajax.reload();
                    $("#pesan").remove();


                });
            });

        </script>
    @endif


@endsection()
