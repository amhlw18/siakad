@extends('layouts.main')

@section('title')
    KHS Mahasiswa
@endsection()

@section('mainmenu')
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

        @if ($periode)
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                - {{ $pesan }}
            </div>

            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                - Jika KRS Mahasiswa belum tampil, menandakan bahwa mahasiswa belum mengunci KRS atau mahasiswa belum mengisi KRS.<br>
            </div>
        @else
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                - {{ $pesan }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs ?? '-' }}</p>
                <p><strong>Tahun Akademik :</strong> {{ $tahun->tahun_akademik?? '-' }}</p>
                <p><strong>Prodi :</strong> {{ $mhs->prodi_mhs->nama_prodi ?? '-'}}</p>
                <p><strong>Semester :</strong> {{ $mhs->semester ?? '-'}}</p>
                <p><strong>Batas SKS :</strong> {{$beban_sks}} </p>
                @if($status_krs)
                    <p><strong>Status KRS :</strong>  <label class="{{ $status_krs->disetujui==1 ? 'badge badge-success' : 'badge badge-danger' }} ">{{ $status_krs->disetujui==1 ? 'Disetujui' : 'Belum disetujui' }}</label></p>
                @endif

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kartu Hasil Studi Semester Sebelumnya </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah </th>
                        <th>Total SKS</th>
                        <th>Nilai Angka </th>
                        <th>Nilai Huruf </th>
                        <th>Total (SKS X Nilai Angka)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($khs_mhs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->matakuliah_id }}</td>
                            <td>{{ $item->nilai_matakuliah_mhs->nama_mk}}</td>
                            <td>{{ $item->sks}}</td>
                            @if($item->nilai_huruf == 'A')
                                <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                                <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                                <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'B')
                                <td><label class="badge badge-success">{{ $item->nilai_angka }}</label></td>
                                <td><label class="badge badge-success">{{ $item->nilai_huruf }}</label></td>
                                <td><label class="badge badge-success">{{ $item->total_nilai }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'C')
                                <td><label class="badge badge-warning">{{ $item->nilai_angka }}</label></td>
                                <td><label class="badge badge-warning">{{ $item->nilai_huruf }}</label></td>
                                <td><label class="badge badge-warning">{{ $item->total_nilai }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'D')
                                <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                                <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                                <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                            @endif

                            @if($item->nilai_huruf == 'E')
                                <td><label class="badge badge-danger">{{ $item->nilai_angka }}</label></td>
                                <td><label class="badge badge-danger">{{ $item->nilai_huruf }}</label></td>
                                <td><label class="badge badge-danger">{{ $item->total_nilai }}</label></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-end"><strong>Jumlah SKS:</strong></td>
                        <td><strong>{{$jumlah_sks}}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end"><strong>Jumlah Matakuliah Diambil:</strong></td>
                        <td><strong>{{$jumlah_mk}}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end"><strong>IP Semester:</strong></td>
                        @if($ips >= 0 &&  $ips <= 2.50  )
                            <td> <label class="badge badge-danger"><strong>{{$ips}}</strong></label> </td>
                        @endif

                        @if($ips >= 2.51 &&  $ips <= 3.10  )
                            <td> <label class="badge badge-warning"><strong>{{$ips}}</strong></label> </td>
                        @endif

                        @if($ips >= 3.11 &&  $ips <= 4.00  )
                            <td> <label class="badge badge-success"><strong>{{$ips}}</strong></label> </td>
                        @endif
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">KARTU RENCANA STUDI</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah </th>
                        <th>Semester</th>
                        <th>SKS</th>
                    </tr>
                    </thead>
                    @if($status_krs)
                        @if($status_krs->dikunci)
                            <tbody>
                            @foreach ($krs_mhs as $item)
                                <tr>
                                    @if($status_krs->disetujui)
                                        <td>
                                            <a href=""
                                               class="btn btn-danger btn-hapus "
                                               data-id="{{$item->id}}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->matakuliah_id }}</td>
                                    <td>{{ $item->krs_matkul->nama_mk}}</td>
                                    <td>{{ $item->krs_matkul->semester}}</td>
                                    <td>{{ $item->total_sks}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else

                        @endif
                    @endif


                </table>
            </div>
            <!-- /.card-body -->
        </div>

        @if($status_krs)
            @if(! $status_krs->disetujui && $status_krs->dikunci)
                <a href="#" class="btn btn-primary mb-2 btn-setujui-krs" ><span data-feather="plus"></span>Setujui KRS</a>
            @endif

            @if($status_krs->disetujui && $periode)
                <a href="#" class="btn btn-danger mb-2 btn-batal-krs" ><span data-feather="plus"></span>Batalkan KRS</a>
            @else
                <a href="#" class="btn btn-danger mb-2 btn-batal-krs disabled"><span data-feather="plus"></span>Batalkan KRS</a>
            @endif
        @endif


        <form id="simpanKRSForm">
            <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun->kode}}">
            <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">
        </form>

        <form id="hapusKRSForm">
            <input type="hidden" id="krs_id" name="krs_id" value="">

        </form>

{{--        <form id="simpanKRSForm" action="/dashboard/dosen/detail-pa" method="post">--}}
{{--            @csrf--}}
{{--            <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun->kode}}">--}}
{{--            <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">--}}

{{--            <input type="submit" >--}}
{{--        </form>--}}
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script>
        document.querySelectorAll('.btn-setujui-krs').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('simpanKRSForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menyetujui KRS ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/dosen/detail-pa`, {
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

        document.querySelectorAll('.btn-batal-krs').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('simpanKRSForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menyetujui KRS ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/dosen/detail-pa/delete`, {
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

        document.querySelector('#tabel5').addEventListener('click', (e) => {
            if (e.target.closest('.btn-hapus')) {
                e.preventDefault();
                const button = e.target.closest('.btn-hapus');
                const form = document.getElementById('hapusKRSForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);
                const idValue = document.getElementById('krs_id');

                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus matakuliah dari KRS ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/dosen/hapus-krs/${id}`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            }
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
            }
        });
    </script>

@endsection()
