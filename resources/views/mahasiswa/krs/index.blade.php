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

        @if(auth()->user()->role== 1)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                                            @foreach ($mahasiswa as $mhs)
                                                <tr>
                                                    <td>
                                                        <a href="/dashboard/krs-mhs/{{$mhs->nim}}"
                                                           class="btn btn-success"
                                                           data-id="">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mhs->nim }}</td>
                                                    <td>{{ $mhs->nama_mhs}}</td>
                                                    <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-' }}</td>
                                                    <td>{{ $mhs->tahun_masuk }}</td>
                                                </tr>
                                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        @if(auth()->user()->role== 5)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa Prodi {{$prodi->nama_prodi}} </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>
                                    <a href="/dashboard/krs-mhs/{{$mhs->nim}}"
                                       class="btn btn-success"
                                       data-id="">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama_mhs}}</td>
                                <td>{{ $mhs->tahun_masuk }}</td>
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

@endsection()
