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

          <p></p>
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
          <h3><sup style="font-size: 20px"></sup></h3>

          <p></p>
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
          <h3></h3>

          <p></p>
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
      <h3 class="card-title"></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
{{--      <table id="example1" class="table table-bordered table-striped">--}}
{{--        <thead>--}}
{{--          <tr>--}}
{{--            <th>#</th>--}}
{{--            <th>Nama Peminjam</th>--}}
{{--            <th>Prodi</th>--}}
{{--            <th>Status</th>--}}
{{--            <th>Aksi</th>--}}
{{--          </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}

{{--        </tbody>--}}
{{--      </table>--}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection()
