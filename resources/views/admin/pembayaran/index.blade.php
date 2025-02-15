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
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Riwayat Pembayaran SPP</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="filterProdi">Filter Program Studi:</label>
                        <select id="filterProdi" class="form-control">
                            <option value="">-- Semua Prodi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table id="tabel5" class="table table-bordered table-striped">
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
                                <a href="/dashboard/pembayaran/{{ encrypt($mhs->nim) }}"
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
        $(document).ready(function () {
            $('#tabel5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bendahara-mhs.filter') }}",
                    type: "GET",
                    data: function (d) {
                        d.prodi = $('#filterProdi').val();
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nim', name: 'nim' },
                    { data: 'nama_mhs', name: 'nama_mhs' },
                    { data: 'nama_prodi', name: 'nama_prodi' },
                ]
            });

            // Refresh DataTables on filter change
            $('#filterProdi').on('change', function () {
                $('#tabel5').DataTable().ajax.reload();
            });
        });

    </script>
@endsection
