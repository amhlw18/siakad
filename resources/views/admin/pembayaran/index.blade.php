@extends('layouts.main')

@section('title')
    Data Pembayaran SPP
@endsection()


@section('mainmenu')
    Data Pembayaran SPP
@endsection()

@section('menu')
    Data Pembayaran SPP
@endsection()

@section('submenu')
    Master Data Pembayaran SPP
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
                <h3 class="card-title">Master Data Pembayaran SPP</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
{{--                        <th>Tanggal Pembayaran</th>--}}
                        <th>Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <td>
                                <form action="/dashboard/data-mahasiswa/{{ $pembayaran->nim }}" class="inline-block" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/data-mahasiswa/{{ $pembayaran->nim }}/edit" class="btn btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger" onclick="return confirm('Yakin akan menghapus mahasiswa?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembayaran->nim }}</td>
                            <td>{{ $pembayaran->pembayaran_mhs->nama_mhs ?? '-' }}</td>
                            <td>{{ $pembayaran->is_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
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
