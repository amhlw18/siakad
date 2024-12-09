@extends('layouts.main')

@section('title')
    Riwayat Pembayaran SPP
@endsection

@section('mainmenu')
    Riwayat Pembayaran SPP
@endsection

@section('menu')
    Riwayat Pembayaran SPP
@endsection

@section('submenu')
    Master Data Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

            <a href="/dashboard/pembayaran/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Transaksi Pembayaran SPP</a>

            <!-- Filter Section -->
            <div class="row mb-3">
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
                <h3 class="card-title">Master Data Riwayat Pembayaran SPP</h3>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <a href="/dashboard/pembayaran/{{$mhs->nim}}"
                                   class="btn btn-success"
                                   data-id="{{ $mhs->nim }}">
                                    <i class="bi bi-eye"></i>
                                </a>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama_mhs ?? '-' }}</td>
                            <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            //const filterProdi = document.getElementById('filterProdi');
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                //const tahun = filterTahun.value;
                const prodi = filterProdi.value;

                fetch(`/dashboard/data-pembayaran/filter?prodi=${prodi}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                `<a href="/dashboard/pembayaran/{{$mhs->nim}}"
                                   class="btn btn-success"
                                   data-id="{{ $mhs->nim }}">
                                    <i class="bi bi-eye"></i>
                                </a>`,
                                index + 1,
                                item.nim,
                                item.nama_mhs || '-',
                                item.nama_prodi || '-',
                            ]);
                        });

                        // Redraw table
                        dataTable.draw();
                    });
            }

            //filterTahun.addEventListener('change', fetchFilteredData);
            filterProdi.addEventListener('change', fetchFilteredData);
        });

    </script>
@endsection
