@extends('layouts.main')

@section('title')
    Data Aspek Penilaian
@endsection()

@section('mainmenu')
    Aspek Penilaian  {{$matkuls->nama_mk}}
@endsection()

@section('menu')
    Data Aspek Penilaian
@endsection()

@section('submenu')
    Data Aspek Penilaian
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('success'))
            <div class="alert alert-warning" role="alert">
                {{ session('success') }}
            </div>
        @endif

{{--        <!-- Filter Section -->--}}
{{--        <div class="row mb-3">--}}
{{--            <div class="col-md-4">--}}
{{--                <label for="filterMatkul">Matakuliah</label>--}}
{{--                <select id="filterMatkul" class="form-control">--}}
{{--                    <option value="">Semua Matakuliah</option>--}}
{{--                    @foreach ($matakuliah as $matkul)--}}
{{--                        <option value="{{ $matkul->jadwal_matakuliah->kode_mk ?? '-' }}">{{ $matkul->jadwal_matakuliah->nama_mk }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}



        @if( $role )
            <a href="#"
               class="btn btn-primary mb-2 btn-jadwal "
               data-bs-toggle="modal"
               data-bs-target="#buatJadwalModal"
               data-id="">
                <span data-feather="plus"></span>Buat Aspek Penilaian</a>
        @else
            <div class="alert alert-warning" role="alert">
                 Hanya dosen pengampuh yang dapat mengelolah data matakuliah ini !
            </div>
        @endif


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Aspek Penilaian</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Aspek Penilaian </th>
                        <th>Bobot</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($aspeks as $aspek)
                        <tr>
                            <td>
                                @if( $role )
                                    <a href="#"
                                       class="btn btn-warning btn-edit"
                                       data-bs-toggle="modal"
                                       data-bs-target="#buatJadwalModal"
                                       data-id="{{ $aspek->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="#"
                                       class="btn btn-danger btn-hapus"
                                       data-id="{{ $aspek->id }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $aspek->aspek }}</td>
                            <td>{{ $aspek->bobot }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="buatJadwalModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Buat Aspek Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="simpanForm">
                        <input type="hidden" id="aspek_id" name="aspek_id" value="">
                        <input type="hidden" id="nidn" name="nidn" value="{{ auth()->user()->user_id }}">
                        <input type="hidden" id="nama_dosen" name="nama_dosen" value="{{ auth()->user()->name }}">
                        <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="">
                        <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="{{$matkuls->kode_mk}}">

                        <div class="form-group">
                            <label for="nama_kelas">Aspek Penilaian</label>
                            <input type="text" name="aspek"
                                   class="form-control @error('aspek') is-invalid @enderror" id="aspek"
                                   placeholder="Aspek Penilaian" value="{{ old('aspek') }}" required>
                            @error('aspek')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_kelas">Bobot %</label>
                            <input type="text" name="bobot"
                                   class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                                   placeholder="Isi menggunakan angka desimal pasahkan dengan titik" value="{{ old('bobot') }}" required>
                            @error('bobot')
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
            const aspekId = document.getElementById('aspek_id');

            // Delegasikan event listener untuk tombol edit
            document.querySelector('#example1').addEventListener('click', (e) => {
                if (e.target.closest('.btn-edit')) {
                    e.preventDefault();

                    const button = e.target.closest('.btn-edit');
                    const id = button.getAttribute('data-id');
                    aspekId.value = id;

                    fetch(`/dashboard/aspekk-nilai/${id}/edit`)
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memuat data');
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('matakuliah_id').value = data.matakuliah_id;
                            document.getElementById('aspek').value = data.aspek;
                            document.getElementById('bobot').value = data.bobot;

                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data');
                        });
                }
            });

            document.querySelector('#example1').addEventListener('click', (e) => {
                if (e.target.closest('.btn-hapus')) {
                    e.preventDefault();

                    const button = e.target.closest('.btn-hapus');
                    const id = button.getAttribute('data-id');

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Anda yakin menghapus data aspek penilaian?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/dashboard/aspek-nilai/${id}`, {
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

            document.getElementById('saveChanges').addEventListener('click', () => {
                const form = document.getElementById('simpanForm');
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                const id = document.getElementById('aspek_id');
                const aspekId = id.value;
                const url = aspekId ? `/dashboard/aspek-nilai/${aspekId}` : '/dashboard/aspek-nilai';

                if (aspekId) {
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
                            location.reload(); // Reload halaman
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
            });



        });


        // document.addEventListener('DOMContentLoaded', () => {
        //
        //     const filterMatkul = document.getElementById('filterMatkul');
        //     const tablePembayaran = $('#tablePembayaran'); // Gunakan jQuery untuk DataTables
        //
        //     // Inisialisasi DataTables
        //     let dataTable = tablePembayaran.DataTable();
        //
        //     function fetchFilteredData() {
        //         const matkul = filterMatkul.value;
        //
        //         fetch(`/dashboard/aspekk-nilai/filter?matkul=${matkul}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 // Clear existing table data
        //                 //console.log(data);
        //                 dataTable.clear();
        //
        //                 // Add new rows
        //                 data.forEach((item, index) => {
        //                     dataTable.row.add([
        //                         `
        //                         <a href=""
        //                            class="btn btn-warning btn-edit"
        //                            data-bs-toggle="modal"
        //                            data-bs-target="#buatJadwalModal"
        //                            data-id="${item.id}">
        //                             <i class="bi bi-pencil"></i>
        //                         </a>
        //
        //                         <a href=""
        //                            class="btn btn-danger btn-hapus"
        //
        //                            data-id="${item.id}">
        //                             <i class="bi bi-trash"></i>
        //                         </a>
        //                         `,
        //                         index + 1,
        //                         item.aspek,
        //                         item.bobot || '-',
        //                     ]);
        //                 });
        //
        //                 // Redraw table
        //
        //                 dataTable.draw();
        //             });
        //     }
        //
        //     filterMatkul.addEventListener('change', fetchFilteredData);
        //     ///filterProdi.addEventListener('change', fetchFilteredData);
        // });


    </script>


@endsection()
