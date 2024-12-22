<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
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
        }

        return view('admin.index',[
            'matkul_dosen' => $jumlah_matakuliah_dosen,
            'jadwal_dosen' => $jadwal_dosen,
            'jumlah_pa' => $jumlah_pa,
            'tahun' => $tahun_aktif,

        ]);
    }
}
