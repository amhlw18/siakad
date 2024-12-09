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

            <!-- Informasi Mahasiswa -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>NIM  :</strong> {{ $mahasiswa->nim ?? '-' }}</p>
                    <p><strong>Nama :</strong> {{ $mahasiswa->nama_mhs?? '-' }}</p>
                    <p><strong>Prodi:</strong> {{ $prodi->nama_prodi ?? '-' }}</p>
                </div>
            </div>


            {{--        <!-- Filter Section -->--}}
{{--        <div class="row mb-3">--}}
{{--            <div class="col-md-4">--}}
{{--                <label for="filterTahun">Tahun Akademik</label>--}}
{{--                <select id="filterTahun" class="form-control">--}}
{{--                    <option value="">Semua Tahun</option>--}}
{{--                    @foreach ($tahun_akademiks as $tahun)--}}
{{--                        <option value="{{ $tahun->id }}">{{ $tahun->tahun_akademik }} {{$tahun->semester}}--}}
{{--                            @if($tahun->status)--}}
{{--                                (Aktif)--}}
{{--                            @endif--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}


{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <label for="filterProdi">Program Studi</label>--}}
{{--                <select id="filterProdi" class="form-control">--}}
{{--                    <option value="">Semua Prodi</option>--}}
{{--                    @foreach ($prodis as $prodi)--}}
{{--                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Riwayat Pembayaran SPP</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Tahun Akademik</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <td>
                                <a href="/dashboard/data-mahasiswa/{{ $pembayaran->nim }}/edit" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$pembayaran->tahun_akademik_pembayaran->tahun_akademik  ?? '-'}} {{ $pembayaran->tahun_akademik_pembayaran->semester}}</td>
                            <td>{{ $pembayaran->tgl_bayar ?? '-' }}</td>
                            <td>{{ $pembayaran->is_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <script>
        // document.addEventListener('DOMContentLoaded', () => {
        //     const filterTahun = document.getElementById('filterTahun');
        //     const filterProdi = document.getElementById('filterProdi');
        //     const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables
        //
        //     // Inisialisasi DataTables
        //     let dataTable = tablePembayaran.DataTable();
        //
        //     function fetchFilteredData() {
        //         const tahun = filterTahun.value;
        //         const prodi = filterProdi.value;
        //
        //         fetch(`/dashboard/data-pembayaran/filter?tahun=${tahun}&prodi=${prodi}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 // Clear existing table data
        //                 dataTable.clear();
        //
        //                 // Add new rows
        //                 data.forEach((item, index) => {
        //                     dataTable.row.add([
        //                         `<a href="/dashboard/data-mahasiswa/${item.nim}/edit" class="btn btn-warning">
        //                     <i class="bi bi-pencil"></i>
        //                 </a>`,
        //                         index + 1,
        //                         item.nim,
        //                         item.nama_mhs || '-',
        //                         item.nama_prodi || '-',
        //                         item.is_bayar ? 'Lunas' : 'Belum Lunas',
        //                     ]);
        //                 });
        //
        //                 // Redraw table
        //                 dataTable.draw();
        //             });
        //     }
        //
        //     filterTahun.addEventListener('change', fetchFilteredData);
        //     filterProdi.addEventListener('change', fetchFilteredData);
        // });

    </script>
@endsection
