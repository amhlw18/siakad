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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Data Riwayat Pembayaran SPP</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                                <a href="/dashboard/pembayaran/{{$mhs->nim}}"
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
        // document.addEventListener('DOMContentLoaded', () => {
        //     const modal = new bootstrap.Modal(document.getElementById('editModal'));
        //
        //     document.querySelectorAll('.btn-edit').forEach(button => {
        //         button.addEventListener('click', (e) => {
        //             e.preventDefault();
        //
        //             // Ambil ID dari data-id tombol
        //             const id = button.getAttribute('data-id');
        //             console.log(`Mengedit data dengan ID: ${id}`); // Debugging
        //
        //             // Tampilkan modal
        //             modal.show();
        //
        //             // Lakukan request untuk memuat data
        //             fetch(`/dashboard/data-pembayaran/${id}/edit`)
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     document.getElementById('pesan').innerHTML = 'Yakin memproses pembayaran spp atas nama '+data.nama+' ?';
        //                     document.getElementById('editId').value = data.nim;
        //                     document.getElementById('editStatus').value = data.status ? '1' : '0';
        //                 })
        //                 .catch(error => console.error('Gagal memuat data:', error));
        //         });
        //     });
        // });
        //
        //
        // document.getElementById('saveChanges').addEventListener('click', () => {
        //     const form = document.getElementById('editForm');
        //     const formData = new FormData(form);
        //
        //     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        //
        //     fetch(`/dashboard/pembayaran`, {
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken,
        //             'Accept': 'application/json',
        //         },
        //         body: formData,
        //     })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.error) {
        //                 alert(data.error); // Tampilkan pesan error
        //             } else {
        //                 alert(data.success);
        //                 location.reload(); // Reload halaman untuk memperbarui tabel
        //             }
        //         })
        //         .catch(error => console.error('Gagal menyimpan data:', error));
        // });
        //
        //

    </script>
@endsection
