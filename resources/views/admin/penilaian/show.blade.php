@extends('layouts.main')

@section('title')
    Data Nilai Mahasiswa
@endsection()

@section('mainmenu')
    Nilai Mahasiswa
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
                <h3 class="card-title">Daftar Mahasiswa Matakuliah </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <a href="/dashboard/nilai-semester/{{$mhs->krs_mhs->nim}}"
                                   class="btn btn-primary"
                                   data-id="">
                                    Isi Nilai
                                </a>

                                <a href="/dashboard/nilai-semester/{{$mhs->krs_mhs->nim}}"
                                   class="btn btn-success"
                                   data-id="">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->krs_mhs->nim }}</td>
                            <td>{{ $mhs->krs_mhs->nama_mhs}}</td>
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
