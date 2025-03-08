@extends('layouts.main')

@section('title')
    Data KRS Mahasiswa
@endsection()

@section('mainmenu')
    @if(auth()->user()->role == 4)
        Ambil KRS
    @else
        Data KRS Mahasiswa
    @endif
@endsection()

@section('menu')
    KRS Mahasiswa
@endsection()

@section('submenu')
    Master KRS MAhasiswa
@endsection()

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        @if (session()->has('error'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif



        @if(auth()->user()->role == 4)

            @if(!$pembayaran->is_bayar)

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - Pembayaran anda pada TA {{$tahun_aktif->tahun_akademik}} belum masuk, jika anda sudah melakukan pembayaran namum masih mendaptkan pesan ini silahkan laporkan kebagian keuangan ! .<br>
                </div>

            @endif

            @if ($periode)
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - {{ $pesan }}
                </div>

                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - Jika KRS Mahasiswa belum tampil ketika sudah mengisi KRS silahkan reload kembali halaman ini .<br>
                    - Setelah melakukan pengisian KRS silahkan mengunci KRS anda.<br>
                    - Jika KRS telah disetujui maka anda tidak bisa melakukan perubahan pada KRS.
                </div>

            @else
{{--                    <div class="callout callout-warning">--}}
{{--                        <h5><i class="fas fa-info"></i> Note:</h5>--}}
{{--                    </div>--}}

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    - {{ $pesan }}
                </div>
            @endif

            <!-- Informasi mhs -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>NIM  :</strong> {{ $mhs->nim ?? '-' }}</p>
                    <p><strong>Nama Mahasiswa :</strong> {{ $mhs->nama_mhs?? '-' }}</p>
                    <p><strong>Program Studi :</strong> {{ $mhs->prodi_mhs->nama_prodi?? '-' }}</p>
                    <p><strong>Semester :</strong> {{ $mhs->semester ?? '-'}}</p>
                    @if($status_krs)
                        <p><strong>Status KRS :</strong>  <label class="{{ $status_krs->disetujui==1 ? 'badge badge-success' : 'badge badge-danger' }} ">{{ $status_krs->disetujui==1 ? 'Disetujui' : 'Belum disetujui'}}</label></p>
                    @endif
                    @if($mhs->prodi_id == 15401)
                    @else
                        @if($mhs->semester == 1 || $mhs->semester == 2)
                            <p><strong>IP Semester Lalu :</strong> 0.00 </p>
                            <p><strong>Batas SKS :</strong> {{$beban_sks}} </p>
                        @else
                            <p><strong>IP Semester Lalu :</strong> {{$ips}} </p>
                            <p><strong>Batas SKS :</strong> {{$beban_sks}} </p>
                        @endif


                    @endif

                </div>
            </div>
                @if ($periode && $pembayaran->is_bayar)
                    <form action="/dashboard/krs-mhs/ambil-krs" method="post">
                        @csrf
                        <input type="hidden" name="nim" value="{{ $mhs->nim ?? '-' }}">
                        <input type="hidden" name="prodi_id" value="{{ $mhs->prodi_id ?? '-' }}">
                        <input type="hidden" name="semester" value="{{ $mhs->semester ?? '-'}}">
                        <input type="hidden" name="beban_sks" value="{{ $beban_sks  ?? '-'}}">

                        @if($status_krs->dikunci)
                            <button class="btn btn-success mb-2 btn-setujui-krs" disabled><span data-feather="plus"></span>Ambil KRS</button>
                        @else
                            <button class="btn btn-success mb-2 btn-setujui-krs" ><span data-feather="plus"></span>Ambil KRS</button>
                        @endif

                        @if($mhs->prodi_id == 15401)
                            @if($status_krs->dikunci)
                                <button id="btn-kunci-krs" class="btn btn-primary mb-2 btn-buka-krs"><span data-feather="plus"></span>Buka Kunci KRS</button>
                            @else
                                <button id="btn-kunci-krs" class="btn btn-primary mb-2 btn-kunci-krs"  ><span data-feather="plus"></span>Kunci KRS</button>
                            @endif
                        @else
                            @if($total_sks > $beban_sks)
                                <button id="btn-kunci-krs" class="btn btn-primary mb-2 btn-kunci-krs"  disabled><span data-feather="plus"></span>Kunci KRS</button>
                            @else
                                @if($status_krs->dikunci)
                                    <button id="btn-kunci-krs" class="btn btn-primary mb-2 btn-buka-krs"><span data-feather="plus"></span>Buka Kunci KRS</button>
                                @else
                                    <button id="btn-kunci-krs" class="btn btn-primary mb-2 btn-kunci-krs"  ><span data-feather="plus"></span>Kunci KRS</button>
                                @endif

                            @endif
                        @endif
                    </form>

                @endif
        @endif

        @if(auth()->user()->role== 1 || auth()->user()->role== 6)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                                            @foreach ($mahasiswa as $mhs)
                                                <tr>
                                                    <td>
                                                        <a href="/dashboard/krs-mhs/{{ encrypt($mhs->nim)}}"
                                                           class="btn btn-success"
                                                           data-id="">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mhs->nim }}</td>
                                                    <td>{{ $mhs->nama_mhs}}</td>
                                                    <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-' }}</td>
                                                    <td>{{ $mhs->tahun_masuk }}</td>
                                                </tr>
                                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        @if(auth()->user()->role== 4)
            @if($mhs->prodi_id == 15401)
            @else
                @if($total_sks > $beban_sks)
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fa fa-exclamation-triangle me-2"></i>
                        - SKS matakuliah yang anda ambil {{$total_sks}} melebihi batas bebas SKS anda {{$beban_sks}}  , silahkan kurangi matakuliah yang anda ambil ! .<br>
                    </div>
                @endif
            @endif
        @if($status_krs->dikunci)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form action="/print/krs" target="_blank" method="post">
                                @csrf
                                <input type="hidden" name="nim" value="{{$mhs->nim}}">
                                <input type="hidden" id="tahun" name="tahun" value="{{$tahun_aktif->kode}}">
                                <button type="submit" id="Button" rel="noopener" target="_blank" class="btn btn-primary "><i class="fas fa-print"></i> Cetak KRS</button>
                            </form>
                        </div>
                    </div>
        @endif


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">KARTU RENCANA STUDI TA {{$tahun_aktif->tahun_akademik}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel1" class="table table-bordered table-hover">
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
                        <tbody>
                        @foreach ($krs_mhs as $item)
                            <tr>
                                <td>
                                    @if($status_krs->dikunci)
                                        <a href=""
                                           class="btn btn-danger btn-hapus disabled"
                                           data-id="{{$item->id}}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    @else
                                        <a href=""
                                           class="btn btn-danger btn-hapus "
                                           data-id="{{$item->id}}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    @endif

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->matakuliah_id }}</td>
                                <td>{{ $item->krs_matkul->nama_mk}}</td>
                                <td>{{ $item->krs_matkul->semester}}</td>
                                <td>{{ $item->total_sks}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">KARTU RENCANA STUDI LAMPAU</h3>--}}
{{--                    </div>--}}
{{--                    <!-- /.card-header -->--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label for="filterTahun">Tahun Akademik:</label>--}}
{{--                                <select id="filterTahun" class="form-control">--}}
{{--                                    <option value="">-- Semua Tahun Akademik --</option>--}}
{{--                                    @foreach($tahun_akademik as $item)--}}
{{--                                        <option value="{{ $item->kode }}">{{ $item->tahun_akademik }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label for="filterAngkatan">Cetak:</label>--}}
{{--                                <form action="/print/krs" target="_blank" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="nim" value="{{$mhs->nim}}">--}}
{{--                                    <input type="hidden" id="tahun" name="tahun" value="">--}}
{{--                                    <button type="submit" id="Button" rel="noopener" target="_blank" class="btn btn-primary "><i class="fas fa-print"></i> Cetak KRS</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <table id="tabel5" class="table table-bordered table-hover">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>Kode Matakuliah</th>--}}
{{--                                <th>Nama Matakuliah </th>--}}
{{--                                <th>Semester</th>--}}
{{--                                <th>SKS</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach ($krs_mhs as $item)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $loop->iteration }}</td>--}}
{{--                                    <td>{{ $item->matakuliah_id }}</td>--}}
{{--                                    <td>{{ $item->krs_matkul->nama_mk}}</td>--}}
{{--                                    <td>{{ $item->krs_matkul->semester}}</td>--}}
{{--                                    <td>{{ $item->total_sks}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <!-- /.card-body -->--}}
{{--                </div>--}}
        @endif

        @if(auth()->user()->role== 5)

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa Prodi {{$prodi->nama_prodi}} </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa </th>
                            <th>Angkatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>
                                    <a href="/dashboard/krs-mhs/{{encrypt($mhs->nim) }}"
                                       class="btn btn-success"
                                       data-id="">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->nama_mhs}}</td>
                                <td>{{ $mhs->tahun_masuk }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif

        @if(auth()->user()->role == 4)
            <form id="kunciKRSForm">
                <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun_aktif->kode}}">
                <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">
            </form>

            <form id="bukaKRSForm">
                <input type="hidden" id="tahun_akademik" name="tahun_akademik" value="{{$tahun_aktif->kode}}">
                <input type="hidden" id="nim" name="nim" value="{{$mhs->nim}}">
            </form>

        @endif


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    @if(auth()->user()->role== 4)
        <form id="filterForm">
            {{--        //<input type="hidden" id="prodi_id" value="{{$mhs->prodi_mhs->prodi_id?? '-'}}">--}}
            <input type="hidden" id="nim" value="{{$mhs->nim}}">
        </form>

{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                $('#tabel5').DataTable({--}}
{{--                    processing: true,--}}
{{--                    serverSide: true,--}}
{{--                    ajax: {--}}
{{--                        url: "{{ route('get.krs') }}",--}}
{{--                        type: "GET",--}}
{{--                        data: function (d) {--}}
{{--                            d.tahun = $('#filterTahun').val();--}}
{{--                            d.nim = $('#nim').val();--}}
{{--                            const tahun_akademik = document.getElementById('tahun');--}}
{{--                            //tahun_akademik.value = $('#filterTahun').val();--}}
{{--                        }--}}
{{--                    },--}}
{{--                    columns: [--}}
{{--                        { data: 'action', name: 'action', orderable: false, searchable: false },--}}
{{--                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },--}}
{{--                        { data: 'matakuliah_id', name: 'matakuliah_id' },--}}
{{--                        { data: 'matakuliah', name: 'krs_matkul.nama_mk' },--}}
{{--                        { data: 'semester', name: 'krs_matkul.semester' },--}}
{{--                        { data: 'total_sks', name: 'total_sks' },--}}
{{--                    ]--}}
{{--                });--}}

{{--                // Refresh DataTables on filter change--}}
{{--                $('#filterTahun').on('change', function () {--}}
{{--                    $('#tabel5').DataTable().ajax.reload();--}}
{{--                    $("#pesan").remove();--}}
{{--                });--}}
{{--            });--}}

{{--        </script>--}}
    @endif
    <script>


        document.querySelectorAll('.btn-buka-krs').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('bukaKRSForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin membuka kunci KRS ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Buka kunci!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/buka-krs`, {
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

        document.querySelectorAll('.btn-kunci-krs').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const form = document.getElementById('kunciKRSForm');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin mengunci KRS, jika krs telah dikunci dan disetujui oleh PA anda tidak dapat lagi mengubah KRS ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kunci!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/kunci-krs`, {
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
                const id = button.getAttribute('data-id'); // Ambil data-id dari tombol
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                //console.log(id);
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin menghapus matakuliah ini dari KRS?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, proses!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/dashboard/krs-mhs/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
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
