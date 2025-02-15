@extends('layouts.main')

@section('title')
    Data Dosen
@endsection()


@section('mainmenu')
    Data Dosen
@endsection()

@section('menu')
    Data Dosen
@endsection()

@section('submenu')
    Master Data Dosen
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
        <a href="/dashboard/data-dosen/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Dosen</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Dosen</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIDN</th>
                        <th>Nama </th>
                        <th>Kontak</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dosens as $dosen)
                        <tr>
                            <td>

                                <form action="/dashboard/data-dosen/{{ encrypt($dosen->nidn)  }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/data-dosen/{{ encrypt($dosen->nidn) }}/edit"
                                       class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus dosen {{ $dosen->nama_dosen }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama_dosen}}</td>
                            <td>{{ $dosen->no_hp }}</td>

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
