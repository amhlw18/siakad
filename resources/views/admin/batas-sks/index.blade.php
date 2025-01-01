@extends('layouts.main')

@section('title')
    Data Batas SKS
@endsection()


@section('mainmenu')
    Data Batas SKS
@endsection()

@section('menu')
    Data Batas SKS
@endsection()

@section('submenu')
    Master Data Batas SKS
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
        <a href="/dashboard/batas-sks/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Batas SKS</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Batas SKS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Prodi</th>
                        <th>IPK Minimal</th>
                        <th>IPK Maximal </th>
                        <th>Jumlah SKS</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($batass as $batas)
                        <tr>

                            <td>
                                <form action="/dashboard/batas-sks/{{ $batas->id }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/batas-sks/{{ $batas->id }}/edit"
                                       class="btn btn-warning"> <i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus batas sks ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $batas->prodi_batas_sks->nama_prodi }}</td>
                            <td>{{ $batas->ipk_min }}</td>
                            <td>{{ $batas->ipk_max}}</td>
                            <td>{{ $batas->jumlah_sks }}</td>
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
