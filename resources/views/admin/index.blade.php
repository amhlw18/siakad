@extends('layouts.main')

@section('title')
Dashboard
@endsection()

@section('mainmenu')
Selamat Datang, {{ auth()->user()->name }}
@endsection()

@section('menu')
Dashboard
@endsection()

@section('submenu')

    @if(Auth::user()->role == 1)
        Dashboard Administrator
    @endif

    @if(Auth::user()->role == 2)
        Dashboard Bendahara
    @endif

    @if(Auth::user()->role == 3)
        Dashboard Dosen
    @endif

    @if(Auth::user()->role == 4)
    Dashboard Mahasiswa
    @endif

    @if(Auth::user()->role == 5)
        Dashboard Program Studi
    @endif

@endsection()

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .header img {
        width: 80px;
        height: auto;
        margin-bottom: 10px;
    }
    table {
        width: 40%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    table, th, td {
        border: 0px solid black;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
    .info-table {
        margin-bottom: 20px;
    }
    .info-table td {
        border: none;
        padding: 8px;
    }
</style>

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">

      @if(auth()->user()->role==2 || auth()->user()->role==3 || auth()->user()->role==5)
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3></h3>

                      @if(Auth::user()->role == 3)
                          {{$matkul_dosen}}
                          <p>Jumlah Mata Kuliah</p>
                      @endif

                      @if(Auth::user()->role == 5)
                          {{$jumlah_mhs}}
                          <p>Jumlah Mahasiswa Aktif</p>
                      @endif

                      <p></p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3><sup style="font-size: 20px"></sup></h3>
                      @if(Auth::user()->role == 3)
                          {{$jumlah_pa}}
                          <p>Jumlah Bimbingan Akademik</p>
                      @endif

                      @if(Auth::user()->role == 5)
                          {{$jumlah_dosen}}
                          <p>Jumlah Dosen Homebase</p>
                      @endif
                  </div>
                  <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
      @endif


      @if(auth()->user()->role==5)
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3><sup style="font-size: 20px"></sup></h3>

                      @if(Auth::user()->role == 5)
                          {{$jumlah_alumni}}
                          <p>Jumlah Alumni</p>
                      @endif
                  </div>
                  <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
      @endif

  </div>
  <!-- /.row -->
  <!-- Main row -->

    <div class="callout callout-info">
        <h5><i class="fas fa-info"></i> Informasi: </h5>
        <strong> Kalender Akademik </strong>
        <table class="info-table">
            <tr>
                <td>Tahun Akademik</td>
                <td>: </td>
                <td>{{$tahun->tahun_akademik}}</td>
            </tr>
            <tr>
                <td>Periode Pembayaran SPP</td>
                <td>: </td>
                <td>{{$tahun->periode_pembayaran}}</td>
            </tr>
            <tr>
                <td>Periode KRS Online</td>
                <td>: </td>
                <td>{{$tahun->periode_krs}}</td>
            </tr>

            <tr>
                <td>Periode Kuliah</td>
                <td>: </td>
                <td> {{$tahun->periode_perkuliahan}}</td>
            </tr>
            <tr>
                <td>Periode UTS</td>
                <td>: </td>
                <td>{{$tahun->periode_uts}}</td>
            </tr>
            <tr>
                <td>Periode UAS</td>
                <td>: </td>
                <td>{{$tahun->periode_uas}}</td>
            </tr>
            <tr>
                <td>Periode Penilaian</td>
                <td>: </td>
                <td>{{$tahun->periode_penilaian}}</td>
            </tr>
        </table>
    </div>

    @if(Auth::user()->role == 5)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Mahasiswa belum mengisi KRS {{$tahun->tahun_akademik}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($belum_krs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim ?? '-' }}</td>
                            <td>{{ $item->status_krs_mhs->nama_mhs ?? '-' }}</td>
                            <td>{{ $item->status_krs_mhs->tahun_masuk ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Mahasiswa belum Melakukan Pembayaran SPP {{$tahun->tahun_akademik}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($belum_bayar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim ?? '-' }}</td>
                            <td>{{ $item->pembayaran_mhs->nama_mhs ?? '-' }}</td>
                            <td>{{ $item->pembayaran_mhs->tahun_masuk ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
    @endif

    @if(Auth::user()->role == 3)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">

                    Jadwal Matakuliah Semester {{$tahun->tahun_akademik}}

                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Matakuliah</th>
                        <th>Prodi</th>
                        <th>Kelas</th>
                        <th>Ruangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jadwal_dosen as $jadwal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->hari ?? '-' }}</td>
                            <td>{{ $jadwal->jam ?? '-' }}</td>
                            <td>{{ $jadwal->jadwal_matakuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $jadwal->prodi_jadwal->nama_prodi }}</td>
                            <td>{{ $jadwal->jadwal_kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $jadwal->jadwal_ruangan->nama_ruangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Bimbingan Akademik
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="tabel2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pa as $item)
                        <tr>
                            <td>
                                <a href="/dashboard/dosen/detail-pa/{{$item->nim}}"
                                   class="btn btn-success"
                                   data-id="{{ $item->nim }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim ?? '-' }}</td>
                            <td>{{ $item->pa_mhs->nama_mhs ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
    @endif


    @if(auth()->user()->role == 4)
        @if($kelas_id)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        Jadwal Matakuliah {{$tahun->tahun_akademik}}

                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="tabel" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Matakuliah</th>
                            <th>Dosen</th>
                            <th>Ruangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jadwal_mhs as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->hari ?? '-' }}</td>
                                <td>{{ $jadwal->jam ?? '-' }}</td>
                                <td>{{ $jadwal->jadwal_matakuliah->nama_mk ?? '-' }}</td>
                                <td>{{ $jadwal->dosen->nama_dosen }}</td>
                                <td>{{ $jadwal->jadwal_ruangan->nama_ruangan ?? '-' }} | Lantai {{ $jadwal->jadwal_ruangan->lantai ?? '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
        @endif

    @endif
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection()
