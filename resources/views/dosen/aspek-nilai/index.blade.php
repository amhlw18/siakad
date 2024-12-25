@extends('layouts.main')

@section('title')
    Data Aspek Nilai Matakuliah
@endsection()

@section('mainmenu')
    Data Aspek Nilai Matakuliah
@endsection()

@section('menu')
    Data Aspek Nilai Matakuliah
@endsection()

@section('submenu')
    Master Aspek Nilai Matakuliahh
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

        <!-- Informasi Matakulaih -->
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>NIDN  :</strong> {{ $dosen->nidn ?? '-' }}</p>
                <p><strong>Nama Dosen :</strong> {{ $dosen->nama_dosen?? '-' }}</p>
                <p><strong>Tahun Akademik :</strong> {{ $tahun_aktif->tahun_akademik?? '-' }}</p>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Mata Kuliah {{$tahun_aktif->tahun_akademik?? '-'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah </th>
                        <th>Prodi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matakuliah as $matkul)
                        <tr>
                            <td>
                                <a href="/dashboard/aspek-nilai/{{$matkul->jadwal_matakuliah->kode_mk}}"
                                   class="btn btn-success"
                                   data-id="{{ $matkul->kode_mk }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matkul->jadwal_matakuliah->kode_mk }}</td>
                            <td>{{ $matkul->jadwal_matakuliah->nama_mk}}</td>
                            <td>{{ $matkul->prodi_jadwal->nama_prodi }}</td>
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
