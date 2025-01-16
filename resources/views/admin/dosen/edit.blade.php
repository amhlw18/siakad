@extends('layouts.main')

@section('title')
    Ubah Data Dosen
@endsection()


@section('mainmenu')
    Ubah Data Dosen
@endsection()

@section('menu')
    Ubah Dosen
@endsection()

@section('submenu')
    Ubah Data Dosen
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
                        <form id="quickForm" method="post" action="/dashboard/data-dosen/{{$dosen->nidn}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="prodi_id">Homebase Program Studi</label>
                                    <select class="custom-select rounded-0" id="prodi_id" name="prodi_id">
                                        <option value="" >--Pilih Prodi--</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id', $dosen->prodi_id) == $prodi->kode_prodi)
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
                                    <label for="nidn">NIDN</label>
                                    <input type="text" name="nidn"
                                           class="form-control @error('nidn') is-invalid @enderror" id="nidn"
                                           placeholder="NIDN" value="{{ old('nidn', $dosen->nidn) }}" required>
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
                                           placeholder="Nama Dosen" value="{{ old('nama_dosen',$dosen->nama_dosen) }}" required>
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
                                           placeholder="Gelar Depan" value="{{ old('gelar_depan',$dosen->gelar_depan) }}" >
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
                                           placeholder="Gelar Belakang" value="{{ old('gelar_belakang',$dosen->gelar_belakang) }}">
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
                                           placeholder="Tempat Lahir" value="{{ old('tempat_lahir',$dosen->tempat_lahir) }}" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date"  name="tgl_lahir"
                                           class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                           placeholder="Tanggal Lahir" value="{{ old('tgl_lahir',$dosen->tgl_lahir) }}" required>
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
                                        <option value="" disabled selected>--Pilih Jenis Kelamin--</option>
                                        @if (old('jenis_kelamin',$dosen->jenis_kelamin) == $dosen->jenis_kelamin)
                                            <option selected value="{{ $dosen->jenis_kelamin }}">{{ $dosen->jenis_kelamin }}</option>
                                        @else
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        @endif
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
                                        <option value="" disabled selected>--Pilih Agama--</option>
                                        @if (old('agama',$dosen->agama) == $dosen->agama)
                                            <option selected value="{{ $dosen->agama }}">
                                                {{ $dosen->agama }}</option>
                                        @else

                                        @endif
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
                                    <input type="number" name="no_hp"
                                           class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                           placeholder="No Handphone" value="{{ old('no_hp',$dosen->no_hp) }}" required>
                                    @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                           class="form-control @error('email') is-invalid @enderror" id="email"
                                           placeholder="Email" value="{{ old('email',$dosen->email) }}" >
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat"
                                           class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                           placeholder="Alamat Lengkap" value="{{ old('alamat',$dosen->alamat) }}" required>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tgl_kerja">Tanggal Kerja</label>
                                    <input type="date" name="tgl_kerja"
                                           class="form-control @error('tgl_kerja') is-invalid @enderror" id="tgl_kerja"
                                           placeholder="Tanggal Mulai Bekerja" value="{{ old('tgl_kerja',$dosen->tgl_kerja) }}" >
                                    @error('tgl_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="ikatan_kerja">Ikatan Kerja</label>
                                    <select class="custom-select rounded-0 @error('ikatan_kerja') is-invalid @enderror"
                                            id="ikatan_kerja" name="ikatan_kerja" >
                                        <option value="" disabled selected>--Pilih Ikatan Kerja--</option>
                                        @if (old('ikatan_kerja',$dosen->ikatan_kerja) == $dosen->ikatan_kerja)
                                            <option selected value="{{ $dosen->ikatan_kerja }}">
                                                {{ $dosen->ikatan_kerja }}</option>
                                        @else


                                        @endif
                                        <option value="Dosen DPK PNS">Dosen DPK PNS</option>
                                        <option value="Dosen Luar Biasa">Dosen Luar Biasa</option>
                                        <option value="Dosen Kontrak">Dosen Kontrak</option>
                                        <option value="Dosen Tetap">Dosen Tetap</option>

                                    </select>
                                    @error('ikatan_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan Tertinggi</label>
                                    <select class="custom-select rounded-0 @error('pendidikan') is-invalid @enderror"
                                            id="pendidikan" name="pendidikan" >
                                        <option value="" disabled selected>--Pilih Pendidikan--</option>
                                        @if (old('pendidikan',$dosen->pendidikan) == $dosen->pendidikan)
                                            <option selected value="{{ $dosen->pendidikan }}">
                                                {{ $dosen->pendidikan }}</option>
                                        @else

                                        @endif
                                        <option value="S-3">S-3</option>
                                        <option value="S-2">S-2</option>
                                        <option value="S-1">S-1</option>
                                        <option value="D-4">D-4</option>
                                        <option value="D-3">D-3</option>
                                        <option value="D-2">D-2</option>
                                        <option value="D-1">D-1</option>
                                        <option value="SP-1">SP-1</option>
                                        <option value="SP-2">SP-2</option>
                                        <option value="Profesi">Profesi</option>

                                    </select>
                                    @error('pendidikan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select rounded-0 @error('status') is-invalid @enderror"
                                            id="status" name="status" >
                                        <option value="" disabled selected>--Pilih Status--</option>
                                        @if (old('status',$dosen->status) == $dosen->status)
                                            <option selected value="{{ $dosen->status }}">
                                                {{ $dosen->status }}</option>
                                        @else

                                        @endif
                                        <option value="Cuti">Cuti</option>
                                        <option value="Keluar">Keluar</option>
                                        <option value="Meninggal">Meninggal</option>
                                        <option value="Pensiun">Pensiun</option>
                                        <option value="Studi Lanjut">Studi Lanjut</option>
                                        <option value="Tugas Di Instansi Lain">Tugas Di Instansi Lain</option>
                                        <option value="Aktif Mengajar">Aktif Mengajar</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jabatan_akademik">Jabatan Akademik</label>
                                    <select class="custom-select rounded-0 @error('jabatan_akademik') is-invalid @enderror"
                                            id="jabatan_akademik" name="jabatan_akademik" >
                                        <option value="" disabled selected>--Pilih Jabatan Akademik--</option>
                                        @if (old('jabatan_akademik',$dosen->jabatan_akademik) == $dosen->jabatan_akademik)
                                            <option selected value="{{ $dosen->jabatan_akademik }}">
                                                {{ $dosen->jabatan_akademik }}</option>
                                        @else

                                        @endif
                                        <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                        <option value="Asisten Ahli">Asisten Ahli</option>
                                        <option value="Lektor">Lektor</option>
                                        <option value="Lektor Kepala">Lektor Kepala</option>
                                        <option value="Guru Besar">Guru Besar</option>

                                    </select>
                                    @error('jabatan_akademik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jabatan_struktural">Jabatan Struktural</label>
                                    <input type="text" name="jabatan_struktural"
                                           class="form-control @error('jabatan_struktural') is-invalid @enderror" id="jabatan_struktural"
                                           placeholder="Jabatan Struktural" value="{{ old('jabatan_struktural',$dosen->jabatan_struktural) }}" >
                                    @error('jabatan_struktural')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="golongan">Golongan</label>
                                    <select class="custom-select rounded-0 @error('golongan') is-invalid @enderror"
                                            id="golongan" name="golongan" >
                                        <option value="" disabled selected>--Pilih Golongan--</option>
                                        @if (old('agama',$dosen->golongan) == $dosen->golongan)
                                            <option selected value="{{ $dosen->golongan }}">
                                                {{ $dosen->golongan }}</option>
                                        @else

                                        @endif
                                        <option value="IIIA Penata Muda">IIIA Penata Muda</option>
                                        <option value="IIIB Penata Muda Tk.1">IIB Penata Muda Tk.1</option>
                                        <option value="IIIC Penata">IIIC Penata</option>
                                        <option value="IIID Penata Tk.1">IIID Penata Tk.1</option>
                                        <option value="IVA Pembina">IVA Pembina</option>
                                        <option value="IVB Pembina Tk.1">IVB Pembina Tk.1</option>
                                        <option value="IVC Pembina Utama Muda">IVC Pembina Utama Muda</option>
                                        <option value="IVD Pembina Utama Madya">IVD Pembina Utama Madya</option>
                                        <option value="IVE Pembina Utama">IVE Pembina Utama</option>


                                    </select>
                                    @error('golongan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
