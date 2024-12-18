@extends('layouts.main')

@section('title')
    Tambah Kelas Mahasiswa
@endsection()

@section('mainmenu')
   Tambah Kelas Mahasiswa
@endsection()

@section('menu')
    Kelas Mahasiswa
@endsection()

@section('submenu')
    Master Kelas Mahasiswa
@endsection()

@section('content')
    <section class="content">
        <div class="container-fluid">

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Kelas Mahasiswa <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/kls-mhs" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select class="custom-select rounded-0" id="prodi_id" name="prodi_id">
                                        <option value="" disabled selected>--Pilih Prodi--</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id') == $prodi->kode_prodi)
                                                <option selected value="{{ $prodi->kode_prodi }}">{{ $prodi->kode_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select class="custom-select rounded-0" id="kelas_id" name="kelas_id">
                                        <option value="" disabled selected>--Pilih Kelas--</option>
                                        @foreach ($kelas as $kls)
                                            @if (old('kelas_id') == $kls->id)
                                                <option selected value="{{ $kls->id }}">{{ $kls->id }} </option>
                                            @else
                                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }} | {{$kls->program}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="semester_masuk">Semester Masuk</label>
                                    <select class="custom-select rounded-0" id="semester_masuk" name="semester_masuk" required>
                                        <option value="" disabled selected>--Pilih Semester Masuk--</option>
                                        @foreach ($tahun_akademis as $thn_akademik)
                                            <option value="{{ $thn_akademik->kode }}" {{ old('semester_masuk') == $thn_akademik->kode ? 'selected' : '' }}>
                                                {{ $thn_akademik->tahun_akademik }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('semester_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Proses</button>
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


