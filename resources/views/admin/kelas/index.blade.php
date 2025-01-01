@extends('layouts.main')

@section('title')
    Data Kelas
@endsection()

@section('mainmenu')
    Data Kelas
@endsection()

@section('menu')
    Data Kelas
@endsection()

@section('submenu')
    Master Data Kelas
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
        <a href="/dashboard/kelas/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Kelas</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Kelas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Prodi</th>
                        <th>Program </th>
                        <th>Kapasitas</th>
                        <th>Aktif</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kelass as $kelas)
                        <tr>
                            <td>

                                <form action="/dashboard/kelas/{{ $kelas->id }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/kelas/{{ $kelas->id }}/edit"
                                       class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus kelas {{ $kelas->nama_kelas }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelas->nama_kelas }}</td>
                            <td>{{ $kelas->prodi_kelas->nama_prodi }}</td>
                            <td>{{ $kelas->program}}</td>
                            <td>{{ $kelas->kapasitas }}</td>
                            <td>{{ $kelas->aktif == 1 ? 'Ya' : 'Tidak' }} </td>


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
