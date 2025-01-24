@extends('layouts.main')

@section('title')
    Data KRS Mahasiswa
@endsection()

@section('mainmenu')
     Ambil KRS
@endsection()

@section('menu')
    KRS Mahasiswa
@endsection()

@section('submenu')
    Ambil KRS
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

{{--        <div id="pesan" class="alert alert-warning d-flex align-items-center" role="alert">--}}
{{--            <i class="fa fa-exclamation-triangle me-2"></i>--}}
{{--            - .<br>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-header">
                <h3 id="judul" class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Mata Kuliah </th>
                        <th>Semester</th>
                        <th>SKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matakuliah as $item)
                        <tr>
                            <td>
                                <a href=""
                                   class="btn btn-outline-primary"
                                   data-id="">
                                    <i class="bi bi-plus"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_mk }}</td>
                            <td>{{ $item->nama_mk}}</td>
                            <td>{{ $item->semester}}</td>
                            <td>{{ $item->total_sks}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>


@endsection()
