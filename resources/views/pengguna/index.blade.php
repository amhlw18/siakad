@extends('layouts.main')

@section('title')
    Data Pengguna
@endsection()


@section('mainmenu')
    Data Pengguna
@endsection()

@section('menu')
    Data Pengguna
@endsection()

@section('submenu')
    Master Data Pengguna
@endsection()

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    td img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .profile {
        display: flex;
        align-items: center;
    }

    .profile-info {
        margin-left: 10px;
    }

    .profile-info .last-login {
        font-size: 12px;
        color: #6c757d;
    }

    .actions {
        display: flex;
        gap: 5px;
    }

    .actions button {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    .actions button:hover {
        background-color: #e2e6ea;
    }
</style>


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
            Pengguna</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="filterProdi">Filter Pengguna:</label>
                        <select id="filterProdi" class="form-control">
                            <option value="">-- Semua Pengguna --</option>
{{--                            @foreach($prodis as $prodi)--}}
{{--                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
                </div>
                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>ID Pengguna</th>
                        <th>Nama Pengguna</th>
                        <th>Dibuat</th>
                        <th>Diakses</th>
                        <th>Hak Akses</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pengguna as $item)
                        <tr>
                            <td class="actions">
                                <button>🔑</button>
                                <button>⚙️</button>
                                <button>🗑️</button>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="profile">
                                    <img src="{{ $item->profile_picture ? asset('storage/' . $item->profile_picture) : asset('lte/dist/img/default-user-photo.png') }}" alt="User">
                                    <div class="profile-info">
                                        <span>{{ $item->user_id }}</span>
                                        <span class="last-login">{{ $item->lastLogin ?? 'Belum pernah login' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->created_at ?? '-'}}</td>
                            <td>{{ $item->last_login_at }}</td>
                            <td>
                                @if($item->role == 5)
                                    Program Studi
                                @endif
                                @if($item->role == 1)
                                    Administrator
                                @endif
                                @if($item->role == 2)
                                    Keuangan
                                @endif
                                @if($item->role == 3)
                                    Dosen
                                @endif
                                @if($item->role == 4)
                                    Mahasiswa
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#tabel5').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: {--}}
{{--                    url: "{{ route('mhs.filter') }}",--}}
{{--                    type: "GET",--}}
{{--                    data: function (d) {--}}
{{--                        d.prodi = $('#filterProdi').val();--}}
{{--                        d.angkatan = $('#filterAngkatan').val();--}}
{{--                    }--}}
{{--                },--}}
{{--                columns: [--}}
{{--                    { data: 'action', name: 'action', orderable: false, searchable: false },--}}
{{--                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },--}}
{{--                    { data: 'nim', name: 'nim' },--}}
{{--                    { data: 'nama_mhs', name: 'nama_mhs' },--}}
{{--                    { data: 'nama_prodi', name: 'nama_prodi' },--}}
{{--                    { data: 'tempat_lahir', name: 'tempat_lahir' },--}}
{{--                    { data: 'tgl_lahir', name: 'tgl_lahir' },--}}
{{--                    { data: 'no_hp', name: 'no_hp' },--}}
{{--                    { data: 'status', name: 'status' },--}}
{{--                ]--}}
{{--            });--}}

{{--            // Refresh DataTables on filter change--}}
{{--            $('#filterProdi, #filterAngkatan').on('change', function () {--}}
{{--                $('#tabel5').DataTable().ajax.reload();--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}


@endsection()
