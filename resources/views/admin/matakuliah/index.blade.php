@extends('layouts.main')

@section('title')
    Data Matakuliah
@endsection()


@section('mainmenu')
    Data Matakuliah
@endsection()

@section('menu')
    Matakuliah
@endsection()

@section('submenu')
    Master Data Matakuliah
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
        <a href="/dashboard/matakuliah/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah
            Matakuliah</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Matakuliah</h3>
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
                        <label for="filterKurikulum">Filter Kurikulum:</label>
                        <select id="filterKurikulum" class="form-control">
                            <option value="">-- Semua Kurikulum --</option>
                            @foreach($kurikulums as $kurikulum)
                                <option value="{{ $kurikulum->kode_kurikulum }}">{{ $kurikulum->nama_kurikulum }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table id="tabel5" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Matakuliah </th>
                            <th>Jenis</th>
                            <th>SKS T</th>
                            <th>SKS P</th>
                            <th>SKS L</th>
                        </tr>
                    </thead>
                    <tbody id="tabelBody">
                        @foreach ($matkuls as $matkul)
                            <tr>
                                <td>

                                    <form action="/dashboard/matakuliah/{{ $matkul->kode_mk }}" class="inline-block"
                                          method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a href="/dashboard/matakuliah/{{ $matkul->kode_mk }}/edit"
                                           class="btn btn-warning"><i class="bi bi-pencil"></i></a>

                                        <button class="btn btn-danger"
                                                onclick="return confirm('Yakin akan menghapus matakuliah {{ $matkul->kode_mk }} ?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $matkul->kode_mk }}</td>
                                <td>{{ $matkul->nama_mk }}</td>
                                <td>{{ $matkul->jenis_mk }} </td>
                                <td>{{ $matkul->sks_teori }}</td>
                                <td>{{ $matkul->sks_praktek }}</td>
                                <td>{{ $matkul->sks_lapangan }} </td>

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
                    url: "{{ route('matakuliah.filter') }}",
                    type: "GET",
                    data: function (d) {
                        d.prodi = $('#filterProdi').val();
                        d.kurikulum = $('#filterKurikulum').val();
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'kode_mk', name: 'kode_mk' },
                    { data: 'nama_mk', name: 'nama_mk' },
                    { data: 'jenis_mk', name: 'jenis_mk' },
                    { data: 'sks_teori', name: 'sks_teori' },
                    { data: 'sks_praktek', name: 'sks_praktek' },
                    { data: 'sks_lapangan', name: 'sks_lapangan' },
                ]
            });

            // Refresh DataTables on filter change
            $('#filterProdi, #filterKurikulum').on('change', function () {
                $('#tabel5').DataTable().ajax.reload();
            });
        });

    </script>



@endsection()
