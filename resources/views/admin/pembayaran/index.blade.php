@extends('layouts.main')

@section('title')
    Data Pembayaran SPP
@endsection

@section('mainmenu')
    Data Pembayaran SPP
@endsection

@section('menu')
    Data Pembayaran SPP
@endsection

@section('submenu')
    Master Data Pembayaran SPP
@endsection

@section('content')
    <div class="container-fluid">
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
                    <option value="">Semua Tahun</option>
                    @foreach ($tahun_akademiks as $tahun)
                        <option value="{{ $tahun->id }}"
                            {{ $tahun->id == $tahun_aktif_id ? 'selected' : '' }}>
                            {{ $tahun->tahun_akademik }} {{ $tahun->semester }}
                        </option>
                    @endforeach
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
                <h3 class="card-title">Master Data Pembayaran SPP</h3>
            </div>
            <div class="card-body">
                <table id="tablePembayaran" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <td>
{{--                                @if($pembayaran->tahun_akademik_pembayaran->status)--}}
{{--                                    --}}
{{--                                @endif--}}

                                    <a href="#"
                                       class="btn btn-warning btn-edit"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editModal"
                                       data-id="{{ $pembayaran->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembayaran->pembayaran_mhs->nim }}</td>
                            <td>{{ $pembayaran->pembayaran_mhs->nama_mhs ?? '-' }}</td>
                            <td>{{ $pembayaran->prodi_pembayaran->nama_prodi ?? '-' }}</td>
{{--                            <td>{{ $pembayaran->tahun_akademik_pembayaran->id }}</td>--}}
                            <td>{{ $pembayaran->is_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="editNama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="editProdi" class="form-label">Program Studi</label>
                            <select class="form-control" id="editProdi" name="prodi">
                                <!-- Options akan diisi secara dinamis -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status Pembayaran</label>
                            <select class="form-control" id="editStatus" name="status">
                                <option value="1">Lunas</option>
                                <option value="0">Belum Lunas</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterTahun = document.getElementById('filterTahun');
            const filterProdi = document.getElementById('filterProdi');
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                const tahun = filterTahun.value;
                const prodi = filterProdi.value;

                fetch(`/dashboard/data-pembayaran/filter?tahun=${tahun}&prodi=${prodi}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                `<a href="/dashboard/data-mahasiswa/${item.nim}/edit" class="btn btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>`,
                                index + 1,
                                item.nim,
                                item.nama_mhs || '-',
                                item.nama_prodi || '-',
                                item.is_bayar ? 'Lunas' : 'Belum Lunas',
                            ]);
                        });

                        // Redraw table
                        dataTable.draw();
                    });
            }

            // Panggil fetchFilteredData saat tahun akademik aktif dipilih
            if (filterTahun.value) {
                fetchFilteredData();
            }

            // Event listeners untuk filter
            filterTahun.addEventListener('change', fetchFilteredData);
            filterProdi.addEventListener('change', fetchFilteredData);
        });


    </script>
@endsection
