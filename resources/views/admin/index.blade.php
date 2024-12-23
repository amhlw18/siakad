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

@endsection()

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3></h3>
            @if(Auth::user()->role == 3)
                {{$matkul_dosen}}
                <p>Jumlah Mata Kuliah</p>
            @endif


          <p></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>
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
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/dashboard/riwayatpeminjaman" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
{{--    <div class="col-lg-3 col-6">--}}
{{--      <!-- small box -->--}}
{{--      <div class="small-box bg-danger">--}}
{{--        <div class="inner">--}}
{{--            @if(Auth::user()->role == 3)--}}
{{--                <p>Jumlah Mata Kuliah</p>--}}
{{--            @endif--}}

{{--          <p></p>--}}
{{--        </div>--}}
{{--        <div class="icon">--}}
{{--          <i class="ion ion-pie-graph"></i>--}}
{{--        </div>--}}
{{--        <a href="/dashboard/datapeminjaman" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--      </div>--}}
{{--    </div>--}}
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
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

                    KRS Mahasiswa {{$tahun->tahun_akademik}}

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
    @endif
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection()
