@extends('layouts.main')

@section('title')
    Data Pokok Akademik
@endsection()


@section('mainmenu')
    Data Pokok Akademik
@endsection()

@section('menu')
    Kurikulum
@endsection()

@section('submenu')
    Master Data Kurikulum
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
        <a href="/dashboard/kurikulum/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kurikulum</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Kurikulum</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Nama Kurikulum</th>
                            <th>SKS Wajib</th>
                            <th>SKS Pilihan</th>
                            <th>Jumlah SKS</th>
                            <th>Berlaku</th>
                            <th>Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kurikulums as $kurikulum)
                            <tr>
                                <td>

                                    <form action="/dashboard/kurikulum/{{$kurikulum->kode_kurikulum}}" class="inline-block"
                                          method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a href="/dashboard/kurikulum/{{ $kurikulum->kode_kurikulum }}/edit"
                                           class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                        <button class="btn btn-danger"
                                                onclick="return confirm('Yakin akan menghapus kurikulum {{ $kurikulum->kode_kurikulum }} ?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kurikulum->nama_kurikulum }}</td>
                                <td>{{ $kurikulum->sks_wajib }}</td>
                                <td>{{ $kurikulum->sks_pilihan }}</td>
                                <td>{{ $kurikulum->jumlah_sks }}</td>
                                <td>{{ $kurikulum->tahun_akademik->tahun_akademik }} </td>
                                <td>{{ $kurikulum->status == 1 ? 'Ya' : 'Tidak Aktif' }}</td>

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
