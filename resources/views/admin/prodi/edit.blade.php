@extends('layouts.main')

@section('title')
    Ubah Data Program Studi
@endsection()


@section('mainmenu')
    Ubah Data Program Studi
@endsection()

@section('menu')
    Ubah Program Studi
@endsection()

@section('submenu')
    Ubah Data Program Studi
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
                            <h3 class="card-title">Form Data Program Studi <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/prodi/{{$prodi->kode_prodi}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode_prodi">Kode Program Studi</label>
                                    <input type="text" name="kode_prodi"
                                           class="form-control @error('kode_prodi') is-invalid @enderror" id="kode_prodi"
                                           placeholder="Kode Program Studi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
                                    @error('kode_prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_prodi">Program Studi</label>
                                    <input type="text" name="nama_prodi"
                                           class="form-control @error('nama_prodi') is-invalid @enderror" id="nama_prodi"
                                           placeholder="Nama Program Studi" value="{{ old('nama_mk',$prodi->nama_prodi) }}" required>
                                    @error('nama_mk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="jenjang">Jenjang</label>
                                    <select class="custom-select rounded-0 @error('jenjang') is-invalid @enderror"
                                            id="jenjang" name="jenjang" >
                                        <option value="" disabled selected>--Pilih Jenjang--</option>
                                        @if (old('jenjang',$prodi->jenjang) == $prodi->jenjang)
                                            <option selected value="{{ $prodi->jenjang }}">
                                                {{ $prodi->jenjang }}</option>
                                        @else
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                            <option value="D4">D4</option>
                                            <option value="D3">D3</option>
                                            <option value="D2">D2</option>
                                            <option value="D1">D1</option>
                                            <option value="Profesi">Profesi</option>
                                            <option value="Non-Akademik">Non-Akademik</option>
                                            <option value="SP-1">SP-1</option>
                                            <option value="SP-2">SP-2</option>
                                        @endif
                                    </select>
                                    @error('jenjang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="ka_prodi">Ka Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="ka_prodi">
                                        <option value="" disabled selected>--Pilih Ka Program Studi--</option>
                                        @foreach ($dosens as $dosen)
                                            @if (old('ka_prodi',$prodi->ka_prodi) == $dosen->nidn)
                                                <option selected value="{{ $dosen->kode_prodi }}">
                                                    {{ $dosen->nama_dosen }}</option>
                                            @else
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama_dosen }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
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
