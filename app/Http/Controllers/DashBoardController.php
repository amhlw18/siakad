<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelNilaiMHS;
use App\Models\ModelPAMahasiswa;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//php artisan serve --host 192.168.1.39 --port 8001

class DashBoardController extends Controller
{


    public function index()
    {
        $jumlah_matakuliah_dosen =null;
        $jadwal_dosen = null;
        $jumlah_pa = null;

        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

        if (Auth::user()->role == 3){
            $nidn = Auth::user()->user_id;
            $jumlah_matakuliah_dosen = ModelDetailJadwal::where('nidn',$nidn)
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->count();

            $jadwal_dosen = ModelDetailJadwal::with('prodi_jadwal',
                'jadwal_matakuliah','jadwal_kelas','jadwal_ruangan')
                ->where('nidn', $nidn)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->get();

            $jumlah_pa = ModelPAMahasiswa::where('nidn',$nidn)->count();

            $bimbingan_akademik = ModelPAMahasiswa::with('pa_prodi','pa_mhs','pa_krs')->where('nidn',$nidn)->get();



            return view('admin.index',[
                'matkul_dosen' => $jumlah_matakuliah_dosen,
                'jadwal_dosen' => $jadwal_dosen,
                'jumlah_pa' => $jumlah_pa,
                'tahun' => $tahun_aktif,
                'pa' => $bimbingan_akademik,
            ]);
        }

        return view('admin.index',[

        ]);

    }

    public function detailsPA($id)
    {
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $mhs = ModelMahasiswa::with('prodi_mhs')->where('nim', $id)->first();

        $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $id)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->nilai_matakuliah_mhs->sks_teori ?? 0) +
                    (int) ($item->nilai_matakuliah_mhs->sks_praktek ?? 0) +
                    (int) ($item->nilai_matakuliah_mhs->sks_lapangan ?? 0);
                return $item;
            });

        return view('dosen.penilaian.detail-penilaian',[
            'mhs' => $mhs,
            'khs_mhs' => $khs_mhs,
            'tahun' => $tahun_aktif,
        ]);
    }
}
