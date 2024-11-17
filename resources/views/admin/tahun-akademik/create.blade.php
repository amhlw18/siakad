@extends('layouts.main')

@section('title')
    Tambah Data Tahun Akademik
@endsection()


@section('mainmenu')
    Tambah Data Tahun Akademik
@endsection()

@section('menu')
    Data Tahun Akademik
@endsection()

@section('submenu')
    Tambah Data Tahun Akademik
@endsection()

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Tahun Akademik <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/tahun-akademik" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="kode">Kode Tahun Akademik</label>
                                    <input type="text" name="kode"
                                        class="form-control @error('kode') is-invalid @enderror" id="kode"
                                        placeholder="Kode Tahun Akademik" value="{{ old('kode') }}" required>
                                    @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="tahun_akademik">Tahun Akademik</label>
                                    <input type="text" name="tahun_akademik"
                                        class="form-control @error('tahun_akademik') is-invalid @enderror"
                                        id="tahun_akademik" placeholder="Tahun Akademik" value="{{ old('tahun_akademik') }}"
                                        required>
                                    @error('tahun_akademik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text" name="semester"
                                        class="form-control @error('semester') is-invalid @enderror" id="semester"
                                        placeholder="Semester" value="{{ old('semester') }}" required>
                                    @error('semester')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="periode_pembayaran">Periode Pembayaran</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_awal_pembayaran"
                                                class="form-control @error('tanggal_awal_pembayaran') is-invalid @enderror"
                                                id="tanggal_awal_pembayaran" placeholder="Tanggal Awal"
                                                value="{{ old('tanggal_awal_pembayaran') }}" required>
                                            @error('tanggal_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_akhir_pemabayaran"
                                                class="form-control @error('tanggal_akhir_pemabayaran') is-invalid @enderror"
                                                id="tanggal_akhir_pemabayaran" placeholder="Tanggal Akhir"
                                                value="{{ old('tanggal_akhir_pemabayaran') }}" required>
                                            @error('tanggal_akhir_pemabayaran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periode_perkuliahan">Periode Perkuliahan</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_awal_perkuliahan"
                                                class="form-control @error('tanggal_awal_perkuliahan') is-invalid @enderror"
                                                id="tanggal_awal_perkuliahan" placeholder="Tanggal Awal"
                                                value="{{ old('tanggal_awal_perkuliahan') }}" required>
                                            @error('tanggal_awal_perkuliahan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_akhir_perkuliahan"
                                                class="form-control @error('tanggal_akhir_perkuliahan') is-invalid @enderror"
                                                id="tanggal_akhir_perkuliahan" placeholder="Tanggal Akhir"
                                                value="{{ old('tanggal_akhir_perkuliahan') }}" required>
                                            @error('tanggal_akhir_perkuliahan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periode_krs">Periode KRS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="krs_awal"
                                                class="form-control @error('krs_awal') is-invalid @enderror" id="krs_awal"
                                                placeholder="Tanggal Awal" value="{{ old('krs_awal') }}" required>
                                            @error('krs_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="krs_akhir"
                                                class="form-control @error('krs_akhir') is-invalid @enderror" id="krs_akhir"
                                                placeholder="Tanggal Akhir" value="{{ old('krs_akhir') }}" required>
                                            @error('krs_akhir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periode_penilaian">Periode Penilaian</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="penilaian_awal"
                                                class="form-control @error('penilaian_awal') is-invalid @enderror"
                                                id="penilaian_awal" placeholder="Tanggal Awal"
                                                value="{{ old('penilaian_awal') }}" required>
                                            @error('penilaian_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="penilaian_akhir"
                                                class="form-control @error('penilaian_akhir') is-invalid @enderror"
                                                id="penilaian_akhir" placeholder="Tanggal Akhir"
                                                value="{{ old('penilaian_akhir') }}" required>
                                            @error('penilaian_akhir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periode_uts">Periode UTS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="uts_awal"
                                                class="form-control @error('uts_awal') is-invalid @enderror"
                                                id="uts_awal" placeholder="Tanggal Awal" value="{{ old('uts_awal') }}"
                                                required>
                                            @error('uts_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="uts_akhir"
                                                class="form-control @error('uts_akhir') is-invalid @enderror"
                                                id="uts_akhir" placeholder="Tanggal Akhir"
                                                value="{{ old('uts_akhir') }}" required>
                                            @error('uts_akhir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="periode_uas">Periode UAS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="uas_awal"
                                                class="form-control @error('uas_awal') is-invalid @enderror"
                                                id="uas_awal" placeholder="Tanggal Awal" value="{{ old('uas_awal') }}"
                                                required>
                                            @error('uts_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" name="uas_akhir"
                                                class="form-control @error('uas_akhir') is-invalid @enderror"
                                                id="uas_akhir" placeholder="Tanggal Akhir"
                                                value="{{ old('uas_akhir') }}" required>
                                            @error('uas_akhir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
@endsection()
