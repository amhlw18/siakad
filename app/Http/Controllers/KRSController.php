<?php

namespace App\Http\Controllers;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelPembayaran;
use App\Models\ModelProdi;
use App\Models\ModelStatusKRS;
use App\Models\ModelTahunAkademik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role == 1){
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'mahasiswa' => $mhs,

            ]);
        }

        if (Auth::user()->role == 4){
            $tanggalSekarang = Carbon::today();

            $tahunAkademik = ModelTahunAkademik::where('status', 1)->get();

            $pesan = null;
            $periode = false;
            foreach ($tahunAkademik as $item) {
                // Pisahkan tanggal awal dan akhir dari kolom periode
                [$tanggalAwal, $tanggalAkhir] = explode(' - ', $item->periode_krs);

                // Konversi menjadi format Carbon
                $tanggalAwal = Carbon::parse($tanggalAwal);
                $tanggalAkhir = Carbon::parse($tanggalAkhir);

                //dd($tanggalAwal .' '. $tanggalAkhir);

                //Cek apakah tanggal sistem berada di antara tanggal awal dan akhir
                if ($tanggalSekarang->between($tanggalAwal, $tanggalAkhir)) {
                    $pesan = 'Periode KRS sedang berlangsung '.' s/d ' . $tanggalAkhir;
                    $periode = true;
                    break; // Keluar dari loop jika sudah menemukan periode yang sesuai
                }elseif ($tanggalSekarang->lessThan($tanggalAwal)) {
                    // Jika periode belum dimulai
                    $pesan = 'Periode KRS akan dimulai pada tanggal ' . $tanggalAwal;
                    $periode = false;
                    break;
                } elseif ($tanggalSekarang->greaterThan($tanggalAkhir)) {
                    // Jika periode telah berakhir
                    $pesan = 'Periode KRS telah berakhir pada tanggal ' . $tanggalAkhir;
                    $periode = false;
                }
            }
            $nim = Auth::user()->user_id;
            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $nim)
                ->first();

            $pembayaran = ModelPembayaran::where('nim', $nim)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->first();

            $status_krs = ModelStatusKRS::where('nim',$nim)->first();

            $krs_mhs = ModelKRSMahasiwa::with('krs_matkul')
                ->where('nim',$nim)
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });

            return view('mahasiswa.krs.index',[
                'mhs' => $mhs,
                'pesan' => $pesan,
                'periode' => $periode,
                'tahun_aktif' => $tahun_aktif,
                'pembayaran' => $pembayaran,
                'status_krs' => $status_krs,
                'krs_mhs' => $krs_mhs,
            ]);
        }

        if (Auth::user()->role == 5){
            $prodi_id = Auth::user()->prodi;
            $prodi = ModelProdi::where('kode_prodi', $prodi_id)->first();

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->where('prodi_id', $prodi_id)
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'prodi' => $prodi,
                'mahasiswa' => $mhs,

            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Auth::user()->role == 1 || Auth::user()->role == 5){

            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
            $tahun_akademik = ModelTahunAkademik::all();
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $id)
                ->first();

            $krs = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->where('nim', $id)
                ->orderBy('matakuliah_id', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });

            $status_krs = ModelStatusKRS::where('nim',$id)->first();

            return view('mahasiswa.krs.show',[
                'tahun_aktif' => $tahun_aktif,
                'tahun_akademik' => $tahun_akademik,
                'mhs' => $mhs,
                'status_krs' => $status_krs,
                'krs' => $krs,
            ]);
        }


    }

    public function filter_data(Request $request)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 5){
            $query = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
                ->where('tahun_akademik', $request->tahun)
                ->where('nim', $request->nim)
                ->orderBy('matakuliah_id', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });


            return DataTables::of($query)
                ->addIndexColumn() // Menambahkan nomor index
                ->addColumn('action', function ($row) {
                    return '
        ';
                })
                ->addColumn('matakuliah', function ($row) {
                    return $row->krs_matkul->nama_mk ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->addColumn('semester', function ($row) {
                    return $row->krs_matkul->semester ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
                ->make(true);
        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
