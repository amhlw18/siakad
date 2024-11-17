@extends('layouts.main')

@section('title')
    Tambah Data Matakuliah
@endsection()


@section('mainmenu')
    Tambah Data Matakuliah
@endsection()

@section('menu')
    Data Matakuliah
@endsection()

@section('submenu')
    Tambah Data Matakuliah
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
                            <h3 class="card-title">Form Data Matakuliah <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/matakuliah" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="kurikulum">Kurikulum</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="kurikulum_id">
                                        @foreach ($kurikulums as $kurikulum)
                                            @if (old('kurikulum_id') == $kurikulum->id)
                                                <option selected value="{{ $kurikulum->id }}">
                                                    {{ $kurikulum->nama_kurikulum }}</option>
                                            @else
                                                <option value="{{ $kurikulum->id }}">{{ $kurikulum->nama_kurikulum }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kode_mk">Kode Mata Kuliah</label>
                                    <input type="text" name="kode_mk"
                                        class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk"
                                        placeholder="Kode Mata Kuliah" value="{{ old('kode_mk') }}" required>
                                    @error('kode_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_mk">Nama Mata Kuliah</label>
                                    <input type="text" name="nama_mk"
                                        class="form-control @error('nama_mk') is-invalid @enderror" id="nama_mk"
                                        placeholder="Nama Mata Kuliah" value="{{ old('nama_mk') }}" required>
                                    @error('nama_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kode_prodi">Program Studi</label>
                                    <select class="custom-select rounded-0" id="kurikulum_id" name="kode_prodi">
                                        @foreach ($prodis as $prodi)
                                            @if (old('kode_prodi') == $prodi->id)
                                                <option selected value="{{ $prodi->id }}">
                                                    {{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="custom-select rounded-0 @error('semester') is-invalid @enderror"
                                        id="semester" name="semester" >
                                        <option value="">--Pilih Semester--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                    @error('semester')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sks_teori">SKS Teori</label>
                                    <input type="text" name="sks_teori"
                                        class="form-control @error('sks_teori') is-invalid @enderror" id="sks_teori"
                                        placeholder="SKS Teori" value="{{ old('sks_teori') }}" required>
                                    @error('sks_teori')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sks_praktek">SKS Praktek</label>
                                    <input type="text" name="sks_praktek"
                                        class="form-control @error('sks_praktek') is-invalid @enderror" id="sks_praktek"
                                        placeholder="SKS Praktek" value="{{ old('sks_praktek') }}" required>
                                    @error('sks_praktek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sks_lapangan">SKS Lapangan</label>
                                    <input type="text" name="sks_lapangan"
                                        class="form-control @error('sks_lapangan') is-invalid @enderror" id="sks_lapangan"
                                        placeholder="SKS Lapangan" value="{{ old('sks_lapangan') }}" required>
                                    @error('sks_lapangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kelompok_mk">Kelompok Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('kelompok_mk') is-invalid @enderror"
                                        id="kelompok_mk" name="kelompok_mk">
                                        <option value="">--Pilih Kelompok Matakuliah--</option>
                                        <option value="MPK-Pengembangan Kepribadian">MPK-Pengembangan Kepribadian</option>
                                        <option value="MKK-Keilmuan dan Keterampilan">MKK-Keilmuan dan Keterampilan</option>
                                        <option value="MKB-Keahlian Berkarya">MKB-Keahlian Berkarya</option>
                                        <option value="MPK-Prilaku Berkarya">MPK-Prilaku Berkarya</option>
                                        <option value="MBB-Berkehidupan Bermasyarakat">MBB-Berkehidupan Bermasyarakat
                                        </option>
                                        <option value="MKU/MKDU">MKU/MKDU</option>
                                        <option value="MKDK">MKDK</option>
                                        <option value="MKK">MKK</option>
                                    </select>
                                    @error('kelompok_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelompok">Jenis Kelompok</label>
                                    <select class="custom-select rounded-0 @error('jenis_kelompok') is-invalid @enderror"
                                        id="jenis_kelompok" name="jenis_kelompok">
                                        <option value="">--Pilih Jenis Kelompok--</option>
                                        <option value="Inti">Inti</option>
                                        <option value="Institusi">Institusi</option>
                                    </select>
                                    @error('jenis_kelompok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_mk">Jenis Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('jenis_mk') is-invalid @enderror"
                                        id="jenis_mk" name="jenis_mk">
                                        <option value="">--Pilih Jenis Matakuliah--</option>
                                        <option value="Wajib">Wajib</option>
                                        <option value="Pilihan">Pilihan</option>
                                        <option value="Wajib Peminatan">Wajib Peminatan</option>
                                        <option value="Pilihan Peminatan">Pilihan Peminatan</option>
                                        <option value="TA/Skripsi/Tesis/Desertasi">TA/Skripsi/Tesis/Desertasi</option>
                                    </select>
                                    @error('jenis_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status_mk">Status Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('status_mk') is-invalid @enderror"
                                        id="status_mk" name="status_mk">
                                        <option value="">--Pilih Status Mata Kuliah--</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Ahli Bentuk">Ahli Bentuk</option>
                                        <option value="Hapus">Hapus</option>
                                        <option value="Ahli Kelola">Alih Kelola</option>
                                        <option value="Marger">Marger</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                    @error('status_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="silabus_mk">Silabus Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('silabus_mk') is-invalid @enderror"
                                        id="silabus_mk" name="silabus_mk">
                                        <option value="">--Pilih Silabus Mata Kuiliah--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    @error('silabus_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sap_mk">SAP Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('sap_mk') is-invalid @enderror"
                                        id="sap_mk" name="sap_mk">
                                        <option value="">--Pilih SAP Mata Kuliah--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    @error('sap_mk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bahan_ajar">Bahan Ajar Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('bahan_ajar') is-invalid @enderror"
                                        id="bahan_ajar" name="bahan_ajar">
                                        <option value="">--Pilih Bahan Ajar--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>

                                    @error('bahan_ajar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="diktat">Diktat Mata Kuliah</label>
                                    <select class="custom-select rounded-0 @error('diktat') is-invalid @enderror"
                                        id="diktat" name="diktat">
                                        <option value="">--Pilih Diktat Mata Kuliah</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>

                                    @error('diktat')
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
