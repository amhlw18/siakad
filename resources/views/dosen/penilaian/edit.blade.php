@extends('layouts.main')

@section('title')
    Data Nilai Mahasiswa
@endsection()

@section('mainmenu')
    Nilai Mahasiswa
@endsection()

@section('menu')
    Data Nilai Mahasiswa
@endsection()

@section('submenu')
    Master Nilai Mahasiswa
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

        @if($jml_aspek==$jml_nilai)
            <div class="alert alert-success" role="alert">
                Semua aspek penilaian telah dimasukan !
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Aspek penilaian belum semua dimasukan !
            </div>
        @endif

        @if($cek_nilai)
            <div class="alert alert-success" role="alert">
                Nilai mahasiswa telah disimpan, jika ada perubahan tekan tombol Reset Nilai Untuk melakukan perubahan !
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Nilai mahasiswa belum disimpan, tekan tombol simpan untuk menyimpan nilai mahasiswa !
            </div>
        @endif

        @if($jml_aspek==$jml_nilai)
            <a href="#" class="btn btn-primary mb-2 btn-simpan" ><span data-feather="plus"></span>Simpan Nilai</a>
        @else
            <a href="" class="btn btn-primary mb-2 disabled" ><span data-feather="plus"></span>Simpan Nilai</a>
        @endif

        @if($cek_nilai)
            <a href="" class="btn btn-danger mb-2 btn-hapus-nilai"><span data-feather="plus"></span>Reset Nilai</a>
        @else
            <a href="" class="btn btn-danger mb-2 disabled"><span data-feather="plus"></span>Reset Nilai</a>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Nilai {{$mhs->nama_mhs}} Matakuliah {{$matkul->nama_mk}} </h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Nama Aspek</th>
                        <th>Nilai </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($nilais as $nilai)
                        <tr>
                            <td>

                                @if($cek_nilai)
                                    <a href="#"
                                       class="btn btn-danger btn-hapus disabled"
                                       data-id="{{$nilai->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <a href="#"
                                       class="btn btn-warning btn-edit disabled"
                                       data-bs-toggle="modal"
                                       data-bs-target="#buatJadwalModal"
                                       data-id="{{$nilai->id}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @else
                                    <a href="#"
                                       class="btn btn-danger btn-hapus"
                                       data-id="{{$nilai->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <a href="#"
                                       class="btn btn-warning btn-edit"
                                       data-bs-toggle="modal"
                                       data-bs-target="#buatJadwalModal"
                                       data-id="{{$nilai->id}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nilai->nilai_aspek->aspek }}</td>
                            <td>{{ $nilai->nilai}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total Nilai:</strong></td>
                        <td><strong>{{$total_nilai}}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Nilai Huruf:</strong></td>
                        <td><strong>{{$nilai_huruf}}</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <form id="simpanNilaiForm">
{{--        <form id="simpanNilaiForm" action="/dashboard/nilai-semester/simpan-nilai" method="post">--}}
{{--            @csrf--}}
            <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun->kode}}">
            <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="{{$matkul->kode_mk}}">
            <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">
            <input type="hidden" id="nim" name="nilai_angka" value="{{$nilai_angka}}">
            <input type="hidden" id="nidn" name="nilai_huruf" value="{{$nilai_huruf}}">
            <input type="hidden" id="total_nilai" name="total_nilai" value="{{$total_nilai}}">

{{--            <input type="submit" >--}}
        </form>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="buatJadwalModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Penilaian Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="simpanForm">
                        <input type="hidden" id="nilai_id" name="nilai_id" value="">
                        <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun->kode}}">
                        <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="{{$matkul->kode_mk}}">
                        <input type="hidden" id="aspek_id" name="aspek_id" value="">

                        <div class="form-group">
                            <label for="Nilai Angka">Nilai Angka</label>
                            <input type="number" name="nilai"
                                   class="form-control @error('nilai') is-invalid @enderror" id="nilai"
                                   placeholder="Isi dengan nilai angka" value="{{ old('nilai') }}" required>
                            @error('nilai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Proses</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('buatJadwalModal'));
            const nilai_id = document.getElementById('nilai_id');
            const nim = document.getElementById('nim');
            const tahun = document.getElementById('tahun_akademik').value;
            const matkul = document.getElementById('matakuliah_id').value;
            const aspekId = document.getElementById('aspek_id');

            document.querySelector('#tabel').addEventListener('click', (e) => {
                if (e.target.closest('.btn-edit')) {
                    e.preventDefault();
                    const button = e.target.closest('.btn-edit');
                    const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                    nilai_id.value = id;

                    fetch(`/dashboard/nilai-semester/${id}/filter`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            document.getElementById('nilai').value = data.nilai;
                            aspekId.value = data.aspek_id;

                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data');
                        });
                }
            });



            document.getElementById('saveChanges').addEventListener('click', () => {
                const form = document.getElementById('simpanForm');
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                const id = document.getElementById('nilai_id');
                const nilai_id = id.value;
                const url = nilai_id ? `/dashboard/nilai-semester/${nilai_id}` : '/dashboard/nilai-semester';

                if (nilai_id) {
                    formData.append('_method', 'PUT');
                    console.log('edit data');
                } else {
                    console.log('tambah data');
                }

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                    .then(async response => {
                        if (!response.ok) {
                            // Lempar error dengan status dan teks respons
                            throw { status: response.status, message: await response.text() };
                        }
                        // Pastikan respons valid JSON
                        const data = await response.json();
                        return data;
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
                            const errorData = JSON.parse(error.message); // Parsing JSON manual
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
                            console.error('Error:', error.message || error);
                        }
                    });



            });


        });

        document.querySelector('#tabel').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();

                const button = e.target.closest('.btn-hapus');
                const id = button.getAttribute('data-id');

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus aspek penilaian?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/nilai-semester/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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

        document.querySelectorAll('.btn-simpan').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('simpanNilaiForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menyimpan nilai mahasiswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/nilai-semester/simpan-nilai`, {
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
                                //console.log('Response status:', response.status);
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

            });
        });

        document.querySelectorAll('.btn-hapus-nilai').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('simpanNilaiForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin mereset nilai mahasiswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/nilai-semester/hapus-nilai`, {
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

            });
        });

    </script>

@endsection()

