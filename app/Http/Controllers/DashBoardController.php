<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelNilaiMHS;
use App\Models\ModelPAMahasiswa;
use App\Models\ModelPembayaran;
use App\Models\ModelStatusKRS;
use App\Models\ModelTahunAkademik;
use Carbon\Carbon;
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
                'tahun' => $tahun_aktif,
            ]);
        }

        if (Auth::user()->role == 5){
            $prodi_id = Auth::user()->prodi;

            $jumlah_mhs = ModelMahasiswa::where('prodi_id',$prodi_id)
                ->where('status','AKTIF')
                ->count();

            $jumlah_alumni = ModelMahasiswa::where('prodi_id', $prodi_id)
                ->where('status','Lulus')
                ->count();

            $jumlah_dosen = ModelDosen::where('prodi_id',$prodi_id)->count();

            $belum_krs = ModelStatusKRS::with('status_krs_mhs','status_krs_prodi')
                ->where('prodi_id', $prodi_id)
                ->where('dikunci', 0)
                ->get();

            $belum_bayar = ModelPembayaran::with('pembayaran_mhs')
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->where('prodi_id', $prodi_id)
                ->where('is_bayar', 0)
                ->get();

            return view('admin.index',[
                'jumlah_mhs' => $jumlah_mhs,
                'jumlah_dosen' => $jumlah_dosen,
                'jumlah_alumni' => $jumlah_alumni,
                'tahun' => $tahun_aktif,
                'belum_krs' => $belum_krs,
                'belum_bayar' => $belum_bayar,
            ]);
        }

        return view('admin.index',[
            'tahun' => $tahun_aktif,
        ]);

    }

    public function detailPA($id)
    {

        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $mhs = ModelMahasiswa::with('prodi_mhs')->where('nim', $id)->first();
        $smt_mhs = ModelPembayaran::where('nim', $id)->count();

        $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $id)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->get();

        $validasi_kosong_khs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
            ->where('nim', $id)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->first();

        $jumlah_sks =0;
        $jumlah_mk =0;
        $ips =0;

        if ($validasi_kosong_khs){
            $jumlah_mk = ModelNilaiMHS::where('nim', $id)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->count('matakuliah_id');

            $jumlah_sks = ModelNilaiMHS::where('nim', $id)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->sum('sks');

            $total_nilai = ModelNilaiMHS::where('nim', $id)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->sum('total_nilai');

            $ips = $total_nilai/$jumlah_sks;
            $ips = number_format($ips, 2,'.','');
        }

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
                $pesan = 'Periode KRS berlangsung '.' s/d ' . $tanggalAkhir->format('d-m-Y') . '.';
                $periode = true;
                break; // Keluar dari loop jika sudah menemukan periode yang sesuai
            }elseif ($tanggalSekarang->lessThan($tanggalAwal)) {
                // Jika periode belum dimulai
                $pesan = 'Periode KRS akan dimulai pada tanggal ' . $tanggalAwal->format('d-m-Y') . '.';
                $periode = false;
                break;
            } elseif ($tanggalSekarang->greaterThan($tanggalAkhir)) {
                // Jika periode telah berakhir
                $pesan = 'Periode KRS telah berakhir pada tanggal ' . $tanggalAkhir->format('d-m-Y') . '.';
                $periode = false;
            }
        }


        $status_krs = ModelStatusKRS::where('nim',$id)->first();

        $krs_mhs = ModelKRSMahasiwa::with('krs_matkul','krs_mhs')
            ->where('nim',$id)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        return view('dosen.penilaian.detail-penilaian',[
            'mhs' => $mhs,
            'tahun' => $tahun_aktif,
            //return khs
            'khs_mhs' => $khs_mhs,
            'jumlah_sks' => $jumlah_sks,
            'jumlah_mk' => $jumlah_mk,
            'ips' => $ips,
            'smt_mhs' => $smt_mhs,
            //return krs
            'status_krs' => $status_krs,
            'krs_mhs' => $krs_mhs,
            'status_krs' => $status_krs,
            'pesan' => $pesan,
            'periode' => $periode,
        ]);
    }

    public function simpanKRS(Request $request)
    {
        try {

            $nim = $request->nim;
            $tahun = $request->tahun_akademik;

            $krs_mhs = ModelKRSMahasiwa::with('krs_matkul','krs_mhs')
                ->where('nim',$nim)
                ->where('tahun_akademik',$tahun)
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });

            foreach ($krs_mhs as $item){
                ModelNilaiMHS::create([
                    'tahun_akademik' => $item->tahun_akademik,
                    'matakuliah_id' => $item->matakuliah_id,
                    'sks' => $item->total_sks,
                    'nim' => $item->nim,
                    'total_nilai' => '0',
                    'nilai_angka' => '0',
                    'nilai_huruf' => 'E',
                ]);
            }

            $data = [
                'nim' => $nim,
                'dikunci' => 1,
                'disetujui' => 1,
            ];

            ModelStatusKRS::where('nim', $nim)->update($data);

            return response()->json(['success' => 'KRS berhasil disetujui!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan nilai:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyetujui KRS, coba lagi!'], 500);
        }
    }

    public function batalkanKRS(Request $request)
    {
        try {
            ModelNilaiMHS::where('nim', $request->nim)
                ->where('tahun_akademik',$request->tahun_akademik)
                ->delete();

            $data = [
                'nim' => $request->nim,
                'dikunci' => 1,
                'disetujui' => 0,
            ];

            ModelStatusKRS::where('nim', $request->nim)->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'KRS berhasil dibatalkan !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


}
