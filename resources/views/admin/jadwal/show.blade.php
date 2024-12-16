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
                        <option value="{{ $tahun->id ?? '-' }}-{{ $prodi->kode_prodi ?? '-' }}">{{ $tahun->tahun_akademik }}</option>
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
           data-id="{{ $prodi->kode_prodi ?? '-' }}">
            <span data-feather="plus"></span>Buat Jadwal Kuliah</a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Jadwal Kuliah Prodi {{ $prodi->nama_prodi ?? '-' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tablePembayaran" class="table table-bordered table-striped">
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
                        <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi->kode_prodi ?? '-'}}">
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

            document.body.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-edit')) {
                    event.preventDefault();

                    const button = event.target; // Tombol yang diklik
                    const id = button.getAttribute('data-id'); // Ambil ID jadwal
                    jadwalIdField.value = id;
                    const id_prodi = prodiId.value;

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
                                    option.textContent = `${matkul.nama_mk} | SMT ${matkul.semester} | SKS ${matkul.sks_teori}`;
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
                                    option.textContent = `${ruangan.nama_ruangan} | Lantai ${ruangan.lantai}`;
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

                    // Lakukan fetch dan update dropdown, serta tampilkan modal
                    fetch(`/dashboard/data-jadwal/${id}/edit`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
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
                }
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
                                    option.textContent = `${matkul.nama_mk} | SMT ${matkul.semester} | SKS ${matkul.sks_teori}`;
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
                                    option.textContent = `${ruangan.nama_ruangan} | Lantai ${ruangan.lantai}`;
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

                // Tambahkan metode PUT secara eksplisit


                const jadwalId = formData.get('jadwal_id'); // Ambil jadwal_id
                const url = `/dashboard/data-jadwal/${jadwalId}`

                if(jadwalId){
                    formData.append('_method', 'PUT');
                    console.log('edit dta');
                }else{
                    console.log('tambah dta');
                }

                fetch(url, {
                    method: 'POST', // Ganti dengan POST
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response:', data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success,
                        }).then(() => {
                            location.reload(); // Reload halaman
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
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

        function rebindDeleteButtons() {
            document.querySelectorAll('.btn-hapus').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const id = button.getAttribute('data-id'); // Ambil ID prodi
                    console.log(`Memuat data untuk jadwal dengan ID: ${id}`); // Debugging

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    // Tampilkan dialog konfirmasi SweetAlert
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Anda yakin menghapus data jadwal kuliah?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengonfirmasi, lakukan penghapusan
                            fetch(`/dashboard/data-jadwal/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'error') {
                                        Swal.fire('Error!', data.message, 'error'); // Tampilkan pesan error
                                    } else {
                                        Swal.fire('Berhasil!', data.message, 'success'); // Tampilkan pesan sukses

                                        location.reload(); // Reload halaman setelah SweetAlert ditutup

                                    }
                                })
                                .catch(error => {
                                    console.error('Gagal menghapus data jadwal kuliah:', error);
                                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                                });
                        }
                    });
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            //const filterProdi = document.getElementById('filterProdi');
            const filterTahun = document.getElementById('filterTahun');
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                const id = filterTahun.value;
                const [id_tahun, id_prodi] = id.split('-');
                const tahun = id_tahun;
                const prodi = id_prodi;


                fetch(`/dashboard/jadwal-kls/filter-data?tahun=${tahun}&prodi=${prodi}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        console.log(data);
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                `
                                <a href="/dashboard/data-jadwal/${item.id}/{{ $prodi->kode_prodi ?? '-' }}"
                                   class="btn btn-warning btn-edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#buatJadwalModal"
                                   data-id="${item.id}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href=""
                                   class="btn btn-danger btn-hapus"

                                   data-id="${item.id}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                `,
                                index + 1,
                                item.hari,
                                item.jam || '-',
                                item.matakuliah || '-',
                                item.dosen || '-',
                                item.kelas || '-',
                                item.ruangan || '-'
                            ]);
                        });

                        // Redraw table

                        dataTable.draw();
                        rebindDeleteButtons();
                    });
            }

            rebindDeleteButtons();

            filterTahun.addEventListener('change', fetchFilteredData);
            ///filterProdi.addEventListener('change', fetchFilteredData);
        });


    </script>


@endsection()

{{--// document.querySelectorAll('.btn-edit').forEach(button => {--}}
{{--//     button.addEventListener('click', (e) => {--}}
{{--//         e.preventDefault();--}}
{{--//--}}
{{--//         const id = button.getAttribute('data-id'); // Ambil ID jadwal--}}
{{--//         jadwalIdField.value = id;--}}
{{--//         const id_prodi = prodiId.value;--}}
{{--//--}}
{{--//         // Fetch data kelas dan ruangan berdasarkan ID prodi--}}
{{--//         fetch(`/dashboard/data-jadwal-kuliah/${id_prodi}`)--}}
{{--//             .then(response => {--}}
{{--//                 if (!response.ok) throw new Error('Gagal memuat data');--}}
{{--//                 return response.json();--}}
{{--//             })--}}
{{--//             .then(data => {--}}
{{--//                 // Isi dropdown Kelas--}}
{{--//                 if (data.kelas && data.kelas.length > 0) {--}}
{{--//                     data.kelas.forEach(kelas => {--}}
{{--//                         const option = document.createElement('option');--}}
{{--//                         option.value = kelas.id;--}}
{{--//                         option.textContent = `${kelas.nama_kelas} | ${kelas.program}`;--}}
{{--//                         kelasDropdown.appendChild(option);--}}
{{--//                     });--}}
{{--//                 } else {--}}
{{--//                     const option = document.createElement('option');--}}
{{--//                     option.value = "";--}}
{{--//                     option.textContent = "Tidak ada kelas tersedia";--}}
{{--//                     kelasDropdown.appendChild(option);--}}
{{--//                 }--}}
{{--//--}}
{{--//                 if (data.matkul && data.matkul.length > 0) {--}}
{{--//                     data.matkul.forEach(matkul => {--}}
{{--//                         const option = document.createElement('option');--}}
{{--//                         option.value = matkul.id;--}}
{{--//                         option.textContent = `${matkul.nama_mk} | ${matkul.semester} | ${matkul.sks_teori}`;--}}
{{--//                         matkulDropdown.appendChild(option);--}}
{{--//                     });--}}
{{--//                 } else {--}}
{{--//                     const option = document.createElement('option');--}}
{{--//                     option.value = "";--}}
{{--//                     option.textContent = "Tidak ada matakuliah tersedia";--}}
{{--//                     matkulDropdown.appendChild(option);--}}
{{--//                 }--}}
{{--//--}}
{{--//                 // Isi dropdown Ruangan--}}
{{--//                 if (data.ruangan && data.ruangan.length > 0) {--}}
{{--//                     data.ruangan.forEach(ruangan => {--}}
{{--//                         const option = document.createElement('option');--}}
{{--//                         option.value = ruangan.id;--}}
{{--//                         option.textContent = `${ruangan.nama_ruangan} | ${ruangan.gedung}`;--}}
{{--//                         ruanganDropdown.appendChild(option);--}}
{{--//                     });--}}
{{--//                 } else {--}}
{{--//                     const option = document.createElement('option');--}}
{{--//                     option.value = "";--}}
{{--//                     option.textContent = "Tidak ada ruangan tersedia";--}}
{{--//                     ruanganDropdown.appendChild(option);--}}
{{--//                 }--}}
{{--//             })--}}
{{--//             .catch(error => {--}}
{{--//                 console.error('Error:', error);--}}
{{--//                 alert('Gagal memuat data');--}}
{{--//             });--}}
{{--//--}}
{{--//         fetch(`/dashboard/data-jadwal/${id}/edit`)--}}
{{--//             .then(response => {--}}
{{--//                 if (!response.ok) throw new Error('Gagal memuat data');--}}
{{--//                 return response.json();--}}
{{--//             })--}}
{{--//             .then(data => {--}}
{{--//                 // Isi dropdown dan field dengan data yang diterima--}}
{{--//                 document.getElementById('nidn').value = data.nidn;--}}
{{--//                 document.getElementById('hari').value = data.hari;--}}
{{--//--}}
{{--//                 if (data.jam_awal && data.jam_akhir) {--}}
{{--//                     document.getElementById('jam_awal').value = data.jam_awal;--}}
{{--//                     document.getElementById('jam_akhir').value = data.jam_akhir;--}}
{{--//                 } else {--}}
{{--//                     document.getElementById('jam_awal').value = '';--}}
{{--//                     document.getElementById('jam_akhir').value = '';--}}
{{--//                 }--}}
{{--//--}}
{{--//                 kelasDropdown.value = data.kelas_id;--}}
{{--//                 ruanganDropdown.value = data.ruangan_id;--}}
{{--//                 matkulDropdown.value = data.matakuliah_id;--}}
{{--//--}}
{{--//                 modal.show();--}}
{{--//             })--}}
{{--//             .catch(error => {--}}
{{--//                 console.error('Error:', error);--}}
{{--//                 alert('Gagal memuat data');--}}
{{--//             });--}}
{{--//     });--}}
{{--// });--}}



