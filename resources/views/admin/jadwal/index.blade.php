@extends('layouts.main')

@section('title')
    Data Jadwal kuliah
@endsection()

@section('mainmenu')
    Data Jadwal Kuliah
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
{{--        <a href="/dashboard/kls-mhs/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kelas--}}
{{--            Mahasiswa</a>--}}

{{--        @if($nim)--}}
{{--            <button id="btnReset" class="btn btn-danger mb-2" ><span data-feather="plus"></span>Reset Kelas</button>--}}
{{--        @else--}}
{{--            <button id="btnReset" class="btn btn-danger mb-2"  disabled><span data-feather="plus"></span>Reset Kelas</button>--}}
{{--        @endif--}}
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
{{--                    @foreach ($prodis as $prodi)--}}
{{--                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>--}}
{{--                    @endforeach--}}
                </select>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Jadwal Kuliah</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tablePembayaran" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Prodi</th>
                        <th>Program Studi </th>
                        <th>Jenjang</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prodis as $prodi)
                        <tr>
                            <td>
                                <a href="/dashboard/pembayaran/{{$mhs->nim}}"
                                   class="btn btn-success"
                                   data-id="{{ $prodi->kode_prodi }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prodi->kode_prodi }}</td>
                            <td>{{ $prodi->nama_prodi}}</td>
                            <td>{{ $prodi->jenjang }}</td>
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
        document.addEventListener('DOMContentLoaded', () => {
            const filterProdi = document.getElementById('filterProdi');
            const filterTahun = document.getElementById('filterTahun');
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                const tahun = filterTahun.value;
                const prodi = filterProdi.value;


                fetch(`/dashboard/kelas-mahasiswa/filter?tahun=${tahun}&prodi=${prodi}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        //console.log(data);
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                index + 1,
                                item.nim,
                                item.nama_mhs || '-',
                                item.program || '-',
                                item.tahun_masuk || '-'
                            ]);
                        });

                        // Redraw table
                        dataTable.draw();
                    });
            }

            filterTahun.addEventListener('change', fetchFilteredData);
            filterProdi.addEventListener('change', fetchFilteredData);
        });

        document.getElementById('btnReset').addEventListener('click', () => {
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let dataTable = tablePembayaran.DataTable();

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
                                dataTable.clear().draw();
                            }
                        })
                        .catch(error => {
                            console.error('Gagal mereset data kelas mahasiswa:', error);
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                }
            });
        });

    </script>

@endsection()
