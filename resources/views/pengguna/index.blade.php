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
{{--        <a href="/dashboard/data-mahasiswa/create" class="btn btn-primary mb-2"><span data-feather="plus"></span>Tambah--}}
{{--            Pengguna</a>--}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
{{--                <div class="row mb-3">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label for="filterUser">Filter Pengguna:</label>--}}
{{--                        <select id="filterUser" class="form-control">--}}
{{--                            <option value="">-- Semua Pengguna --</option>--}}
{{--                            @foreach($role as $item)--}}
{{--                                <option value="{{ $item->id }}">--}}
{{--                                   {{$item->role}}--}}
{{--                                </option>--}}

{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
                                <a href="#" class="btn btn-outline-warning mb-2 btn-update-pwd" data-id="{{ $item->id }}">🔑</a>
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

    <form id="formPassword">
        <input type="hidden" id="id_user" value="">
    </form>

    <script>
        document.querySelectorAll('.btn-update-pwd').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('formPassword');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                const button = e.target; // Tombol yang diklik
                const id = button.getAttribute('data-id'); // Ambil ID jadwal

                const id_user = document.getElementById('id_user');
                id_user.value = id;

                formData.append('_method', 'PUT');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Yakin mereset password ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/pengguna/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: formData,
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw response; // Lempar error jika respons tidak OK
                                }
                                return response.json();
                            })
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: data.success,
                                }).then(() => {
                                    location.reload();
                                });
                            })
                            .catch(async error => {
                                if (error.status === 422) {
                                    const errorData = await error.json();
                                    let errorMessages = '';

                                    if (errorData.errors) {
                                        errorMessages = Object.values(errorData.errors).flat().join('\n');
                                    } else if (errorData.error) {
                                        errorMessages = errorData.error;
                                    }

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validasi Gagal!',
                                        text: errorMessages,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menyimpan data. Coba lagi!',
                                    });
                                    console.error('Error:', error);
                                }
                            });
                    }
                });
            });
        });
    </script>


@endsection()
