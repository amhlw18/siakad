@extends('layouts.main')

@section('title')
    Data Mahasiswa
@endsection()


@section('mainmenu')
    Data Mahasiswa
@endsection()

@section('menu')
    Data Mahasiswa
@endsection()

@section('submenu')
    Master Data Mahasiswa
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
        <a href="/dashboard/data-mahasiswa/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Mahasiswa</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
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
                    <div class="col-md-6">
                        <label for="filterAngkatan">Filter Angkatan:</label>
                        <select id="filterAngkatan" class="form-control">
                            <option value="">-- Semua Angkatan --</option>

                        </select>
                    </div>
                </div>
                <table id="tabel5" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama </th>
{{--                        <th>Prodi</th>--}}
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No HP </th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <form action="/dashboard/data-mahasiswa/{{ $mhs->nim }}" class="inline-block"
                                      method="post">
                                    @method('DELETE')
                                    @csrf

                                    <a href="/dashboard/data-mahasiswa/{{ $mhs->nim }}/edit"
                                       class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                    <button class="btn btn-danger"
                                            onclick="return confirm('Yakin akan menghapus mahasiswa {{ $mhs->nama_mhs }} ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama_mhs}}</td>
{{--                            <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-'}}</td>--}}
                            <td>{{ $mhs->tempat_lahir }}</td>
                            <td>{{ $mhs->tgl_lahir }}</td>
                            <td>{{ $mhs->no_hp}}</td>
                            <td>{{ $mhs->status }}</td>
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
                    url: "{{ route('mhs.filter') }}",
                    type: "GET",
                    data: function (d) {
                        d.prodi = $('#filterProdi').val();
                        d.angkatan = $('#filterAngkatan').val();
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nim', name: 'nim' },
                    { data: 'nama_mhs', name: 'nama_mhs' },
                    // { data: 'nama_prodi', name: 'nama_prodi' },
                    { data: 'tempat_lahir', name: 'tempat_lahir' },
                    { data: 'tgl_lahir', name: 'tgl_lahir' },
                    { data: 'no_hp', name: 'no_hp' },
                    { data: 'status', name: 'status' },
                ]
            });

            // Refresh DataTables on filter change
            $('#filterProdi, #filterAngkatan').on('change', function () {
                $('#tabel5').DataTable().ajax.reload();
            });
        });

    </script>

    <script>
        // Mendapatkan elemen select
        const selectTahun = document.getElementById('filterAngkatan');

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
