@extends('layouts.main')

@section('title')
    Tambah Data Ruangan
@endsection()


@section('mainmenu')
    Tambah Data Ruangan
@endsection()

@section('menu')
    Data Ruangan
@endsection()

@section('submenu')
    Tambah Data Ruangan
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
                            <h3 class="card-title">Form Data Ruangan <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/ruangan" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="nama_ruangan">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan"
                                           class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan"
                                           placeholder="Nama Ruangan" value="{{ old('nama_ruangan') }}" required>
                                    @error('nama_ruangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="prodi_id">
                                        <option value="" disabled selected>--Pilih Prodi</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id') == $prodi->kode_prodi)
                                                <option selected value="{{ $prodi->kode_prodi }}">
                                                    {{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gedung">Gedung</label>
                                    <input type="text" name="gedung"
                                           class="form-control @error('gedung') is-invalid @enderror" id="gedung"
                                           placeholder="Gedung" value="{{ old('gedung') }}" required>
                                    @error('gedung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lantai">Lantai</label>
                                    <input type="text" name="lantai"
                                           class="form-control @error('lantai') is-invalid @enderror" id="lantai"
                                           placeholder="Lantai" value="{{ old('lantai') }}" required>
                                    @error('lantai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
