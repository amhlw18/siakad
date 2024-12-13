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
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterTahun">Tahun Akademik</label>
                <select id="filterTahun" class="form-control">
                    <option value="">Semua Tahun Akademik</option>
                    @foreach ($tahun_akademik as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->tahun_akademik }}</option>
                    @endforeach
                </select>
            </div>
        </div>

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
           data-id="{{ $prodi->kode_prodi }}">
            <span data-feather="plus"></span>Buat Jadwal Kuliah</a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Jadwal Kuliah Prodi {{ $prodi->nama_prodi ?? '-' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam </th>
                        <th>Mata Kuliah</th>
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
                                   data-id="{{ $jadwal->id }}-{{ $prodi->kode_prodi }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="#"
                                   class="btn btn-danger btn-edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#buatJadwalModal"
                                   data-id="{{ $jadwal->id }}">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->jam }}</td>
                            <td>{{ $jadwal->jadwal_matakuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $jadwal->dosen->nama_dosen ?? 'Dosen Tidak Ditemukan' }}</td>
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
                        <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi->kode_prodi}}">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun_aktif->id}}">

                        <div class="form-group">
                            <label for="prodi_id">Dosen</label>
                            <select class="custom-select rounded-0" id="nidn" name="nidn" required>
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
                            <select class="custom-select rounded-0" id="matakuliah_id" name="matakuliah_id" required>

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


                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Buat Jadwal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));
            const kelasDropdown = document.getElementById('kelas_id');
            const ruanganDropdown = document.getElementById('ruangan_id');
            const matkulDropdown = document.getElementById('matakuliah_id');
            const jadwalIdField = document.getElementById('jadwal_id');
            const prodiId = document.getElementById('prodi_id');

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const id = button.getAttribute('data-id'); // Ambil ID jadwal
                    const [id_jadwal, id_prodi] = id.split('-');
                    jadwalIdField.value = id_jadwal; // Set ID jadwal di input hidden
                    prodiId.value = id_prodi;

                    // Fetch data kelas dan ruangan berdasarkan ID prodi
                    fetch(`/dashboard/data-jadwal-kuliah/${id_prodi}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            // Isi dropdown Kelas
                            if (data.kelas && data.kelas.length > 0) {
                                data.kelas.forEach(kelas => {
                                    const option = document.createElement('option');
                                    option.value = kelas.id;
                                    option.textContent = `${kelas.nama_kelas} | ${kelas.program}`;
                                    kelasDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada kelas tersedia";
                                kelasDropdown.appendChild(option);
                            }

                            if (data.matkul && data.matkul.length > 0) {
                                data.matkul.forEach(matkul => {
                                    const option = document.createElement('option');
                                    option.value = matkul.id;
                                    option.textContent = `${matkul.nama_mk} | ${matkul.semester} | ${matkul.sks_teori}`;
                                    matkulDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada matakuliah tersedia";
                                matkulDropdown.appendChild(option);
                            }

                            // Isi dropdown Ruangan
                            if (data.ruangan && data.ruangan.length > 0) {
                                data.ruangan.forEach(ruangan => {
                                    const option = document.createElement('option');
                                    option.value = ruangan.id;
                                    option.textContent = `${ruangan.nama_ruangan} | ${ruangan.gedung}`;
                                    ruanganDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada ruangan tersedia";
                                ruanganDropdown.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data');
                        });

                    fetch(`/dashboard/data-jadwal/${id_jadwal}/edit`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            // Isi dropdown dan field dengan data yang diterima
                            document.getElementById('nidn').value = data.nidn;
                            document.getElementById('hari').value = data.hari;

                            if (data.jam_awal && data.jam_akhir) {
                                document.getElementById('jam_awal').value = data.jam_awal;
                                document.getElementById('jam_akhir').value = data.jam_akhir;
                            } else {
                                document.getElementById('jam_awal').value = '';
                                document.getElementById('jam_akhir').value = '';
                            }

                            kelasDropdown.value = data.kelas_id;
                            ruanganDropdown.value = data.ruangan_id;
                            matkulDropdown.value = data.matakuliah_id;

                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data');
                        });
                });
            });

            document.querySelectorAll('.btn-jadwal').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const id = button.getAttribute('data-id'); // Ambil ID prodi
                    console.log(`Memuat data untuk prodi dengan ID: ${id}`); // Debugging

                    // Bersihkan dropdown sebelumnya
                    kelasDropdown.innerHTML = '<option value="" disabled selected>--Pilih Kelas Mahasiswa--</option>';
                    ruanganDropdown.innerHTML = '<option value="" disabled selected>--Pilih Ruangan--</option>';
                    matkulDropdown.innerHTML = '<option value="" disabled selected>--Pilih Matakuliah--</option>';

                    // Tampilkan modal
                    modal.show();

                    // Fetch data kelas dan ruangan berdasarkan ID prodi
                    fetch(`/dashboard/data-jadwal-kuliah/${id}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            // Isi dropdown Kelas
                            if (data.kelas && data.kelas.length > 0) {
                                data.kelas.forEach(kelas => {
                                    const option = document.createElement('option');
                                    option.value = kelas.id;
                                    option.textContent = `${kelas.nama_kelas} | ${kelas.program}`;
                                    kelasDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada kelas tersedia";
                                kelasDropdown.appendChild(option);
                            }

                            if (data.matkul && data.matkul.length > 0) {
                                data.matkul.forEach(matkul => {
                                    const option = document.createElement('option');
                                    option.value = matkul.id;
                                    option.textContent = `${matkul.nama_mk} | ${matkul.semester} | ${matkul.sks_teori}`;
                                    matkulDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada matakuliah tersedia";
                                matkulDropdown.appendChild(option);
                            }

                            // Isi dropdown Ruangan
                            if (data.ruangan && data.ruangan.length > 0) {
                                data.ruangan.forEach(ruangan => {
                                    const option = document.createElement('option');
                                    option.value = ruangan.id;
                                    option.textContent = `${ruangan.nama_ruangan} | ${ruangan.gedung}`;
                                    ruanganDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.textContent = "Tidak ada ruangan tersedia";
                                ruanganDropdown.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data');
                        });
                });
            });

            document.getElementById('saveChanges').addEventListener('click', () => {
                const form = document.getElementById('simpanForm');
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Ambil nilai `jadwal_id` dari form
                const jadwalIdField = document.getElementById('jadwal_id');
                const jadwalId = jadwalIdField.value;

                const method = jadwalId ? 'PUT' : 'POST'; // PUT jika edit, POST jika tambah
                const url = jadwalId ? `/dashboard/data-jadwal/${jadwalId}` : '/dashboard/data-jadwal';

                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw data; // Lempar error ke catch
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success,
                        }).then(() => {
                            location.reload(); // Reload halaman setelah SweetAlert ditutup
                        });
                    })
                    .catch(error => {
                        if (error.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: error.error,
                            });
                        } else if (error.errors) {
                            let errorMessages = '';
                            Object.keys(error.errors).forEach(key => {
                                errorMessages += `<li>${error.errors[key].join(', ')}</li>`;
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Error Validasi!',
                                html: `<ul>${errorMessages}</ul>`,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Silakan coba lagi nanti.',
                            });
                        }
                    });
            });

        });
    </script>


@endsection()

{{--// document.addEventListener('DOMContentLoaded', () => {--}}
{{--//     const filterProdi = document.getElementById('filterProdi');--}}
{{--//     const filterTahun = document.getElementById('filterTahun');--}}
{{--//     const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables--}}
{{--//--}}
{{--//     // Inisialisasi DataTables--}}
{{--//     let dataTable = tablePembayaran.DataTable();--}}
{{--//--}}
{{--//     function fetchFilteredData() {--}}
{{--//         const tahun = filterTahun.value;--}}
{{--//         const prodi = filterProdi.value;--}}
{{--//--}}
{{--//--}}
{{--//         fetch(`/dashboard/kelas-mahasiswa/filter?tahun=${tahun}&prodi=${prodi}`)--}}
{{--//             .then(response => response.json())--}}
{{--//             .then(data => {--}}
{{--//                 // Clear existing table data--}}
{{--//                 //console.log(data);--}}
{{--//                 dataTable.clear();--}}
{{--//--}}
{{--//                 // Add new rows--}}
{{--//                 data.forEach((item, index) => {--}}
{{--//                     dataTable.row.add([--}}
{{--//                         index + 1,--}}
{{--//                         item.nim,--}}
{{--//                         item.nama_mhs || '-',--}}
{{--//                         item.program || '-',--}}
{{--//                         item.tahun_masuk || '-'--}}
{{--//                     ]);--}}
{{--//                 });--}}
{{--//--}}
{{--//                 // Redraw table--}}
{{--//                 dataTable.draw();--}}
{{--//             });--}}
{{--//     }--}}
{{--//--}}
{{--//     filterTahun.addEventListener('change', fetchFilteredData);--}}
{{--//     filterProdi.addEventListener('change', fetchFilteredData);--}}
{{--// });--}}
{{--//--}}
{{--// document.getElementById('btnReset').addEventListener('click', () => {--}}
{{--//     const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables--}}
{{--//     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;--}}
{{--//     let dataTable = tablePembayaran.DataTable();--}}
{{--//--}}
{{--//     // Tampilkan dialog konfirmasi SweetAlert--}}
{{--//     Swal.fire({--}}
{{--//         title: 'Apakah Anda yakin?',--}}
{{--//         text: 'Semua data kelas mahasiswa akan dihapus!',--}}
{{--//         icon: 'warning',--}}
{{--//         showCancelButton: true,--}}
{{--//         confirmButtonColor: '#3085d6',--}}
{{--//         cancelButtonColor: '#d33',--}}
{{--//         confirmButtonText: 'Ya, hapus!',--}}
{{--//         cancelButtonText: 'Batal',--}}
{{--//     }).then((result) => {--}}
{{--//         if (result.isConfirmed) {--}}
{{--//             // Jika pengguna mengonfirmasi, lakukan penghapusan--}}
{{--//             fetch(`/dashboard/kelas-mahasiswa/delete-all`, {--}}
{{--//                 method: 'DELETE',--}}
{{--//                 headers: {--}}
{{--//                     'X-CSRF-TOKEN': csrfToken,--}}
{{--//                     'Accept': 'application/json',--}}
{{--//                 },--}}
{{--//             })--}}
{{--//                 .then(response => response.json())--}}
{{--//                 .then(data => {--}}
{{--//                     if (data.status === 'error') {--}}
{{--//                         Swal.fire('Error!', data.message, 'error'); // Tampilkan pesan error--}}
{{--//                     } else {--}}
{{--//                         Swal.fire('Berhasil!', data.message, 'success'); // Tampilkan pesan sukses--}}
{{--//--}}
{{--//                         // Kosongkan tabel DataTables--}}
{{--//                         dataTable.clear().draw();--}}
{{--//                     }--}}
{{--//                 })--}}
{{--//                 .catch(error => {--}}
{{--//                     console.error('Gagal mereset data kelas mahasiswa:', error);--}}
{{--//                     Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');--}}
{{--//                 });--}}
{{--//         }--}}
{{--//     });--}}
{{--// });--}}
