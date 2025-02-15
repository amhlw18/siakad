@extends('layouts.main')

@section('title')
    Data Nilai Mahasiswa
@endsection()

@section('mainmenu')

@endsection()

@section('menu')
    Data Nilai Mahasiswa
@endsection()

@section('submenu')
    Master Nilai Mahasiswa
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($periode)
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                - {{ $pesan }}
            </div>
        @else
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                - {{ $pesan }}
            </div>
        @endif


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Mahasiswa Matakuliah {{$matkul->nama_mk}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                @if($periode)
                                    <a href="#"
                                       class="btn btn-primary btn-isi-nilai"
                                       data-bs-toggle="modal"
                                       data-bs-target="#buatJadwalModal"
                                       data-id="{{$mhs->nim}}">
                                        <i class="bi bi-plus"></i>
                                    </a>

                                    <a href="/dashboard/nilai-semester/{{ encrypt ($mhs->nim) }}/{{ encrypt($matkul->kode_mk)}}/edit"
                                       class="btn btn-success">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @else
                                    <a href="#"
                                       class="btn btn-primary btn-isi-nilai disabled"
                                       data-bs-toggle="modal"
                                       data-bs-target="#buatJadwalModal"
                                       data-id="{{$mhs->nim}}">
                                        <i class="bi bi-plus"></i>
                                    </a>

                                    <a href="/dashboard/nilai-semester/{{ $mhs->nim }}/{{$matkul->kode_mk}}/edit"
                                       class="btn btn-success disabled">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->krs_mhs->nama_mhs}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="buatJadwalModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Penilaian Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="simpanForm">
                        <input type="hidden" id="nilai_id" name="nilai_id" value="">
                        <input type="hidden" id="nim" name="nim" value="">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun->kode}}">
                        <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="{{$matkul->kode_mk}}">

                        <div class="form-group">
                            <label for="prodi_id">Aspek Penilaian</label>
                            <select class="custom-select rounded-0" id="aspek_id" name="aspek_id" required>
                                <option value="" disabled selected>--Pilih Aspek Penilai--</option>
                                @foreach ($aspeks as $aspek)
                                    <option value="{{ $aspek->id }}" {{ old('aspek_id') == $aspek->id ? 'selected' : '' }}>
                                        {{ $aspek->aspek }}
                                    </option>
                                @endforeach
                            </select>
                            @error('aspek_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Nilai Angka">Nilai Angka</label>
                            <input type="number" name="nilai"
                                   class="form-control @error('nilai') is-invalid @enderror" id="nilai"
                                   placeholder="Isi dengan nilai angka" value="{{ old('nilai') }}" required>
                            @error('nilai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Proses</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));
            const nilai_id = document.getElementById('nilai_id');
            const nim = document.getElementById('nim');
            const tahun = document.getElementById('tahun_akademik').value;
            const matkul = document.getElementById('matakuliah_id').value;

            document.querySelector('#tabel').addEventListener('click', (e) => {
                if (e.target.closest('.btn-isi-nilai')) {
                    e.preventDefault();
                    const button = e.target.closest('.btn-isi-nilai');
                    const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                    nim.value = id;
                }
            });

            document.getElementById('saveChanges').addEventListener('click', () => {
                const form = document.getElementById('simpanForm');
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                const id = document.getElementById('nilai_id');
                const nilai_id = id.value;
                const url = nilai_id ? `/dashboard/nilai-semester/${nilai_id}` : '/dashboard/nilai-semester';

                if (nilai_id) {
                    formData.append('_method', 'PUT');
                    console.log('edit data');
                } else {
                    console.log('tambah data');
                }

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                    .then(async response => {
                        if (!response.ok) {
                            // Lempar error dengan status dan teks respons
                            throw { status: response.status, message: await response.text() };
                        }
                        // Pastikan respons valid JSON
                        const data = await response.json();
                        return data;
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success,
                        }).then(() => {
                            //location.reload();
                        });
                    })
                    .catch(async error => {
                        if (error.status === 422) {
                            const errorData = JSON.parse(error.message); // Parsing JSON manual
                            const errorMessages = Object.values(errorData.errors).flat().join('\n');
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                text: errorMessages,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data. Coba lagi!',
                            });
                            console.error('Error:', error.message || error);
                        }
                    });



            });
        });

    </script>

@endsection()
