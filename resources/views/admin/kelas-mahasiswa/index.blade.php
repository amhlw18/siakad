@extends('layouts.main')

@section('title')
    Data Kelas Mahasiswa
@endsection()


@section('mainmenu')
    Data Kelas Mahasiswa
@endsection()

@section('menu')
    Data Kelas Mahasiswa
@endsection()

@section('submenu')
    Master Data Kelas Mahasiswa
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
        <a href="/dashboard/kelas-mhs/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kelas
            Mahasiswa</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Kelas Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
                        <th>Program</th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <form action="/dashboard/kelas-mhs/{{ $mhs->nim }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus mahasiswa {{ $mhs->nama_mhs }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->nama_mhs}}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->tahun_masuk }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->program }}</td>
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
