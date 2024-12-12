@extends('layouts.main')

@section('title')
    Data Jadwal kuliah
@endsection()

@section('mainmenu')
    Data Jadwal Kuliah
@endsection()

@section('menu')
    Data Jadwal Kuliah
@endsection()

@section('submenu')
    Master Data Jadwal Kuliah
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
{{--        <a href="/dashboard/kls-mhs/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kelas--}}
{{--            Mahasiswa</a>--}}

{{--        @if($nim)--}}
{{--            <button id="btnReset" class="btn btn-danger mb-2" ><span data-feather="plus"></span>Reset Kelas</button>--}}
{{--        @else--}}
{{--            <button id="btnReset" class="btn btn-danger mb-2"  disabled><span data-feather="plus"></span>Reset Kelas</button>--}}
{{--        @endif--}}


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Jadwal Kuliah</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Prodi</th>
                        <th>Program Studi </th>
                        <th>Jenjang</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prodis as $prodi)
                        <tr>
                            <td>
                                <a href="/dashboard/data-jadwal/{{$prodi->kode_prodi}}"
                                   class="btn btn-success"
                                   data-id="{{ $prodi->kode_prodi }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prodi->kode_prodi }}</td>
                            <td>{{ $prodi->nama_prodi}}</td>
                            <td>{{ $prodi->jenjang }}</td>
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
