@extends('layouts.main')

@section('title')
    Transaksi Pembayaran SPP
@endsection

@section('mainmenu')
    Transaksi Pembayaran SPP
@endsection

@section('menu')
    Transaksi Pembayaran SPP
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



        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Pembayaran SPP {{$tahun}} </h3>
            </div>
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped">
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
                                <a href="#"
                                   class="btn btn-primary btn-edit"
                                   data-id="{{ $mhs->nim }}">
                                    Bayar
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

            <form id="simpanForm">
                <input type="hidden" id="nim" name="nim" value="">
                <input type="hidden" id="is_bayar" name="is_bayar" value="1">

            </form>
    </div>


    <script>
        document.querySelector('#tabel').addEventListener('click', (e) => {
            if (e.target.closest('.btn-edit')) {
                e.preventDefault();

                const form = document.getElementById('simpanForm');
                const button = e.target.closest('.btn-edit');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Set nilai 'nim' ke input hidden
                const nimInput = document.getElementById('nim');
                nimInput.value = id;

                console.log(id);

                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin memproses pembayaran SPP mahasiswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, proses!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/pembayaran`, {
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
@endsection
