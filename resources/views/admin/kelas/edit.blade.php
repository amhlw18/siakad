@extends('layouts.main')

@section('title')
    Ubah Data Kelas
@endsection()


@section('mainmenu')
    Ubah Data Kelas
@endsection()

@section('menu')
    Ubah Kelas
@endsection()

@section('submenu')
    Ubah Data Kelas
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
                            <h3 class="card-title">Form Data Kelas <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/kelas/{{$kelas->id}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="prodi_id">
                                        <option value="" disabled selected>--Pilih Prodi--</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id',$kelas->prodi_id) == $prodi->kode_prodi)
                                                <option selected value="{{ $prodi->prodi_id }}">
                                                    {{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nama_kelas">Nama Kelas</label>
                                    <input type="text" name="nama_kelas"
                                           class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas"
                                           placeholder="Nama Kelas" value="{{ old('nama_kelas',$kelas->nama_kelas) }}" required>
                                    @error('nama_kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="program">Program</label>
                                    <select class="custom-select rounded-0 @error('program') is-invalid @enderror"
                                            id="program" name="program" >
                                        <option value="" disabled selected>--Pilih Program--</option>
                                        @if (old('program',$kelas->program) == $kelas->program)
                                            <option selected value="{{ $kelas->program }}">
                                                {{ $kelas->program }}</option>
                                        @else
                                            <option value="Reguler">Reguler</option>
                                            <option value="Non Reguler">Non Reguler</option>
                                        @endif
                                    </select>
                                    @error('program')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" name="kapasitas"
                                           class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas"
                                           placeholder="Kapasitas Kelas" value="{{ old('kapasitas',$kelas->kapasitas) }}" required>
                                    @error('kapasitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="aktif">Aktif</label><br>
                                    <input type="checkbox" name="aktif" id="aktif" value="1"
                                        {{ old('aktif', $kelas->aktif) == 1 ? 'checked' : '' }}>
                                    <label for="aktif">Aktif</label>
                                </div>

                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
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
