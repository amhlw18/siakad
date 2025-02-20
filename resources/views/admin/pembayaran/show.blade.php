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
                <table id="tabel" class="table table-bordered table-striped">
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
                                    <a href=""
                                       class="btn btn-danger btn-hapus"
                                       data-id="{{$pembayaran->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @else
                                    <a href=""
                                       class="btn btn-danger btn-hapus disabled"
                                       data-id="{{$pembayaran->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$pembayaran->tahun_akademik_pembayaran->tahun_akademik  ?? '-'}}</td>
                            <td>{{ $pembayaran->tgl_bayar ?? '-' }}</td>
                            <td>{{ $pembayaran->is_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <script>
        document.querySelector('#tabel').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();

                const button = e.target.closest('.btn-hapus');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                console.log(id);
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus pembayaran mahasiswa ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/pembayaran/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'error') {
                                    Swal.fire('Error!', data.message, 'error');
                                } else {
                                    Swal.fire('Berhasil!', data.message, 'success')
                                        .then(() => location.reload());
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                            });
                    }
                });
            }
        });
    </script>
@endsection
