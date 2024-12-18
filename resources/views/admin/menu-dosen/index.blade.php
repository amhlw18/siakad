@extends('layouts.main')

@section('title')
    Data Aspek Penilaian
@endsection()

@section('mainmenu')
    Aspek Penilaian
@endsection()

@section('menu')
    Data Aspek Penilaian
@endsection()

@section('submenu')
    Data Aspek Penilaian
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('success'))
            <div class="alert alert-warning" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Section -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterMatkul">Matakuliah</label>
                <select id="filterMatkul" class="form-control">
                    <option value="">Semua Matakuliah</option>
                    @foreach ($matakuliah as $matkul)
                        <option value="{{ $matkul->jadwal_matakuliah->id ?? '-' }}">{{ $matkul->jadwal_matakuliah->nama_mk }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <a href="#"
           class="btn btn-primary mb-2 btn-jadwal"
           data-bs-toggle="modal"
           data-bs-target="#buatJadwalModal"
           data-id="">
            <span data-feather="plus"></span>Buat Aspek Penilaian</a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Aspek Penilaian</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tablePembayaran" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Aspek Penilaian </th>
                        <th>Bobot</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($aspeks as $aspek)
                        <tr>
                            <td>

                                <a href="#"
                                   class="btn btn-warning btn-edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#buatJadwalModal"
                                   data-id="{{ $aspek->id }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="#"
                                   class="btn btn-danger btn-hapus"
                                   data-id="{{ $aspek->id }}">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $aspek->aspek }}</td>
                            <td>{{ $aspek->bobot }}</td>

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
                    <h5 class="modal-title" id="editModalLabel">Buat Aspek Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="simpanForm">
                        <input type="text" id="aspek_id" name="aspek_id" value="">
                        <input type="hidden" id="nidn" name="nidn" value="{{ auth()->user()->user_id }}">
                        <input type="hidden" id="nama_dosen" name="nama_dosen" value="{{ auth()->user()->name }}">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="">

                        <div class="form-group">
                            <label for="">Matakuliah</label>
                            <select class="custom-select rounded-0" id="matakuliah_id" name="matakuliah_id" required>
                                <option value="" disabled selected>--Pilih Matakuliah--</option>
                                @foreach ($matakuliah as $matkul)
                                    <option value="{{ $matkul->jadwal_matakuliah->id }}" {{ old('matakuliah_id') == $matkul->jadwal_matakuliah->id ? 'selected' : '' }}>
                                        {{ $matkul->jadwal_matakuliah->nama_mk }}
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
                            <label for="nama_kelas">Aspek Penilaian</label>
                            <input type="text" name="aspek"
                                   class="form-control @error('aspek') is-invalid @enderror" id="aspek"
                                   placeholder="Aspek Penilaian" value="{{ old('aspek') }}" required>
                            @error('aspek')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_kelas">Bobot %</label>
                            <input type="text" name="bobot"
                                   class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                                   placeholder="Isi menggunakan angka desimal pasahkan dengan titik" value="{{ old('bobot') }}" required>
                            @error('bobot')
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
            const aspekId = document.getElementById('aspek_id');

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    //const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));

                    //const button = event.target; // Tombol yang diklik
                    const id = button.getAttribute('data-id'); // Ambil ID aspek
                    aspekId.value = id;

                    // Lakukan fetch dan update dropdown, serta tampilkan modal
                    fetch(`/dashboard/aspekk-nilai/${id}/edit`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('matakuliah_id').value = data.matakuliah_id;
                            document.getElementById('aspek').value = data.aspek;
                            document.getElementById('bobot').value = data.bobot;

                            modal.show();
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


                const id = document.getElementById('aspek_id');
                const aspekId = id.value; // Ambil jadwal_id
                const url = `/dashboard/aspek-nilai/${aspekId}`

                if(aspekId){
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
                        text: 'Anda yakin menghapus data aspek penilaian?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengonfirmasi, lakukan penghapusan
                            fetch(`/dashboard/aspek-nilai/${id}`, {
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

            const filterMatkul = document.getElementById('filterMatkul');
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                const matkul = filterMatkul.value;
                const nidn = {{ auth()->user()->user_id }};

                fetch(`/dashboard/aspekk-nilai/filter?matkul=${matkul}&nidn=${nidn}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        //console.log(data);
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                `
                                <a href="${item.id}"
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
                                item.aspek,
                                item.bobot || '-',
                            ]);
                        });

                        // Redraw table

                        dataTable.draw();
                        rebindDeleteButtons();
                    });
            }

            rebindDeleteButtons();

            filterMatkul.addEventListener('change', fetchFilteredData);
            ///filterProdi.addEventListener('change', fetchFilteredData);
        });


    </script>


@endsection()
