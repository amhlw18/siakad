@extends('layouts.main')

@section('title')
    Data Program Studi
@endsection()


@section('mainmenu')
    Data Program Studi
@endsection()

@section('menu')
    Program Studi
@endsection()

@section('submenu')
    Master Data Program Studi
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
        <a href="/dashboard/prodi/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Program Studi</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Program Studi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Program Studi </th>
                            <th>Jenjang</th>
                            <th>Ka Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prodis as $prodi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prodi->kode_prodi }}</td>
                                <td>{{ $prodi->nama_prodi }}</td>
                                <td>{{ $prodi->jenjang }} </td>
                                <td>{{ $prodi->ka_prodi }}</td>
                                <td>

                                    <form action="/dashboard/prodi/{{ $prodi->kode_prodi }}" class="inline-block"
                                        method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a href="/dashboard/prodi/{{ $prodi->kode_prodi }}/edit"
                                            class="btn btn-warning"><span data-feather="plus"></span>Edit</a>

                                        <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus tahun akademik {{ $prodi->kode_prodi }} ?')">Hapus</button>
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
