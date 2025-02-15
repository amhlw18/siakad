@extends('layouts.main')

@section('title')
    Tambah Kelas Mahasiswa
@endsection()

@section('mainmenu')
   Tambah Kelas Mahasiswa
@endsection()

@section('menu')
    Kelas Mahasiswa
@endsection()

@section('submenu')
    Master Kelas Mahasiswa
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


{{--        @if($role->id)--}}
            <div class="card">
                <div class="card-header">
{{--                    <h3 class="card-title">Data Mahasiswa Prodi {{$role->nama_prodi}}</h3>--}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="filterProdi">Pilih Program Studi:</label>
                            <select id="filterProdi" class="form-control" name="prodi_id">
                                <option value="">-- Pilih Prodi --</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="filterAngkatan">Pilih Kelas:</label>
                            <select id="pilihKelas" class="form-control">
                                <option value="">-- Pilih Kelas --</option>

                            </select>
                        </div>
                    </div>
                    <table id="tabel5" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama </th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>
                                    <a href=""
                                       class="btn btn-primary btn-tambah"
                                       data-id="{{$mhs->nim}}">
                                        Tambah
                                    </a>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nim  }}</td>
                                <td>{{ $mhs->nama_mhs }}</td>
                                <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-'}}</td>
                                <td>{{ $mhs->tahun_masuk}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
{{--        @endif--}}

        <form id="simpanForm">
            <input type="hidden" id="prodi_id" name="prodi_id" value="">
            <input type="hidden" id="nim" name="nim" value="">
            <input type="hidden" id="kelas_id" name="kelas_id" value="">
        </form>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script>
        $(document).ready(function () {
            $('#filterProdi').on('change', function () {
                var prodiId = $(this).val();
                //console.log(prodiId);
                if (prodiId) {
                    $.ajax({
                        url: '/get-kelas/' + prodiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#pilihKelas').empty();
                            $('#pilihKelas').append('<option value="">-- Pilih Kelas --</option>');
                            $.each(data, function (key, value) {
                                $('#pilihKelas').append('<option value="' + value.id + '">' + value.nama_kelas + '</option>');
                            });
                        }
                    });
                } else {
                    $('#pilihKelas').empty();
                    $('#pilihKelas').append('<option value="">-- Pilih Kelas --</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#tabel5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kelas.filter') }}",
                    type: "GET",
                    data: function (d) {
                        d.prodi = $('#filterProdi').val();
                       // d.angkatan = $('#filterAngkatan').val();


                        //console.log(prodi_id);
                    }
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nim', name: 'nim' },
                    { data: 'nama_mhs', name: 'nama_mhs' },
                    { data: 'nama_prodi', name: 'nama_prodi' },
                    { data: 'tahun_masuk', name: 'tahun_masuk' },

                ]
            });

            // Refresh DataTables on filter change
            $('#filterProdi').on('change', function () {
                $('#tabel5').DataTable().ajax.reload();

                const prodiID = document.getElementById('prodi_id');
                const id = $('#filterProdi').val();
                prodiID.value = id;

            });

            $('#pilihKelas').on('change', function () {

                const kelasID = document.getElementById('kelas_id');
                const kelas_id = $('#pilihKelas').val();
                kelasID.value = kelas_id;

                // console.log(kelas_id);

            });
        });

    </script>

    <script>


        document.querySelector('#tabel5').addEventListener('click', (e) => {
            if (e.target.closest('.btn-tambah')) {
                e.preventDefault();

                const form = document.getElementById('simpanForm');
                const button = e.target.closest('.btn-tambah');
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Set nilai 'nim' ke input hidden
                const nimInput = document.getElementById('nim');
                nimInput.value = id;

                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin ingin menambahkan mahasiswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/kls-mhs`, {
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


