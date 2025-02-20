@extends('layouts.main')

@section('title')
    Tambah Data Batas SKS
@endsection()


@section('mainmenu')
    Tambah Data Batas SKS
@endsection()

@section('menu')
    Data Batas SKS
@endsection()

@section('submenu')
    Tambah Data Batas SKS
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
                            <h3 class="card-title">Form Data Batas SKS <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/batas-sks" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="prodi_id">
                                        <option value="" disabled selected>--Pilih Prodi--</option>
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
                                    <label for="ipk_min">IPK Minimal</label>
                                    <input type="text" name="ipk_min"
                                           class="form-control @error('ipk_min') is-invalid @enderror" id="ipk_min"
                                           placeholder="IPK Minimal" value="{{ old('ipk_min') }}" required>
                                    @error('ipk_min')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="ipk_max">IPK Maximal</label>
                                    <input type="text" name="ipk_max"
                                           class="form-control @error('ipk_max') is-invalid @enderror" id="ipk_max"
                                           placeholder="IPK Maximal" value="{{ old('ipk_max') }}" required>
                                    @error('ipk_max')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_sks">Jumlah SKS</label>
                                    <input type="text" name="jumlah_sks"
                                           class="form-control @error('jumlah_sks') is-invalid @enderror" id="jumlah_sks"
                                           placeholder="Jumlah SKS" value="{{ old('jumlah_sks') }}" required>
                                    @error('jumlah_sks')
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
