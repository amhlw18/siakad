@extends('layouts.main')

@section('title')
    Tambah Data Dosen
@endsection()


@section('mainmenu')
    Tambah Data Dosen
@endsection()

@section('menu')
    Data Dosen
@endsection()

@section('submenu')
    Tambah Data Dosen
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
                            <h3 class="card-title">Form Data Dosen <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/kelas" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="prodi_id">Homebase Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="prodi_id">
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id') == $prodi->id)
                                                <option selected value="{{ $prodi->id }}">
                                                    {{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" name="nidn"
                                           class="form-control @error('nidn') is-invalid @enderror" id="nidn"
                                           placeholder="NIDN" value="{{ old('nidn') }}" required>
                                    @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_dosen">Nama Dosen</label>
                                    <input type="text" name="nama_dosen"
                                           class="form-control @error('nama_dosen') is-invalid @enderror" id="nama_dosen"
                                           placeholder="Nama Dosen" value="{{ old('nama_dosen') }}" required>
                                    @error('nama_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" name="gelar_depan"
                                           class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan"
                                           placeholder="Gelar Depan" value="{{ old('gelar_depan') }}" >
                                    @error('gelar_depan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gelar_belakang">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang"
                                           class="form-control @error('gelar_belakang') is-invalid @enderror" id="gelar_belakang"
                                           placeholder="Gelar Belakang" value="{{ old('gelar_belakang') }}" required>
                                    @error('gelar_belakang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                           class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                                           placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tempat_lahir"
                                           class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                           placeholder="Tanggal Lahir" value="{{ old('tgl_lahir') }}" required>
                                    @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="custom-select rounded-0 @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" >
                                        <option value="">--Pilih Jenis Kelamin--</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="custom-select rounded-0 @error('agama') is-invalid @enderror"
                                            id="agama" name="agama" >
                                        <option value="">--Pilih Agama--</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Lain-Lain">Lain-Lain</option>
                                    </select>
                                    @error('agama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <input type="date" name="tempat_lahir"
                                           class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                           placeholder="Tanggal Lahir" value="{{ old('tgl_lahir') }}" required>
                                    @error('tgl_lahir')
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
