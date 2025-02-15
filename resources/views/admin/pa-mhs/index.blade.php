@extends('layouts.main')

@section('title')
    Data Penasehat Akademik
@endsection()

@section('mainmenu')
    Data Penasehat Akademik
@endsection()

@section('menu')
    Data Penasehat Akademik
@endsection()

@section('submenu')
    Master Penasehat Akademik
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
                <h3 class="card-title">Master Data Penasehat Akademik</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIDN</th>
                        <th>Nama Dosen </th>
                        <th>Jumlah Mahasiswa Bimbingan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dosens as $dosen)
                        <tr>
                            <td>
                                <a href="/dashboard/pa-mhs/{{ encrypt($dosen->nidn) }}"
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
