@extends('layouts.main')

@section('title')
    Data KRS Mahasiswa
@endsection()

@section('mainmenu')
    @if(auth()->user()->role == 4)
        Ambil KRS
    @else
        Data KRS Mahasiswa
    @endif
@endsection()

@section('menu')
    KRS Mahasiswa
@endsection()

@section('submenu')
    Master KRS MAhasiswa
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

            @if(!$pembayaran->is_bayar)

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - Pembayaran anda pada TA {{$tahun_aktif->tahun_akademik}} belum masuk, jika anda sudah melakukan pembayaran namum masih mendaptkan pesan ini silahkan laporkan kebagian keuangan ! .<br>
                </div>

            @endif

            @if ($periode)
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - {{ $pesan }}
                </div>

                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - Jika KRS Mahasiswa belum tampil ketika sudah mengisi KRS silahkan reload kembali halaman ini .<br>
                    - Setelah melakukan pengisian KRS silahkan mengunci KRS anda.<br>
                    - Jika KRS telah disetujui maka anda tidak bisa melakukan perubahan pada KRS.
                </div>

            @else
{{--                    <div class="callout callout-warning">--}}
{{--                        <h5><i class="fas fa-info"></i> Note:</h5>--}}
{{--                    </div>--}}

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - {{ $pesan }}
                </div>
            @endif

            <!-- Informasi mhs -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                    <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs?? '-' }}</p>
                    <p><strong>Program Studi :</strong> {{ $mhs->prodi_mhs->nama_prodi?? '-' }}</p>
                    <p><strong>Semester :</strong> {{ $mhs->semester ?? '-'}}</p>
                    @if($status_krs)
                        <p><strong>Status KRS :</strong>  <label class="{{ $status_krs->disetujui==1 ? 'badge badge-success' : 'badge badge-danger' }} ">{{ $status_krs->disetujui==1 ? 'Disetujui' : 'Belum disetujui'}}</label></p>

                    @endif
                </div>
            </div>
                @if ($periode && $pembayaran->is_bayar)
                    <a href="#" class="btn btn-primary mb-2 btn-setujui-krs" ><span data-feather="plus"></span>Ambil KRS</a>
{{--                @else--}}
{{--                    <a href="#" class="btn btn-primary mb-2 btn-setujui-krs" ><span data-feather="plus"></span>Ambil KRS</a>--}}
                @endif
        @endif

        @if(auth()->user()->role== 1)

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
                                                        <a href="/dashboard/krs-mhs/{{$mhs->nim}}"
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">KARTU RENCANA STUDI TA {{$tahun_aktif->tahun_akademik}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Matakuliah</th>
                            <th>Nama Matakuliah </th>
                            <th>Semester</th>
                            <th>SKS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($krs_mhs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->matakuliah_id }}</td>
                                <td>{{ $item->krs_matkul->nama_mk}}</td>
                                <td>{{ $item->krs_matkul->semester}}</td>
                                <td>{{ $item->total_sks}}</td>
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
                                    <a href="/dashboard/krs-mhs/{{$mhs->nim}}"
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
