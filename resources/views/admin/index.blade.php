@extends('layouts.main')

@section('title')
Dashboard
@endsection()

@section('mainmenu')
Dashboard
@endsection()

@section('menu')
Dashboard
@endsection()

@section('submenu')
Dashboard Admin
@endsection()

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $jumlahBuku }}</h3>

          <p>Jumlah Buku</p>
        </div>
        <div class="icon">
          <i class="nav-icon fas fa-solid fa-book"></i>
        </div>
        <a href="/dashboard/databuku" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $jumlahBukuKembali }}<sup style="font-size: 20px"></sup></h3>

          <p>Riwayat Peminjaman Buku</p>
        </div>
        <div class="icon">
          <i class="nav-icon fas fa-clock rotate-left"></i>
        </div>
        <a href="/dashboard/riwayatpeminjaman" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $jumlahBukuBelumKembali }}</h3>

          <p>Buku Belum Kembali</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/dashboard/datapeminjaman" class="small-box-footer">Kunjungi <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Peminjaman Buku</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Peminjam</th>
            <th>Prodi</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pinjams as $pinjam)
          <tr>
            <td>{{$loop->iteration}}</td>
            @if($pinjam->data_mhs)
            <td>{{ $pinjam->data_mhs->nama }}</td>
            <td>{{ $pinjam->data_mhs->jurusan }}</td>
            @elseif($pinjam->data_dosen)
            <td>{{ $pinjam->data_dosen->nama }}</td>
            <td>{{ $pinjam->data_dosen->jurusan }}</td>
            @endif
            <td> <label class="badge badge-warning">{{ $pinjam->jumlah_buku }} buku belum kembali !</label></td>
            <td>
              <a href="/dashboard/datapeminjaman/@if($pinjam->data_mhs){{$pinjam->data_mhs->nim}}@elseif($pinjam->data_dosen){{$pinjam->data_dosen->nidn}}@endif" class="btn btn-success"><span data-feather="plus" target="_blank"></span>Detail</a>
            </td>

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