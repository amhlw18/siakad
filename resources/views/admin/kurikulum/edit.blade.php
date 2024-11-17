@extends('layouts.main')

@section('title')
Ubah Data Kurikulum
@endsection()


@section('mainmenu')
Ubah Data Kurikulum
@endsection()

@section('menu')
Data Kurikulum
@endsection()

@section('submenu')
Ubah Data Kurikulum
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
            <h3 class="card-title">Form Data Kurikulum <small></small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="quickForm" method="post" action="/dashboard/kurikulum/{{$kurikulum->kode_kurikulum}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="tahun_akademik_id">Berlaku Tahun Akademik</label>
                    <select id="tahun_akademik_id" class="custom-select rounded-0" name="tahun_akademik_id"
                        autocomplete="tahun_akademik_id">
                        @foreach ($tahun_akademis as $tahun_akademik)
                            <option value="{{ $tahun_akademik->id }}"
                                {{ old('tahun_akademik_id', $tahun_akademik->tahun_akademik_id) == $tahun_akademik->id ? 'selected' : '' }}>
                                {{ $tahun_akademik->tahun_akademik }}
                            </option>
                        @endforeach
                    </select>
                </div>

              <div class="form-group">
                <label for="kode_kurikulum">Kode Kurikulum</label>
                <input type="text" name="kode_kurikulum" class="form-control @error('kode_kurikulum') is-invalid @enderror" id="kode_kurikulum" placeholder="Kode Kurikulum" value="{{ old('kode_kurikulum', $kurikulum->kode_kurikulum) }}" required>
                @error('kode_kurikulum')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="kode_kurikulum">Nama Kurikulum</label>
                <input type="text" name="nama_kurikulum" class="form-control @error('nama_kurikulum') is-invalid @enderror" id="nama_kurikulum" placeholder="Nama Kurikulum" value="{{ old('nama_kurikulum', $kurikulum->nama_kurikulum) }}" required>
                @error('kode_kurikulum')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="sks_wajib">SKS Wajib</label>
                <input type="text" name="sks_wajib" class="form-control @error('sks_wajib') is-invalid @enderror" id="sks_wajib" placeholder="SKS Wajib" value="{{ old('sks_wajib', $kurikulum->sks_wajib) }}" required>
                @error('sks_wajib')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="sks_pilihan">SKS Pilihan</label>
                <input type="text" name="sks_pilihan" class="form-control @error('sks_pilihan') is-invalid @enderror" id="sks_pilihan" placeholder="SKS Pilihan" value="{{ old('sks_pilihan',$kurikulum->sks_pilihan) }}" required>
                @error('sks_pilihan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="jumlah_sks">Jumlah SKS</label>
                <input type="text" name="jumlah_sks" class="form-control @error('jumlah_sks') is-invalid @enderror" id="jumlah_sks" placeholder="Jumlah SKS" value="{{ old('jumlah_sks', $kurikulum->jumlah_sks) }}" required>
                @error('jumlah_sks')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="status">Status</label><br>
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $kurikulum->status) == 1 ? 'checked' : '' }}>
                <label for="status">Aktif</label>
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