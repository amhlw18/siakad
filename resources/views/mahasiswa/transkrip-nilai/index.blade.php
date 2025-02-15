@extends('layouts.main')

@section('title')
     Transkrip Nilai Mahasiswa
@endsection()

@section('mainmenu')
    @if(auth()->user()->role == 4)
        Transkrip Nilai
    @else
        Transkrip Nilai Mahasiswa
    @endif
@endsection()

@section('menu')
    Transkrip Nilai Mahasiswa
@endsection()

@section('submenu')
    Transkrip Nilai MAhasiswa
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('error'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->role == 4)

            <!-- Informasi mhs -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                    <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs?? '-' }}</p>
                    <p><strong>Program Studi :</strong> {{ $mhs->prodi_mhs->nama_prodi?? '-' }}</p>
                    <p><strong>IP Kumulatif :</strong> {{ $ips ?? '-'}}</p>
                    <p><strong>Total SKS dilulusi :</strong> {{ $jumlah_sks ?? '-'}}</p>
                    <p><strong>Total Mata Kuliah diambil :</strong> {{ $jumlah_mk ?? '-'}}</p>
                </div>
            </div>
        @endif

        @if(auth()->user()->role== 1 || auth()->user()->role == 6)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>
                                    <a href="/dashboard/transkrip-nilai/{{encrypt($mhs->nim)}}"
                                       class="btn btn-success"
                                       data-id="">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama_mhs}}</td>
                                <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-' }}</td>
                                <td>{{ $mhs->tahun_masuk }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        @if(auth()->user()->role== 4)
            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="/print/transkrip-nilai" target="_blank" method="post">
                        @csrf
                        <input type="hidden" name="nim" value="{{$mhs->nim}}">
                        <button type="submit" id="Button" rel="noopener" target="_blank" class="btn btn-primary "><i class="fas fa-print"></i> Cetak Transkrip Nilai</button>
                    </form>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 id="judul_tabel" class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel5" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Matakuliah</th>
                            <th>Nama Matakuliah </th>
                            <th>SKS</th>
                            <th>Nilai Angka </th>
                            <th>Nilai Huruf </th>
                            <th>Total (SKS X Nilai Angka)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($khs_mhs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->matakuliah_id }}</td>
                                <td>{{ $item->nilai_matakuliah_mhs->nama_mk}}</td>
                                <td>{{ $item->sks}}</td>
                                @if($item->nilai_huruf == 'A')
                                    <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                                    <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                                    <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                                @endif

                                @if($item->nilai_huruf == 'B')
                                    <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                                    <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                                    <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                                @endif

                                @if($item->nilai_huruf == 'C')
                                    <td><label class="badge badge-warning">{{ $item->nilai_angka }}</label></td>
                                    <td><label class="badge badge-warning">{{ $item->nilai_huruf }}</label></td>
                                    <td><label class="badge badge-warning">{{ $item->total_nilai }}</label></td>
                                @endif

                                @if($item->nilai_huruf == 'D')
                                    <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                                    <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                                    <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                                @endif

                                @if($item->nilai_huruf == 'E')
                                    <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                                    <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                                    <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        @if(auth()->user()->role== 5)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa Prodi {{$prodi->nama_prodi}} </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>
                                    <a href="/dashboard/transkrip-nilai/{{$mhs->nim}}"
                                       class="btn btn-success"
                                       data-id="">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama_mhs}}</td>
                                <td>{{ $mhs->tahun_masuk }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection()
