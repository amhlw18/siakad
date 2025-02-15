@extends('layouts.main')

@section('title')
    Data Nilai Mahasiswa
@endsection()

@section('mainmenu')
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


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Matakuliah {{$tahun->tahun_akademik}} </h3>
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
                        <th>Prodi</th>
                        <th>Kelas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matakuliah as $matkul)
                        <tr>
                            <td>
                                <a href="/dashboard/nilai-semester/{{encrypt($matkul->matakuliah_id)}}/{{encrypt($matkul->prodi_jadwal->kode_prodi) ?? '-'}}"
                                   class="btn btn-success"
                                   data-id="">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matkul->matakuliah_id }}</td>
                            <td>{{ $matkul->jadwal_matakuliah->nama_mk }} | Semester {{$matkul->jadwal_matakuliah->semester}}  </td>
                            <td>{{ $matkul->prodi_jadwal->nama_prodi}}</td>
                            <td>{{ $matkul->jadwal_kelas->nama_kelas ?? '-' }}
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
