@extends('layouts.main')

@section('title')
    KHS Mahasiswa
@endsection()

@section('mainmenu')
@endsection()

@section('menu')
    Data Nilai Mahasiswa
@endsection()

@section('submenu')
    Master Nilai Mahasiswa
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

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs ?? '-' }}</p>
                <p><strong>Tahun Akademik :</strong> {{ $tahun->tahun_akademik?? '-' }}</p>
                <p><strong>Prodi :</strong> {{ $mhs->prodi_mhs->nama_prodi ?? '-'}}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">KARTU HASIL STUDI {{$mhs->nama_mhs}} {{$tahun->tahun_akademik}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah </th>
                        <th>Total SKS</th>
                        <th>Nilai Angka </th>
                        <th>Nilai Huruf </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($khs_mhs as $item)
                        <tr>
                            <td>
                                <a href="/dashboard/nilai-semester/"
                                   class="btn btn-success"
                                   data-id="">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->matakuliah_id }}</td>
                            <td>{{ $item->nilai_matakuliah_mhs->nama_mk}}</td>
                            <td>{{ $item->total_sks}}</td>
                            <td>{{ $item->nilai_angka }}</td>
                            @if($item->nilai_huruf == 'A')
                                <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'B')
                                <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'C')
                                <td><label class="badge badge-warning">{{ $item->nilai_huruf }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'D')
                                <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'A')
                                <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                            @endif
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
