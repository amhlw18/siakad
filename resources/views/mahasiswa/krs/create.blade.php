@extends('layouts.main')

@section('title')
    Data KRS Mahasiswa
@endsection()

@section('mainmenu')
     Ambil KRS
@endsection()

@section('menu')
    KRS Mahasiswa
@endsection()

@section('submenu')
    Ambil KRS
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

{{--        <div id="pesan" class="alert alert-warning d-flex align-items-center" role="alert">--}}
{{--            <i class="fa fa-exclamation-triangle me-2"></i>--}}
{{--            - .<br>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-header">
                <h3 id="judul" class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Mata Kuliah </th>
                        <th>Semester</th>
                        <th>SKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matakuliah as $item)
                        <tr>
                            <td>
                                <a href=""
                                   class="btn btn-outline-primary btn-simpan"
                                   data-id="{{ $item->kode_mk }}">
                                    <i class="bi bi-plus"></i>
                                </a>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_mk }}</td>
                            <td>{{ $item->nama_mk}}</td>
                            <td>{{ $item->semester}}</td>
                            <td>{{ $item->total_sks}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <form id="simpanForm">
                <input type="hidden" id="nim" name="nim" value="{{$nim}}">
                <input type="hidden" id="prodi_id" name="prodi_id" value="{{$prodi_id}}">
                <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="">
            </form>
        </div>


        <script>
            document.querySelector('#tabel5').addEventListener('click', (e) => {
                if (e.target.closest('.btn-simpan')) {
                    e.preventDefault();

                    const form = document.getElementById('simpanForm');
                    const button = e.target.closest('.btn-simpan');
                    const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    // Set nilai 'nim' ke input hidden
                    const mk_id = document.getElementById('matakuliah_id');
                    mk_id.value = id;

                    // console.log(id);
                    // console.log(prodi_id);
                    // console.log(nim);

                    const formData = new FormData(form);

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Anda yakin memilih matakuliah ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, proses!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/dashboard/krs-mhs`, {
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
                                        // Reload halaman jika diperlukan
                                    });
                                })
                                .catch(async error => {
                                    if (error.status === 422) {
                                        const errorData = await error.json();
                                        const errorMessages = Object.values(errorData.errors).flat().join('\n');
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
                }
            });
        </script>

@endsection()
