@extends('layouts.main')

@section('title')
    Data Ruangan
@endsection()


@section('mainmenu')
    Data Ruangan
@endsection()

@section('menu')
    Data Ruangan
@endsection()

@section('submenu')
    Master Data Ruangan
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
        <a href="/dashboard/ruangan/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Ruangan</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Ruangan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Nama Ruangan</th>
                        <th>Program Studi </th>
                        <th>Gedung</th>
                        <th>Lantai</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ruangans as $ruangan)
                        <tr>
                            <td>

                                <form action="/dashboard/ruangan/{{ $ruangan->id }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/ruangan/{{ $ruangan->id }}/edit"
                                       class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus ruangan {{ $ruangan->nama_ruangan }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ruangan->nama_ruangan }}</td>
                            <td>{{ $ruangan->prodi_ruangan->nama_prodi}}</td>
                            <td>{{ $ruangan->gedung }}</td>
                            <td>{{ $ruangan->lantai }} </td>
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
