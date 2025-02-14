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
                <h3 class="card-title"> Pembayaran SPP {{$tahun}} {{$smt}} </h3>
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
                                   class="btn btn-warning btn-edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#editModal"
                                   data-id="{{ $mhs->nim }}">
                                    <i class="bi bi-pencil"></i>
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

{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="editModalLabel">Konfirmasi</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <p id="pesan"></p>--}}
{{--                    <form id="editForm">--}}
{{--                        <input type="hidden" id="editId" name="id">--}}
{{--                        <input type="hidden" id="editStatus" name ="is_bayar" value="1">--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}

{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary" id="saveChanges">Proses</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('editModal'));

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Ambil ID dari data-id tombol
                    const id = button.getAttribute('data-id');
                    console.log(`Mengedit data dengan ID: ${id}`); // Debugging

                    // Tampilkan modal
                    modal.show();

                    // Lakukan request untuk memuat data
                    fetch(`/dashboard/data-pembayaran/${id}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('pesan').innerHTML = 'Yakin memproses pembayaran spp atas nama '+data.nama+' ?';
                            document.getElementById('editId').value = data.nim;
                            document.getElementById('editStatus').value = data.status ? '1' : '0';
                        })
                        .catch(error => console.error('Gagal memuat data:', error));
                });
            });
        });


        document.getElementById('saveChanges').addEventListener('click', () => {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`/dashboard/pembayaran`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error); // Tampilkan pesan error
                    } else {
                        alert(data.success);
                        location.reload(); // Reload halaman untuk memperbarui tabel
                    }
                })
                .catch(error => console.error('Gagal menyimpan data:', error));
        });



    </script>
@endsection
