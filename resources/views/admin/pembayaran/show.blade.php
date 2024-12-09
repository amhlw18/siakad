@extends('layouts.main')

@section('title')
    Data Pembayaran SPP
@endsection

@section('mainmenu')
    Data Pembayaran SPP
@endsection

@section('menu')
    Data Pembayaran SPP
@endsection

@section('submenu')
    Master Data Pembayaran SPP
@endsection

@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

            <!-- Informasi Mahasiswa -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>NIM  :</strong> {{ $mahasiswa->nim ?? '-' }}</p>
                    <p><strong>Nama :</strong> {{ $mahasiswa->nama_mhs?? '-' }}</p>
                    <p><strong>Prodi:</strong> {{ $prodi->nama_prodi ?? '-' }}</p>
                </div>
            </div>



        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Riwayat Pembayaran SPP</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Tahun Akademik</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <td>
                                @if($pembayaran->tahun_akademik_pembayaran->status)
                                    <a href="#"
                                       class="btn btn-danger btn-edit"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editModal"
                                       data-id="{{ $pembayaran->nim }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @else
                                    <!-- Tombol ini opsional, jika Anda ingin sesuatu ditampilkan ketika is_bayar = false -->
                                    <a href="/dashboard/data-mahasiswa/{{ $pembayaran->nim }}/edit" class="btn btn-danger disabled">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$pembayaran->tahun_akademik_pembayaran->tahun_akademik  ?? '-'}} {{ $pembayaran->tahun_akademik_pembayaran->semester}}</td>
                            <td>{{ $pembayaran->tgl_bayar ?? '-' }}</td>
                            <td>{{ $pembayaran->is_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="pesan"></p>
                    <form id="editForm">
                        <input type="hidden" id="editId" name="id">
                        <input type="hidden" id="editStatus" name ="is_bayar" value="0">
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Proses</button>
                </div>
            </div>
        </div>
    </div>


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
                            document.getElementById('pesan').innerHTML = 'Yakin membatalkan pembayaran spp atas nama '+data.nama+' ?';
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
            const id = editId.value;
            console.log(`Mengedit data dengan ID: ${id}`); // Debugging

            fetch(`/dashboard/pembayaran/${id}`, {
                method: 'DELETE',
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
