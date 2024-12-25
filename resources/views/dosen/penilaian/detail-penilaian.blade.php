@extends('layouts.main')

@section('title')

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
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Nilai Angka </th>
                        <th>Nilai Huruf </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matakuliah as $matkul)
                        <tr>
                            <td>
                                <a href="/dashboard/nilai-semester/{{$matkul->matakuliah_id}}"
                                   class="btn btn-success"
                                   data-id="">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matkul->matakuliah_id }}</td>
                            <td>{{ $matkul->jadwal_matakuliah->nama_mk}}</td>
                            <td>{{ $jumlah_mahasiswa[$matkul->matakuliah_id] ?? 0 }}
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
