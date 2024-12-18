@extends('layouts.main')

@section('title')
    Ubah Data Mahasiswa
@endsection

@section('mainmenu')
    Ubah Data Mahasiswa
@endsection

@section('menu')
    Data Mahasiswa
@endsection

@section('submenu')
    Ubah Data Mahasiswa
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Mahasiswa</h3>
                        </div>
                        <form id="quickForm" method="post" action="/dashboard/data-mahasiswa/{{$mhs->nim}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">

                                <!-- Prodi -->
                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select class="custom-select rounded-0" id="prodi_id" name="prodi_id" required>
                                        <option value="" disabled selected>--Pilih Prodi--</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('prodi_id',$mhs->prodi_id) == $prodi->kode_prodi)
                                                <option selected value="{{ $prodi->kode_prodi }}">
                                                    {{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- NIM -->
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" name="nim"
                                           class="form-control @error('nim') is-invalid @enderror" id="nim"
                                           placeholder="NIM" value="{{ old('nim',$mhs->nim) }}" required>
                                    @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nama Mahasiswa -->
                                <div class="form-group">
                                    <label for="nama_mhs">Nama Mahasiswa</label>
                                    <input type="text" name="nama_mhs"
                                           class="form-control @error('nama_mhs') is-invalid @enderror" id="nama_mhs"
                                           placeholder="Nama Mahasiswa" value="{{ old('nama_mhs',$mhs->nama_mhs) }}" required>
                                    @error('nama_mhs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                           class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                                           placeholder="Tempat Lahir" value="{{ old('tempat_lahir',$mhs->tempat_lahir) }}" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir"
                                           class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                           value="{{ old('tgl_lahir',$mhs->tgl_lahir) }}" required>
                                    @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nama Ibu -->
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" name="nama_ibu"
                                           class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu"
                                           placeholder="Nama Ibu" value="{{ old('nama_ibu',$mhs->nama_ibu) }}" required>
                                    @error('nama_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nama Ayah -->
                                <div class="form-group">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" name="nama_ayah"
                                           class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah"
                                           placeholder="Nama Ayah" value="{{ old('nama_ayah',$mhs->nama_ayah) }}" required>
                                    @error('nama_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="custom-select rounded-0 @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>--Pilih Jenis Kelamin--</option>
                                        <option value="Laki-Laki" {{ old('jenis_kelamin',$mhs->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin',$mhs->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Agama -->
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="custom-select rounded-0 @error('agama') is-invalid @enderror"
                                            id="agama" name="agama" required>
                                        <option value="" disabled selected>--Pilih Agama--</option>
                                        <option value="Islam" {{ old('agama',$mhs->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Katolik" {{ old('agama',$mhs->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Protestan" {{ old('agama',$mhs->agama) == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                        <option value="Hindu" {{ old('agama',$mhs->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('agama',$mhs->agama) == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ old('agama',$mhs->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                    @error('agama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nomor HP -->
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" name="no_hp"
                                           class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                           placeholder="Nomor HP" value="{{ old('no_hp',$mhs->no_hp) }}" required>
                                    @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror" id="email"
                                           placeholder="Email (opsional)" value="{{ old('email',$mhs->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- NIK -->
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik"
                                           class="form-control @error('nik') is-invalid @enderror" id="nik"
                                           placeholder="Nomor Induk Kependudukan" value="{{ old('nik',$mhs->NIK) }}" required>
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <input type="text" name="alamat"
                                           class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                           placeholder="Alamat Lengkap" value="{{ old('alamat',$mhs->alamat) }}" required>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_masuk">Status Masuk</label>
                                    <select class="custom-select rounded-0 @error('status_masuk') is-invalid @enderror"
                                            id="status_masuk" name="status_masuk" required>
                                        <option value="" disabled selected>--Pilih Status Masuk--</option>
                                        <option value="Peserta Didik Baru" {{ old('status_masuk',$mhs->status_masuk) == 'Peserta Didik Baru' ? 'selected' : '' }}>Peserta Didik Baru</option>
                                        <option value="Pindahan" {{ old('status_masuk',$mhs->status_masuk) == 'Pindahan' ? 'selected' : '' }}>Pindahan</option>
                                        <option value="Pindahan Alih Bentuk" {{ old('status_masuk',$mhs->status_masuk) == 'Pindahan Alih Bentuk' ? 'selected' : '' }}>Pindahan Alih Bentuk</option>
                                        <option value="Alih Jenjang" {{ old('status_masuk',$mhs->status_masuk) == 'Alih Jenjang' ? 'selected' : '' }}>Alih Jenjang</option>
                                        <option value="Lintas Jalur" {{ old('status_masuk',$mhs->status_masuk) == 'Lintas Jalur' ? 'selected' : '' }}>Lintas Jalur</option>
                                        <option value="Naik Kelas" {{ old('status_masuk',$mhs->status_masuk) == 'Naik Kelas' ? 'selected' : '' }}>Naik Kelas</option>
                                        <option value="Akselerasi" {{ old('status_masuk',$mhs->status_masuk) == 'Akselerasi' ? 'selected' : '' }}>Akselerasi</option>
                                        <option value="Mengulang" {{ old('status_masuk',$mhs->status_masuk) == 'Mengulang' ? 'selected' : '' }}>Mengulang</option>
                                        <option value="Lanjut Semester" {{ old('status_masuk',$mhs->status_masuk) == 'Lanjut Semester' ? 'selected' : '' }}>Lanjut Semester</option>
                                        <option value="Rekognisi Pembelajaran Lampau" {{ old('status_masuk',$mhs->status_masuk) == 'Rekognisi Pembelajaran Lampau' ? 'selected' : '' }}>Rekognisi Pembelajaran Lampau</option>
                                        <option value="Course" {{ old('status_masuk',$mhs->status_masuk) == 'Course' ? 'selected' : '' }}>Course</option>
                                        <option value="Fast Track" {{ old('status_masuk',$mhs->status_masuk) == 'Fast Track' ? 'selected' : '' }}>Fast Track</option>
                                    </select>
                                    @error('status_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="program">Program</label>
                                    <select class="custom-select rounded-0 @error('program') is-invalid @enderror"
                                            id="program" name="program" required>
                                        <option value="" disabled selected>--Pilih Program--</option>
                                        <option value="Reguler" {{ old('program',$mhs->program) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                        <option value="Non Reguler" {{ old('program',$mhs->program) == 'Non Reguler' ? 'selected' : '' }}>Non Reguler</option>

                                    </select>
                                    @error('program')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                    <input type="text" name="tahun_masuk"
                                           class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk"
                                           placeholder="Tahun Masuk" value="{{ old('tahun_masuk',$mhs->tahun_masuk) }}" required>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="semester_masuk">Semester Masuk</label>
                                    <select class="custom-select rounded-0" id="semester_masuk" name="semester_masuk" required>
                                        <option value="" disabled selected>--Pilih Semester Masuk--</option>
                                        @foreach ($tahun_akademis as $thn_akademik)
                                            @if (old('semester_masuk',$mhs->semester_masuk) == $thn_akademik->kode)
                                                <option selected value="{{ $thn_akademik->kode }}">
                                                    {{ $thn_akademik->tahun_akademik }}</option>
                                            @else
                                                <option value="{{ $thn_akademik->kode }}">{{ $thn_akademik->tahun_akademik }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('semester_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select rounded-0 @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="" disabled selected>--Pilih Status--</option>
                                        <option value="AKTIF" {{ old('status',$mhs->status) == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                                        <option value="Lulus" {{ old('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="NON AKTIF" {{ old('status',$mhs->status) == 'NON AKTIF' ? 'selected' : '' }}>NON AKTIF</option>

                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>





                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
