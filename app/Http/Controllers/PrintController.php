<?php

namespace App\Http\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\ModelNilaiMHS;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //

    public function print_khs(Request $request)
    {
        $nim = $request->nim;
        $tahun = $request->tahun;
        $mhs = ModelMahasiswa::with('prodi_mhs')
            ->where('nim', $nim)
            ->first();

        $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $nim)
            ->where('tahun_akademik', $tahun)
            ->get();

        $validasi_kosong_khs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $nim)
            ->where('tahun_akademik', $tahun)
            ->first();

        $jumlah_sks =0;
        $jumlah_mk =0;
        $ips =0;

        if ($validasi_kosong_khs){
            $jumlah_mk = ModelNilaiMHS::where('nim', $nim)
                ->where('tahun_akademik', $tahun)
                ->count('matakuliah_id');

            $jumlah_sks = ModelNilaiMHS::where('nim', $nim)
                ->where('tahun_akademik', $tahun)
                ->sum('sks');

            $total_nilai = ModelNilaiMHS::where('nim', $nim)
                ->where('tahun_akademik', $tahun)
                ->sum('total_nilai');

            $ips = $total_nilai/$jumlah_sks;
            $ips = number_format($ips, 2,'.','');
        }

       // dd($request->all());
        $tahun_akademik = ModelTahunAkademik::where('kode', $tahun)->first();

        return view('print.khs.khs-mhs',[
            'mhs' => $mhs,
            'khs_mhs' => $khs_mhs,
            'jumlah_sks' => $jumlah_sks,
            'jumlah_mk' => $jumlah_mk,
            'ips' => $ips,
            'tahun_akademik' => $tahun_akademik,
        ]);
    }
}
