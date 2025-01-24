@extends('layouts.main')

@section('title')
    Data Kelas Mahasiswa
@endsection()


@section('mainmenu')
    Data Kelas Mahasiswa
@endsection()

@section('menu')
    Data Kelas Mahasiswa
@endsection()

@section('submenu')
    Master Data Kelas Mahasiswa
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

        @if(auth()->user()->role==1 || auth()->user()->role==6)
            <a href="/dashboard/kls-mhs/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kelas
                Mahasiswa</a>
        @endif


        @if(auth()->user()->role==1 || auth()->user()->role==6 )
            @if($nim)
                <button id="btnReset" class="btn btn-danger mb-2" ><span data-feather="plus"></span>Reset Kelas</button>
            @else
                <button id="btnReset" class="btn btn-danger mb-2"  disabled><span data-feather="plus"></span>Reset Kelas</button>
            @endif
        @endif

        <!-- Filter Section -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterTahun">Angkatan</label>
                <select id="filterTahun" class="form-control">
                    <option value="">Semua Tahun</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterProdi">Program Studi</label>
                <select id="filterProdi" class="form-control">
                    <option value="">Semua Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Kelas Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
                        <th>Prodi</th>
                        <th>Kelas</th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <a href=""
                                   class="btn btn-danger btn-hapus"
                                   data-id="{{$mhs->id}}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->nama_mhs ?? '-'}}</td>
                            <td>{{ $mhs->prodi_kelas_mhs->nama_prodi ?? '-'}}</td>
                            <td>{{ $mhs->kelas_mahasiswa->nama_kelas ?? '-' }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->tahun_masuk ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script>
        $(document).ready(function () {
            $('#tabel5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kelas-mhs.filter') }}",
                    type: "GET",
                    data: function (d) {
                        d.prodi = $('#filterProdi').val();
                        d.tahun = $('#filterTahun').val();


                        //console.log(prodi_id);
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nim', name: 'nim' },
                    { data: 'nama_mhs', name: 'mhs_kelas_mhs.nama_mhs' },
                    { data: 'nama_prodi', name: 'prodi_kelas_mhs.nama_prodi' },
                    { data: 'nama_kelas', name: 'kelas_mahasiswa.nama_kelas' },
                    { data: 'tahun_masuk', name: 'mhs_kelas_mhs.tahun_masuk' },

                ]
            });

            // Refresh DataTables on filter change
            $('#filterProdi,#filterTahun').on('change', function () {
                $('#tabel5').DataTable().ajax.reload();

            });
        });

    </script>

    <script>
        @if(auth()->user()->role == 1)
        document.getElementById('btnReset').addEventListener('click', () => {
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;


            // Tampilkan dialog konfirmasi SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Semua data kelas mahasiswa akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, lakukan penghapusan
                    fetch(`/dashboard/kelas-mahasiswa/delete-all`, {
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

                                // Kosongkan tabel DataTables
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Gagal mereset data kelas mahasiswa:', error);
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                }
            });
        });
        @endif


        document.querySelector('#tabel5').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();

                const button = e.target.closest('.btn-hapus');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus mahasiswa dari kelas ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/kls-mhs/${id}`, {
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


    <script>
        // Mendapatkan elemen select
        const selectTahun = document.getElementById('filterTahun');

        // Tahun mulai
        const startYear = 2020;

        // Tahun saat ini
        const currentYear = new Date().getFullYear();

        // Loop untuk menambahkan opsi tahun
        for (let year = startYear; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            selectTahun.appendChild(option);
        }
    </script>
@endsection()
