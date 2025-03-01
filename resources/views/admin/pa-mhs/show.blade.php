@extends('layouts.main')

@section('title')
    Data Penasehat Akademik
@endsection()

@section('mainmenu')
    Data Penasehat Akademik
@endsection()

@section('menu')
    Data Penasehat Akademik
@endsection()

@section('submenu')
    Master Penasehat Akademik
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

        {{--        <!-- Informasi Matakulaih -->--}}
        {{--        <div class="card mb-3">--}}
        {{--            <div class="card-body">--}}
        {{--                <p><strong>NIDN  :</strong> {{ $dosen->nidn ?? '-' }}</p>--}}
        {{--                <p><strong>Nama Dosen :</strong> {{ $dosen->nama_dosen?? '-' }}</p>--}}
        {{--                <p><strong>Tahun Akademik :</strong> {{ $tahun_aktif->tahun_akademik?? '-' }}</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Bimbingan Akademik {{$dosen->nama_dosen}}</h3>
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
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pas as $pa)
                        <tr>
                            <td>
                                <a href=""
                                   class="btn btn-danger btn-hapus"
                                   data-id="{{$pa->id}}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pa->pa_mhs->nim  }}</td>
                            <td>{{ $pa->pa_mhs->nama_mhs }}</td>
                            <td>{{ $pa->pa_mhs->tahun_masuk}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Mahasiswa Prodi {{$prodi->nama_prodi}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <a href=""
                                   class="btn btn-primary btn-tambah"
                                   data-id="{{$mhs->nim}}">
                                    Tambah
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim  }}</td>
                            <td>{{ $mhs->nama_mhs }}</td>
                            <td>{{ $mhs->tahun_masuk}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <form id="simpanForm">
            <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi->kode_prodi}}">
            <input type="hidden" id="nim" name="nim" value="">
            <input type="hidden" id="nidn" name="nidn" value="{{$dosen->nidn}}">
        </form>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script>

        document.querySelector('#tabel').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();

                const button = e.target.closest('.btn-hapus');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const nidn = document.getElementById('nidn').value;
                const tablePembayaran = $('#tabel'); // Gunakan jQuery untuk DataTables
                // Inisialisasi DataTables
                let dataTable = tablePembayaran.DataTable();

                function fetchFilteredData1() {

                    fetch(`/dashboard/pa-mhss/filter?nidn=${nidn}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear existing table data
                            //console.log(data);
                            dataTable.clear();

                            // Add new rows
                            data.forEach((item, index) => {
                                dataTable.row.add([
                                    `
                                <a href=""
                                   class="btn btn-danger btn-hapus"
                                   data-id="${item.id}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                `,
                                    index + 1,
                                    item.nim || '-',
                                    item.nama || '-',
                                    item.angkatan || '',
                                ]);
                            });

                            // Redraw table

                            dataTable.draw();
                        });
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus mahasiswa dari list PA ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/pa-mhs/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'error') {
                                    Swal.fire('Error!', data.message, 'error');
                                } else {
                                    Swal.fire('Berhasil!', data.message, 'success')
                                        .then(() => fetchFilteredData1());
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

        document.querySelector('#tabel2').addEventListener('click', (e) => {
            if (e.target.closest('.btn-tambah')) {
                e.preventDefault();

                const form = document.getElementById('simpanForm');
                const button = e.target.closest('.btn-tambah');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Set nilai 'nim' ke input hidden
                const nimInput = document.getElementById('nim');
                nimInput.value = id;

                const formData = new FormData(form);
                const nidn = document.getElementById('nidn').value;
                //console.log(nidn);

                const tablePembayaran = $('#tabel'); // Gunakan jQuery untuk DataTables

                // Inisialisasi DataTables
                let dataTable = tablePembayaran.DataTable();

                function fetchFilteredData() {

                    fetch(`/dashboard/pa-mhss/filter?nidn=${nidn}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear existing table data
                            //console.log(data);
                            dataTable.clear();

                            // Add new rows
                            data.forEach((item, index) => {
                                dataTable.row.add([
                                    `
                                <a href=""
                                   class="btn btn-danger"
                                   data-id="${item.id}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                `,
                                    index + 1,
                                    item.nim || '-',
                                    item.nama || '-',
                                    item.angkatan || '',
                                ]);
                            });

                            // Redraw table

                            dataTable.draw();
                        });
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin ingin menambahkan mahasiswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/pa-mhs`, {
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
                                    fetchFilteredData(); // Reload halaman jika diperlukan
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
                    }
                });
            }
        });

    </script>

@endsection()
