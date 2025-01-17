@extends('layouts.main')

@section('title')
    Data Jadwal kuliah
@endsection()

@section('mainmenu')
     Jadwal Kuliah Prodi {{ $prodi->nama_prodi ?? '-' }}
@endsection()

@section('menu')
    Data Jadwal Kuliah
@endsection()

@section('submenu')
    Master Data Jadwal Kuliah
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
        <!-- Filter Section -->
        @if(auth()->user()->role == 1 || auth()->user()->role == 6)
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="filterTahun">Tahun Akademik</label>
                    <select id="filterTahun" class="form-control">
                        <option value="">Semua Tahun Akademik</option>
                        @foreach ($tahun_akademik as $tahun)
                            <option value="{{ $tahun->kode ?? '-' }}">{{ $tahun->tahun_akademik }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif


        <!-- Informasi Mahasiswa -->
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Program Studi  :</strong> {{ $prodi->nama_prodi ?? '-' }}</p>
                <p><strong>Tahun Akademik :</strong> {{ $tahun_aktif->tahun_akademik?? '-' }}</p>
            </div>
        </div>

        <a href="#"
           class="btn btn-primary mb-2 btn-jadwal"
           data-bs-toggle="modal"
           data-bs-target="#buatJadwalModal"
           data-id="{{ $prodi->kode_prodi ?? '-' }}">
            <span data-feather="plus"></span>Buat Jadwal Kuliah</a>

        <div class="card">
            <div class="card-header">
                <h3 id="judul" class="card-title">Master Data Jadwal Kuliah Prodi {{ $prodi->nama_prodi ?? '-' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
{{--                        <th>id</th>--}}
                        <th>Hari</th>
                        <th>Jam </th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Dosen</th>
                        <th>Kelas</th>
                        <th>Ruangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>

                                <a href="#"
                                   class="btn btn-warning btn-edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#buatJadwalModal"
                                    data-id="{{ $jadwal->id }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="#"
                                   class="btn btn-danger btn-hapus"
                                   data-id="{{ $jadwal->id }}">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>
                            <td>{{ $loop->iteration }}</td>
{{--                            <td>{{ $jadwal->id }}</td>--}}
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->jam }}</td>
                            <td>{{ $jadwal->jadwal_matakuliah->nama_mk ?? '-' }} || SMT {{ $jadwal->jadwal_matakuliah->semester ?? '-' }}</td>
                            <td>{{ $jadwal->dosen->nama_dosen ?? 'Dosen Tidak Ditemukan' }}{{ $jadwal->dosen->gelar_belakang }}</td>
                            <td>{{ $jadwal->jadwal_kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $jadwal->jadwal_ruangan->nama_ruangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <form id="">
        <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi->kode_prodi ?? '-'}}">
    </form>

    <!-- Modal -->
    <div class="modal fade" id="buatJadwalModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Buat Jadwal Prodi {{$prodi->nama_prodi ?? '-'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="simpanForm">
                        <input type="hidden" id="jadwal_id" name="jadwal_id" value="">
                        <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi->kode_prodi ?? '-'}}">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun_aktif->kode}}">

                        <div class="form-group">
                            <label for="prodi_id">Dosen</label>
                            <select class="custom-select rounded-0 select2"  id="nidn" name="nidn" required  data-placeholder="Pilih Dosen" style="width: 100%;">
                                <option value="" disabled selected>--Pilih Dosen--</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nidn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Matakuliah</label>
                            <select class="custom-select rounded-0 select2" id="matakuliah_id" name="matakuliah_id" required data-placeholder="Pilih Matakuliah" style="width: 100%;">
                                <option value="" disabled selected>--Pilih Matakuliah--</option>
                                @foreach ($matakuliah as $matkul)
                                    <option value="{{ $matkul->kode_mk }}" {{ old('matakuliah_id') == $matkul->kode_mk ? 'selected' : '' }}>
                                        {{ $matkul->nama_mk }} | {{ $matkul->kurikulum->nama_kurikulum }}
                                    </option>
                                @endforeach
                            </select>
                            @error('matakuliah_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Kelas Mahasiswa</label>
                            <select class="custom-select rounded-0" id="kelas_id" name="kelas_id" required>
                                <option value="" disabled selected>--Pilih Kelas--</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>
                                        {{ $kls->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Ruangan</label>
                            <select class="custom-select rounded-0" id="ruangan_id" name="ruangan_id" required>
                                <option value="" disabled selected>--Pilih Ruangan--</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama_ruangan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ruangan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Hari</label>
                            <select class="custom-select rounded-0" id="hari" name="hari" required>
                                <option value="" disabled selected>--Pilih Hari--</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
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
                                           value="{{ old('jam_awal') }}" required>

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
                                           value="{{ old('jam_akhir') }}" required>
                                    @error('jam_akhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Lebih dari satu dosen</label><br>
                            <input type="checkbox" name="status" id="status" value="1">
                            <label for="status">Ya</label>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="saveChanges">Buat Jadwal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inisialisasi Select2 saat modal ditampilkan
            $('#buatJadwalModal').on('shown.bs.modal', function () {
                $('.select2').select2({
                    width: '100%',
                    dropdownParent: $('#buatJadwalModal') // Dropdown Select2 tetap dalam modal
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            const table = $('#tabel5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('get.jadwal') }}",
                    type: "GET",
                    data: function (d) {
                        d.tahun = $('#filterTahun').val();
                        d.prodi = $('#prodi_id').val();
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    // { data: 'id', name: 'id' },
                    { data: 'hari', name: 'hari' },
                    { data: 'jam', name: 'jam' },
                    { data: 'matakuliah', name: 'jadwal_matakuliah.nama_mk'},
                    { data: 'semester', name: 'jadwal_matakuliah.semester'},
                    { data: 'dosen_gelar', name: 'dosen.nama_dosen' },
                    { data: 'kelas', name: 'jadwal_kelas.nama_kelas' },
                    { data: 'ruangan', name: 'jadwal_ruangan.nama_ruangan' },
                ]
            });

            // Refresh table data on filter change
            $('#filterTahun').on('change', function () {
                table.ajax.reload();
            });
        });
    </script>




    <script>

        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();

            const kelasDropdown = document.getElementById('kelas_id');
            const ruanganDropdown = document.getElementById('ruangan_id');
            const matkulDropdown = document.getElementById('matakuliah_id');
            const jadwalIdField = document.getElementById('jadwal_id');
            const prodiId = document.getElementById('prodi_id');

            $('#status').prop('disabled', true);

            const id = $(this).data('id'); // Ambil ID jadwal dari tombol yang diklik
            if (!id) {
                console.error('ID jadwal tidak ditemukan.');
                return;
            }

            //console.log('ID Jadwal:', id); // Debugging ID

            // Lakukan fetch untuk mendapatkan data jadwal
            fetch(`/dashboard/data-jadwal/${id}/edit`)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data');
                    return response.json();
                })
                .then(data => {
                    // Update data di modal
                    $('#nidn').val(data.nidn);
                    $('#hari').val(data.hari);

                    $('#jam_awal').val(data.jam_awal || '');
                    $('#jam_akhir').val(data.jam_akhir || '');

                    $('#kelas_id').val(data.kelas_id);
                    $('#ruangan_id').val(data.ruangan_id);
                    $('#matakuliah_id').val(data.matakuliah_id);

                    jadwalIdField.value = id;
                    //console.log(jadwalIdField);

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data.');
                });
        });

        document.addEventListener('DOMContentLoaded', () => {
           // const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));


            document.getElementById('saveChanges').addEventListener('click', () => {
                const form = document.getElementById('simpanForm');
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                const jadwalId = formData.get('jadwal_id'); // Ambil jadwal_id
                const url = `/dashboard/data-jadwal/${jadwalId}`

                if(jadwalId){
                    formData.append('_method', 'PUT');
                    console.log('edit dta');
                }else{
                    console.log('tambah dta');
                }

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                    .then(response => {
                        if (!response.ok) {
                            throw response; // Lempar error jika respons tidak OK
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success,
                        }).then(() => {
                            //location.reload(); // Reload halaman
                            //table.ajax.reload();
                        });
                    })
                    .catch(async error => {
                        if (error.status === 422) {
                            const errorData = await error.json();
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
                            console.error('Error:', error);
                        }
                    });
            });

            document.querySelectorAll('.btn-jadwal').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const jadwalIdField = document.getElementById('jadwal_id');
                    const id = button.getAttribute('data-id'); // Ambil ID prodi
                    console.log(`Memuat data untuk prodi dengan ID: ${id}`); // Debugging
                    $('#status').prop('disabled', false);

                    jadwalIdField.value = '';
                    //console.log(jadwalIdField);
                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));
                    modal.show();

                });
            });

        });

        document.querySelector('#tabel5').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();

                const button = e.target.closest('.btn-hapus');
                const id = button.getAttribute('data-id');

                //console.log(id);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus data jadwal kuliah??',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/data-jadwal/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'error') {
                                    Swal.fire('Error!', data.message, 'error');
                                } else {
                                    Swal.fire('Berhasil!', data.message, 'success')
                                        .then(() => location.reload());
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                            });
                    }
                });
            }
        });

    </script>


@endsection()





