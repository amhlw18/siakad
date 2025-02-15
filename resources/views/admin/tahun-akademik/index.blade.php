@extends('layouts.main')

@section('title')
    Data Tahun Akademik
@endsection()


@section('mainmenu')
    Data Tahun Akademik
@endsection()

@section('menu')
    Tahun Akademik
@endsection()

@section('submenu')
    Master Data Tahun Akademik
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

        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <a href="/dashboard/tahun-akademik/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Tahun Akademik</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Tahun Akademik</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Tahun Akdemik</th>
                            <th>Semester</th>
                            <th>Periode Perkuliahan</th>
                            <th>Periode Pembayaran</th>
                            <th>Periode KRS</th>
                            <th>Periode Penilaian</th>
                            <th>Aktif</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akademis as $akademik)
                            <tr>
                                <td>

                                    <form action="/dashboard/tahun-akademik/{{encrypt($akademik->id) }}" class="inline-block"
                                          method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a href="/dashboard/tahun-akademik/{{ encrypt($akademik->id)  }}/edit"
                                           class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                        <button class="btn btn-danger"
                                                onclick="return confirm('Yakin akan menghapus tahun akademik {{ $akademik->tahun_akademik }} {{ $akademik->semester }} ?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $akademik->kode}}</td>
                                <td>{{ $akademik->tahun_akademik}}</td>
                                <td>{{ $akademik->semester }}  </td>
                                <td>{{ $akademik->periode_perkuliahan}}</td>
                                <td>{{ $akademik->periode_pembayaran}}</td>
                                <td>{{ $akademik->periode_krs }}  </td>
                                <td>{{ $akademik->periode_penilaian }}  </td>
                                <td>{{ $akademik->status == 1 ? 'Ya' : 'Tidak Aktif' }}</td>

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
