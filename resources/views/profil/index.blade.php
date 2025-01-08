@extends('layouts.main')

@section('title')
    Profile
@endsection()

@section('mainmenu')
@endsection()

@section('menu')
    Profile
@endsection()

@section('submenu')
    Profile
@endsection()

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <label for="profilePictureInput">
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('lte/dist/img/default-user-photo.png') }}" alt="Profile Picture" class="rounded-circle"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; cursor: pointer;" id="profilePicture">
                                <p>Ganti foto</p>
                            </label>
                            <!-- Hidden File Input -->
                            <input type="file" id="profilePictureInput" accept="image/*" style="display: none;">

                            <!-- Hidden File Input -->
{{--                            <form  method="post" action="/upload-profile-photo" >--}}
{{--                                @csrf--}}
{{--                                <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*"  >--}}
{{--                                <button type="submit">submit</button>--}}
{{--                            </form>--}}

                        </div>

                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                        @if(auth()->user()->role == 1)
                            <p class="text-muted text-center">Administrator</p>
                        @endif

                        @if(auth()->user()->role == 2)
                            <p class="text-muted text-center">Bendahara</p>
                        @endif

                        @if(auth()->user()->role == 3)
                            <p class="text-muted text-center">Dosen</p>
                        @endif

                        @if(auth()->user()->role == 4)
                            <p class="text-muted text-center">Mahasiswa</p>
                        @endif

                        @if(auth()->user()->role == 5)
                            <p class="text-muted text-center">Program Studi</p>
                        @endif

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>ID Pengguna</b> <a class="float-right">{{auth()->user()->user_id}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Perangkat</b> <a class="float-right">{{ $userAgent ?? 'Tidak diketahui' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Terakhair Login</b> <a class="float-right">{{ $lastLogin ? $lastLogin->diffForHumans() : 'Belum pernah login' }}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Ganti Password</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form class="form-horizontal" id="update-profile">
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="inputEmail" value="{{auth()->user()->email}}" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <a href="#" class="btn btn-outline-success mb-2 btn-update-profil" ><span data-feather="plus"></span>Update</a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form  class="form-horizontal" id="formPassword">
{{--                                <form class="form-horizontal" id="formPassword" method="post" action="/update-password">--}}
{{--                                    @method('PUT')--}}
{{--                                    @csrf--}}
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Password Lama</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Password Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Baru">
                                        </div>
                                    </div>

{{--                                    <button type="submit">upadte</button>--}}

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <a href="#" class="btn btn-outline-success mb-2 btn-update-pwd" ><span data-feather="plus"></span>Update</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


    <script>
        document.getElementById('profilePictureInput').addEventListener('change', function(event) {
            const file = event.target.files[0];

            const maxFileSize = 1 * 1024 * 1024; // 1MB dalam byte
            if (file && file.size > maxFileSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar!',
                    text: 'Ukuran maksimal file adalah 1MB.',
                });
                return;
            }
            if (file) {
                // Tampilkan gambar preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePicture').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Kirim file ke server
                const formData = new FormData();
                formData.append('photo', file);

                fetch('/upload-profile-photo', { // Ubah URL ini sesuai dengan endpoint Laravel Anda
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan CSRF token disertakan
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // SweetAlert untuk pesan berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Foto berhasil diunggah.',
                            });
                        } else {
                            // SweetAlert untuk pesan gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message || 'Terjadi kesalahan saat mengunggah foto.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // SweetAlert untuk error jaringan atau server
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal mengunggah foto. Periksa koneksi Anda.',
                        });
                    });
            }
        });

    </script>

    <script>
        document.querySelectorAll('.btn-update-pwd').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('formPassword');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                formData.append('_method', 'PUT');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Yakin mengubah password anda?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/update-password`, {
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

    <script>
        document.querySelectorAll('.btn-update-profil').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('update-profile');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                formData.append('_method', 'PUT');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Yakin mengupdate profil anda?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/update-profile`, {
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

