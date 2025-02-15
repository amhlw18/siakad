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
        if (Auth::user()->role == 1 || Auth::user()->role == 6){
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.transkrip-nilai.index',[
                'mahasiswa' => $mhs,

            ]);
        }

        if (Auth::user()->role == 4){

            $nim = Auth::user()->user_id;
            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $nim)
                ->first();

            $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
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
                    ->count('matakuliah_id');

                $jumlah_sks = ModelNilaiMHS::where('nim', $nim)
                    ->where('total_nilai', '>','1')
                    ->sum('sks');

                $total_nilai = ModelNilaiMHS::where('nim', $nim)
                    ->sum('total_nilai');

                if (!$total_nilai && $jumlah_mk == 0){
                    $ips = $total_nilai/$jumlah_sks;
                    $ips = number_format($ips, 2,'.','');
                }
            }


            return view('mahasiswa.transkrip-nilai.index',[
                'mhs' => $mhs,
                'tahun_aktif' => $tahun_aktif,
                'khs_mhs' => $khs_mhs,
                'jumlah_sks' => $jumlah_sks,
                'jumlah_mk' => $jumlah_mk,
                'ips' => $ips,
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

            return view('mahasiswa.transkrip-nilai.index',[
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
        if (Auth::user()->role == 1 || Auth::user()->role == 5 || Auth::user()->role == 6){

            $nim = decrypt($id);
            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $nim)
                ->first();

            $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
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
                    ->count('matakuliah_id');

                $jumlah_sks = ModelNilaiMHS::where('nim', $nim)
                    ->where('total_nilai', '>','1')
                    ->sum('sks');

                $total_nilai = ModelNilaiMHS::where('nim', $nim)
                    ->sum('total_nilai');

                if (!$total_nilai && $jumlah_mk == 0){
                    $ips = $total_nilai/$jumlah_sks;
                    $ips = number_format($ips, 2,'.','');
                }

            }


            return view('mahasiswa.transkrip-nilai.show',[
                'mhs' => $mhs,
                'tahun_aktif' => $tahun_aktif,
                'khs_mhs' => $khs_mhs,
                'jumlah_sks' => $jumlah_sks,
                'jumlah_mk' => $jumlah_mk,
                'ips' => $ips,
            ]);
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
