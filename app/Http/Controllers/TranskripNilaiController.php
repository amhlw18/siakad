<?php

namespace App\Http\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\ModelNilaiMHS;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranskripNilaiController extends Controller
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

            return view('mahasiswa.khs.index',[
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

            $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->get();

            $validasi_kosong_khs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->first();

            $jumlah_sks =0;
            $jumlah_mk =0;
            $ips =0;

            if ($validasi_kosong_khs){
                $jumlah_mk = ModelNilaiMHS::where('nim', $nim)
                    ->where('tahun_akademik', $tahun_aktif->kode)
                    ->count('matakuliah_id');

                $jumlah_sks = ModelNilaiMHS::where('nim', $nim)
                    ->where('tahun_akademik', $tahun_aktif->kode)
                    ->sum('sks');

                $total_nilai = ModelNilaiMHS::where('nim', $nim)
                    ->where('tahun_akademik', $tahun_aktif->kode)
                    ->sum('total_nilai');

                $ips = $total_nilai/$jumlah_sks;
                $ips = number_format($ips, 2,'.','');
            }

            $tahun = ModelTahunAkademik::all();

            return view('mahasiswa.khs.index',[
                'mhs' => $mhs,
                'pesan' => $pesan,
                'periode' => $periode,
                'tahun_aktif' => $tahun_aktif,
                'khs_mhs' => $khs_mhs,
                'jumlah_sks' => $jumlah_sks,
                'jumlah_mk' => $jumlah_mk,
                'ips' => $ips,
                'tahun_akademik' => $tahun,
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

            return view('mahasiswa.khs.index',[
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
