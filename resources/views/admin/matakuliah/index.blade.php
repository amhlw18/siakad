@extends('layouts.main')

@section('title')
    Data Matakuliah
@endsection()


@section('mainmenu')
    Data Matakuliah
@endsection()

@section('menu')
    Matakuliah
@endsection()

@section('submenu')
    Master Data Matakuliah
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
        <a href="/dashboard/matakuliah/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Matakuliah</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Matakuliah</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Matakuliah </th>
                            <th>Jenis</th>
                            <th>SKS T</th>
                            <th>SKS P</th>
                            <th>SKS L</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matkuls as $matkul)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $matkul->kode_mk }}</td>
                                <td>{{ $matkul->nama_mk }}</td>
                                <td>{{ $matkul->jenis_mk }} </td>
                                <td>{{ $matkul->sks_teori }}</td>
                                <td>{{ $matkul->sks_praktek }}</td>
                                <td>{{ $matkul->sks_lapangan }} </td>
                                <td>

                                    <form action="/dashboard/matakuliah/{{ $matkul->kode_mk }}" class="inline-block"
                                        method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a href="/dashboard/matakuliah/{{ $matkul->kode_mk }}/edit"
                                            class="btn btn-warning"><span data-feather="plus"></span>Edit</a>

                                        <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus tahun akademik {{ $matkul->kode_mk }} ?')">Hapus</button>
                                    </form>
                                </td>

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
