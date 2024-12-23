@extends('layouts.main')

@section('title')
    Data Mahasiswa
@endsection()


@section('mainmenu')
    Data Mahasiswa
@endsection()

@section('menu')
    Data Mahasiswa
@endsection()

@section('submenu')
    Master Data Mahasiswa
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
        <a href="/dashboard/data-mahasiswa/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Mahasiswa</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Mahasiswa</h3>
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
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No HP </th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <form action="/dashboard/data-mahasiswa/{{ $mhs->nim }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/data-mahasiswa/{{ $mhs->nim }}/edit"
                                       class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus mahasiswa {{ $mhs->nama_mhs }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama_mhs}}</td>
                            <td>{{ $mhs->tempat_lahir }}</td>
                            <td>{{ $mhs->tgl_lahir }}</td>
                            <td>{{ $mhs->no_hp}}</td>
                            <td>{{ $mhs->status }}</td>
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
