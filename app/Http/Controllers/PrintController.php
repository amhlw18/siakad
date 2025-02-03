<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelNilaiMHS;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    //

    public function print_absen()
    {
        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();
        $matakuliah_id = 'MKU101';
        $prodi_id = 13263;

        $jadwal = ModelDetailJadwal::with('prodi_jadwal','jadwal_matakuliah','dosen')
            ->where('tahun_akademik',$tahun_akademik->kode)
            ->where('matakuliah_id', $matakuliah_id)
            ->where('prodi_id', $prodi_id)
            ->first();

        $mhs = ModelKRSMahasiwa::with('krs_mhs')
            ->where('tahun_akademik',20231)
            ->where('matakuliah_id',$matakuliah_id)
            ->where('prodi_id', $prodi_id)
            ->get();

        $tanggal = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'); // Format tanggal Indonesia

        $pdf = Pdf::loadView('print.absen.absen',[
            'jadwal' => $jadwal,
            'mhs' => $mhs,
            'tahun_aktif' => $tahun_akademik,
            'tanggal' => $tanggal,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

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
            ->orderBy('matakuliah_id', 'asc')
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

        $prodi_id = $mhs->prodi_id;

        $ka_prodi = ModelProdi::with('dosen')
            ->where('kode_prodi',$prodi_id)
            ->first();

        $foto = User::where('user_id', $nim)->first();

        $tanggal = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'); // Format tanggal Indonesia


        $pdf = Pdf::loadView('print.khs.khs-mhs',[
            'mhs' => $mhs,
            'khs_mhs' => $khs_mhs,
            'jumlah_sks' => $jumlah_sks,
            'jumlah_mk' => $jumlah_mk,
            'ips' => $ips,
            'tahun_akademik' => $tahun_akademik,
            'ka_prodi' => $ka_prodi,
            'foto' => $foto,
            'tanggal' => $tanggal,
        ]);

        return $pdf->stream();
    }

    public function print_transkrip_nilai(Request $request)
    {
        $nim = $request->nim;

        $mhs = ModelMahasiswa::with('prodi_mhs')
            ->where('nim', $nim)
            ->first();

        $prodi_id = $mhs->prodi_id;

        $ka_prodi = ModelProdi::with('dosen')
            ->where('kode_prodi',$prodi_id)
            ->first();

        $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $nim)
            ->orderBy('matakuliah_id', 'asc')
            ->get();

        $validasi_kosong_khs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $nim)
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

            $total_sks = ModelNilaiMHS::where('nim',$nim)
                ->sum('sks');

            $total_nilai = ModelNilaiMHS::where('nim', $nim)
                ->sum('total_nilai');

            $ips = $total_nilai/$jumlah_sks;
            $ips = number_format($ips, 2,'.','');
        }

        $foto = User::where('user_id', $nim)->first();

        $tanggal = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'); // Format tanggal Indonesia

        $pdf = Pdf::loadView('print.transkrip-nilai.transkrip-nilai',[
            'mhs' => $mhs,
            'khs_mhs' => $khs_mhs,
            'jumlah_sks' => $jumlah_sks,
            'total_sks' => $total_sks,
            'jumlah_mk' => $jumlah_mk,
            'ips' => $ips,
            'ka_prodi' => $ka_prodi,
            'foto' => $foto,
            'tanggal' => $tanggal,
        ]);

        return $pdf->stream();
    }
}
