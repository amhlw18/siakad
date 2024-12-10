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
        <a href="/dashboard/kls-mhs/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah Kelas
            Mahasiswa</a>

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
                <h3 class="card-title">Master Data Kelas Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tablePembayaran" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
{{--                        <th>#</th>--}}
                        <th>NIM</th>
                        <th>Nama </th>
{{--                        <th>Prodi</th>--}}
                        <th>Kelas</th>
                        <th>Angkatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
{{--                            <td>--}}
{{--                                <form action="/dashboard/kelas-mhs/{{ $mhs->nim }}" class="inline-block"--}}
{{--                                      method="post">--}}
{{--                                    @method('DELETE')--}}
{{--                                    @csrf--}}

{{--                                    <button class="btn btn-danger"--}}
{{--                                            onclick="return confirm('Yakin akan menghapus mahasiswa {{ $mhs->nama_mhs }} ?')"><i class="bi bi-trash"></i></button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->nama_mhs}}</td>
{{--                            <td>{{ $mhs->prodi_kelas_mhs->nama_prodi}}</td>--}}
                            <td>{{ $mhs->kelas_mahasiswa->program }}</td>
                            <td>{{ $mhs->mhs_kelas_mhs->tahun_masuk }}</td>
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
            const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables

            // Inisialisasi DataTables
            let dataTable = tablePembayaran.DataTable();

            function fetchFilteredData() {
                //const tahun = filterTahun.value;
                const prodi = filterProdi.value;

                fetch(`/dashboard/kls-mhs/filter?prodi=${prodi}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing table data
                        dataTable.clear();

                        // Add new rows
                        data.forEach((item, index) => {
                            dataTable.row.add([
                                {{--`<a href="/dashboard/pembayaran/{{$mhs->nim}}"--}}
                                {{--   class="btn btn-success"--}}
                                {{--   data-id="{{ $mhs->nim }}">--}}
                                {{--    <i class="bi bi-eye"></i>--}}
                                {{--</a>`,--}}
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

            //filterTahun.addEventListener('change', fetchFilteredData);
            filterProdi.addEventListener('change', fetchFilteredData);
        });

    </script>
@endsection()
