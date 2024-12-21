@extends('layouts.main')

@section('title')
    Data Nilai Mahasiswa
@endsection()

@section('mainmenu')
    Data Nilai Mahasiswa
@endsection()

@section('menu')
    Data Nilai Mahasiswa
@endsection()

@section('submenu')
    Master Nilai Mahasiswa
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

        {{--        <!-- Informasi Matakulaih -->--}}
        {{--        <div class="card mb-3">--}}
        {{--            <div class="card-body">--}}
        {{--                <p><strong>NIDN  :</strong> {{ $dosen->nidn ?? '-' }}</p>--}}
        {{--                <p><strong>Nama Dosen :</strong> {{ $dosen->nama_dosen?? '-' }}</p>--}}
        {{--                <p><strong>Tahun Akademik :</strong> {{ $tahun_aktif->tahun_akademik?? '-' }}</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Penilaian Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah </th>
                        <th>Jumlah Mahasiswa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dosens as $dosen)
                        <tr>
                            <td>
                                <a href="/dashboard/pa-mhs/{{$dosen->nidn}}"
                                   class="btn btn-success"
                                   data-id="">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama_dosen}}</td>
                            <td>{{ $jumlah_pa[$dosen->nidn]->jumlah_mahasiswa ?? 0 }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

@endsection()
