@extends('layouts.main')

@section('title')
    Ubah Data Jadwal
@endsection()


@section('mainmenu')
    Ubah Data Jadwal
@endsection()

@section('menu')
    Data Jadwal
@endsection()

@section('submenu')
    Ubah Data JAdwal
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
                            <h3 class="card-title">Form Data Jadwal <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="post" action="/dashboard/data-jadwal-update/{{$id}}">
{{--                        <form id="quickForm" >--}}
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <input type="text" id="jadwal_id" name="jadwal_id" value="{{$id}}">
{{--                                <input type="text" id="matakuliah_id" name="matakuliah_id" value="{{$jadwal->matakuliah_id}}">--}}
{{--                                <input type="text" id="kelas_id" name="kelas_id" value="{{$jadwal->kelas_id}}">--}}
{{--                                <input type="text" id="ruangan_id" name="ruangan_id" value="{{$jadwal->ruangan_id}}">--}}
                                <div class="form-group">
                                    <label for="nidn">Dosen</label>
                                    <select id="nidn" class="custom-select rounded-0" name="nidn"
                                            autocomplete="">
                                        <option value="" disabled selected>--Pilih Dosen--</option>
                                        @foreach ($dosen as $item)
                                            <option value="{{ $item->nidn }}"
                                                {{ old('nidn', $jadwal->nidn) == $item->nidn ? 'selected' : '' }}>
                                                {{ $item->nama_dosen }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="matakuliah_id">Matakuliah</label>
                                    <select id="matakuliah_id" class="custom-select rounded-0" name="matakuliah_id"
                                            autocomplete="">
                                        <option value="" disabled selected>--Pilih Matakuliah--</option>
                                        @foreach ($matkul as $item)
                                            <option value="{{ $item->kode_mk }}"
                                                {{ old('matakuliah_id', $jadwal->matakuliah_id) == $item->kode_mk ? 'selected' : '' }}>
                                                {{ $item->nama_mk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" class="custom-select rounded-0" name="kelas_id"
                                            autocomplete="">
                                        <option value="" disabled selected>--Pilih Kelas--</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kelas_id', $jadwal->kelas_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ruangan_id">Ruangan</label>
                                    <select id="ruangan_id" class="custom-select rounded-0" name="ruangan_id"
                                            autocomplete="">
                                        <option value="" disabled selected>--Pilih Ruangan--</option>
                                        @foreach ($ruangan as $item)
                                            <option value="{{ $item->id }}"{{ old('ruangan_id', $jadwal->ruangan_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="prodi_id">Hari</label>
                                    <select class="custom-select rounded-0" id="hari" name="hari" required>
                                        <option value="" disabled selected>--Pilih Hari--</option>
                                        <option value="Senin" {{ old('hari', $jadwal->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ old('hari', $jadwal->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ old('hari', $jadwal->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ old('hari', $jadwal->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ old('hari', $jadwal->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                        <option value="Sabtu" {{ old('hari', $jadwal->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                        <option value="Minggu" {{ old('hari', $jadwal->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                    </select>
                                    @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="periode_pembayaran">Jam</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="time" name="jam_awal"
                                                   class="form-control @error('jam_awal') is-invalid @enderror"
                                                   id="jam_awal" placeholder=""
                                                   value="{{ old('jam_awal',$jadwal->jam_awal) }}" required>

                                            @error('jam_awal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" name="jam_akhir"
                                                   class="form-control @error('jam_akhir') is-invalid @enderror"
                                                   id="jam_akhir" placeholder=""
                                                   value="{{ old('jam_akhir',$jadwal->jam_akhir) }}" required>
                                            @error('jam_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
{{--                                <a  id="saveChanges" class="btn btn-primary">Ubah</a>--}}
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

{{--    <script>--}}
{{--        document.getElementById('saveChanges').addEventListener('click', () => {--}}
{{--            const form = document.getElementById('quickForm');--}}
{{--            const formData = new FormData(form);--}}

{{--            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;--}}

{{--            // Tambahkan metode PUT secara eksplisit--}}


{{--            const jadwalId = formData.get('jadwal_id'); // Ambil jadwal_id--}}
{{--            const url = `/dashboard/data-jadwal/${jadwalId}`--}}

{{--            if(jadwalId){--}}
{{--                formData.append('_method', 'PUT');--}}
{{--                console.log('edit dta');--}}
{{--            }else{--}}
{{--                console.log('tambah dta');--}}
{{--            }--}}

{{--            fetch(url, {--}}
{{--                method: 'POST',--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': csrfToken,--}}
{{--                },--}}
{{--                body: formData,--}}
{{--            })--}}
{{--                .then(response => {--}}
{{--                    if (!response.ok) {--}}
{{--                        throw response; // Lempar error jika respons tidak OK--}}
{{--                    }--}}
{{--                    return response.json();--}}
{{--                })--}}
{{--                .then(data => {--}}
{{--                    Swal.fire({--}}
{{--                        icon: 'success',--}}
{{--                        title: 'Berhasil!',--}}
{{--                        text: data.success,--}}
{{--                    }).then(() => {--}}
{{--                        location.reload(); // Reload halaman--}}
{{--                    });--}}
{{--                })--}}
{{--                .catch(async error => {--}}
{{--                    if (error.status === 422) {--}}
{{--                        const errorData = await error.json();--}}
{{--                        const errorMessages = Object.values(errorData.errors).flat().join('\n');--}}
{{--                        Swal.fire({--}}
{{--                            icon: 'error',--}}
{{--                            title: 'Validasi Gagal!',--}}
{{--                            text: errorMessages,--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        Swal.fire({--}}
{{--                            icon: 'error',--}}
{{--                            title: 'Error!',--}}
{{--                            text: 'Terjadi kesalahan saat menyimpan data. Coba lagi!',--}}
{{--                        });--}}
{{--                        console.error('Error:', error);--}}
{{--                    }--}}
{{--                });--}}
{{--        });--}}
{{--    </script>--}}
@endsection()
