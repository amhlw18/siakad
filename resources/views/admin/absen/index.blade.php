@extends('layouts.main')

@section('title')
    Absen
@endsection()

@section('mainmenu')
    Buat Absen
@endsection()

@section('menu')
    Buat Absen
@endsection()

@section('submenu')
    Buat Absen
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

        @if (session()->has('errors'))
            <div class="alert alert-danger" role="alert">
                {{ session('errors') }}
            </div>
        @endif


        {{--        @if($role->id)--}}
        <div class="card">
            <div class="card-header">
                <h5>Cetak Absen Matakuliah</h5>
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
                        <label for="filterAngkatan">Pilih Matakuliah:</label>
                        <select id="pilihMatkul" class="custom-select rounded-0 select2">
                            <option value="">-- Pilih Matakuliah --</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="/print/absen" target="_blank" method="post">
                            @csrf
                            <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="">
                            <input type="hidden" id="prodi_id" name="prodi_id" value="">
                            <button type="submit" id="Button" rel="noopener" target="_blank" class="btn btn-primary "><i class="fas fa-print"></i> Cetak Absen</button>
                        </form>
                    </div>
                </div>

{{--                <table id="tabel5" class="table table-bordered table-hover">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th></th>--}}
{{--                        <th>NIM</th>--}}
{{--                        <th>Nama </th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach ($kr as $mhs)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <a href=""--}}
{{--                                   class="btn btn-primary btn-tambah"--}}
{{--                                   data-id="{{$mhs->nim}}">--}}
{{--                                    Tambah--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>{{ $loop->iteration }}</td>--}}
{{--                            <td>{{ $mhs->nim  }}</td>--}}
{{--                            <td>{{ $mhs->nama_mhs }}</td>--}}
{{--                            <td>{{ $mhs->prodi_mhs->nama_prodi ?? '-'}}</td>--}}
{{--                            <td>{{ $mhs->tahun_masuk}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}

{{--                    </tbody>--}}
{{--                </table>--}}
            </div>
            <!-- /.card-body -->
        </div>
        {{--        @endif--}}

        <form id="simpanForm">
            <input type="hidden" id="prodi_id" name="prodi_id" value="">
            <input type="hidden" id="nim" name="nim" value="">
            <input type="hidden" id="matakuliah_id" name="matakuliah_id" value="">
        </form>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script>
        $(document).ready(function () {
            $('#Button').prop('disabled', true);
            $('#filterProdi').on('change', function () {
                var prodiId = $(this).val();
                //console.log(prodiId);
                if (prodiId) {
                    $.ajax({
                        url: '/get-matkul/' + prodiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#pilihMatkul').empty();
                            $('#pilihMatkul').append('<option value="">-- Pilih Matakuliah --</option>');
                            $.each(data, function (key, value) {
                                $('#pilihMatkul').append('<option value="' + value.kode_mk + '">' + value.nama_mk + '</option>');
                            });

                            const prodi_id = document.getElementById('prodi_id')
                            prodi_id.value = prodiId

                        }
                    });
                } else {
                    $('#pilihMatkul').empty();
                    $('#pilihMatkul').append('<option value="">-- Pilih Matakuliah --</option>');
                }
            });

            $('#pilihMatkul').on('change', function () {
                $('#Button').prop('disabled', false);

                const matakuliah_id = document.getElementById('matakuliah_id');
                matakuliah_id.value = $('#pilihMatkul').val();

            });
        });
    </script>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#tabel5').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: {--}}
{{--                    url: "{{ route('krs.filter') }}",--}}
{{--                    type: "GET",--}}
{{--                    data: function (d) {--}}
{{--                        d.prodi = $('#filterProdi').val();--}}
{{--                        d.matkul = $('#pilihMatkul').val();--}}


{{--                        //console.log(prodi_id);--}}
{{--                    }--}}
{{--                },--}}
{{--                columns: [--}}
{{--                    { data: 'action', name: 'action', orderable: false, searchable: false },--}}
{{--                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },--}}
{{--                    { data: 'nim', name: 'nim' },--}}
{{--                    { data: 'nama_mhs', name: 'nama_mhs' },--}}

{{--                ]--}}
{{--            });--}}

{{--            // Refresh DataTables on filter change--}}
{{--            $('#filterProdi').on('change', function () {--}}


{{--                // const prodiID = document.getElementById('prodi_id');--}}
{{--                // const id = $('#filterProdi').val();--}}
{{--                // prodiID.value = id;--}}

{{--            });--}}

{{--            $('#pilihMatkul').on('change', function () {--}}
{{--                $('#tabel5').DataTable().ajax.reload();--}}
{{--                // const kelasID = document.getElementById('matakuliah_id');--}}
{{--                // const kelas_id = $('#pilihMatkul').val();--}}
{{--                // kelasID.value = kelas_id;--}}
{{--                //--}}
{{--                // console.log(kelas_id);--}}

{{--            });--}}
{{--        });--}}

{{--    </script>--}}

{{--    <script>--}}




@endsection()


