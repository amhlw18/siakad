<?php

namespace App\Http\Controllers;

use App\Models\ModelAspekPenilaian;
use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelKelasMahasiswa;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelNilaiMHS;
use App\Models\ModelNilaiSemester;
use App\Models\ModelTahunAkademik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $dosen = ModelDosen::where('nidn',Auth::user()->user_id)->first();


        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $matakuliah = ModelDetailJadwal::with('jadwal_matakuliah','prodi_jadwal','jadwal_kelas')
            ->where('nidn',$dosen->nidn)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->get()
            //->unique('matakuliah_id')
        ;

        if ($dosen->prodi_id == 15401){
            $matakuliah= $matakuliah->unique('matakuliah_id');
        }

        // Hitung jumlah mahasiswa per mata kuliah berdasarkan tahun akademik aktif
//        $jumlah_mahasiswa = ModelKRSMahasiwa::where('tahun_akademik', $tahun_aktif->kode)
//            ->select('matakuliah_id', \DB::raw('count(*) as total'))
//            ->groupBy('matakuliah_id')
//            ->pluck('total', 'matakuliah_id');


        return view('dosen.penilaian.index',[
            'matakuliah'=> $matakuliah,
            'tahun' => $tahun_aktif,
            'dosen' => $dosen,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validasi = $request->validate([
                'matakuliah_id' => 'required',
                'tahun_akademik' => 'required',
                'aspek_id' => 'required',
                'nim' => 'required',
                'nilai' => 'required',
            ], [
                'aspek_id.required' => "Aspek penilai belum dipilih!",
                'nilai.required' => "Nilai belum diisi!",
            ]);

            $validasi['nilai_angka'] = $validasi['nilai'];
            $validasiInput = ModelNilaiSemester::where('matakuliah_id', $validasi['matakuliah_id'])
                ->where('tahun_akademik', $validasi['tahun_akademik'])
                ->where('aspek_id', $validasi['aspek_id'])
                ->where('nim', $validasi['nim'])
                ->first();


            if ($validasiInput){
                return response()->json(['errors' => 'Aspek penilaian sudah ada !'], 422);
            }

            ModelNilaiSemester::create($validasi);
            return response()->json(['success' => 'Nilai berhasil disimpan!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan nilai:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan nilai, coba lagi!'], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id_kelas)
    {
        $tanggalSekarang = Carbon::today();

        $tahunAkademik = ModelTahunAkademik::where('status', 1)->get();

        $pesan = null;
        $periode = false;
        foreach ($tahunAkademik as $item) {
            // Pisahkan tanggal awal dan akhir dari kolom periode
            [$tanggalAwal, $tanggalAkhir] = explode(' - ', $item->periode_penilaian);

            // Konversi menjadi format Carbon
            $tanggalAwal = Carbon::parse($tanggalAwal);
            $tanggalAkhir = Carbon::parse($tanggalAkhir);

            //dd($tanggalAwal .' '. $tanggalAkhir);

            //Cek apakah tanggal sistem berada di antara tanggal awal dan akhir
            if ($tanggalSekarang->between($tanggalAwal, $tanggalAkhir)) {
                $pesan = 'Periode penilaian berlangsung '.' s/d ' . $tanggalAkhir;
                $periode = true;
                break; // Keluar dari loop jika sudah menemukan periode yang sesuai
            }elseif ($tanggalSekarang->lessThan($tanggalAwal)) {
                // Jika periode belum dimulai
                $pesan = 'Periode penilaian akan dimulai pada tanggal ' . $tanggalAwal;
                $periode = false;
                break;
            } elseif ($tanggalSekarang->greaterThan($tanggalAkhir)) {
                // Jika periode telah berakhir
                $pesan = 'Periode penilaian telah berakhir pada tanggal ' . $tanggalAkhir;
                $periode = false;
            }
        }

        $matakuliah = ModelMatakuliah::where('kode_mk',$id)->first();

        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

        $mahasiswa = ModelKelasMahasiswa::with('mhs_kelas_mhs')
            ->where('kelas_id',$id_kelas)
            ->orderBy('nim', 'asc')
            ->get();

        $aspek_nilai = ModelAspekPenilaian::where('matakuliah_id', $id)
            ->where('nidn', Auth::user()->user_id)
            ->get();

        return view('dosen.penilaian.show',[
            'mahasiswa'=> $mahasiswa,
            'tahun' => $tahun_aktif,
            'matkul' => $matakuliah,
            'aspeks' => $aspek_nilai,
            'pesan' => $pesan,
            'periode' => $periode,
        ]);
    }

    public function filter($id)
    {
        $nilai = ModelNilaiSemester::find($id);

        return response()->json($nilai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$mk)
    {
        $dosen = ModelDosen::where('nidn',Auth::user()->user_id)->first();
        $mhs = ModelMahasiswa::where('nim', $id)->first();
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $matakuliah = ModelMatakuliah::where('kode_mk',$mk)->first();

        $jumlah_aspek = ModelAspekPenilaian::where('nidn', $dosen->nidn)
            ->where('matakuliah_id', $mk)
            ->count();
        $jumlah_nilai = ModelNilaiSemester::where('nim',$id)
            ->where('matakuliah_id', $mk)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->count();

        $nilai = ModelNilaiSemester::with('nilai_aspek','nilai_mhs')
            ->where('nim',$id)
            ->where('matakuliah_id', $mk)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->get();

        $total_nilai = DB::table('model_nilai_semesters')
            ->where('nim',$id)
            ->where('matakuliah_id', $mk)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->sum('nilai');

        if ($total_nilai >=  79 && $total_nilai >= 100 ){
            $nilai_huruf = 'A';
            $nilai_angka = '4';
        }else if ($total_nilai >=  69 && $total_nilai <= 78){
            $nilai_huruf = 'B';
            $nilai_angka = '3';
        }else if ($total_nilai >=  55 && $total_nilai <= 68){
            $nilai_huruf = 'C';
            $nilai_angka = '2';
        }else if ($total_nilai >=  41 && $total_nilai <= 55){
            $nilai_huruf = 'D';
            $nilai_angka = '1';
        }else if ($total_nilai >=  0 && $total_nilai <= 40){
            $nilai_huruf = 'E';
            $nilai_angka = '0';
        }

        $cek_nilai_mhs = ModelNilaiMHS::where('nim', $id)
            ->where('matakuliah_id',$mk)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->where('status', 1)
            ->first();

        return view('dosen.penilaian.edit',[
            'nilais' => $nilai,
            'mhs' => $mhs,
            'tahun' => $tahun_aktif,
            'matkul' => $matakuliah,
            'total_nilai' => $total_nilai,
            'jml_aspek' => $jumlah_aspek,
            'jml_nilai' => $jumlah_nilai,
            'nilai_huruf' => $nilai_huruf ?? '-',
            'nilai_angka' => $nilai_angka ?? '0',
            'cek_nilai' => $cek_nilai_mhs,
        ]);

    }

    public function simpanNilai(Request $request)
    {
       // \Log::info('Simpan Nilai:', $request->all());
        try {
            $khs_mhs = ModelMatakuliah::where('kode_mk', $request->matakuliah_id)
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->sks_teori ?? 0) +
                        (int) ($item->sks_praktek ?? 0) +
                        (int) ($item->sks_lapangan ?? 0);
                    return $item;
                });

            foreach ($khs_mhs as $item){
                $total_sks = $item->total_sks;
                $total_nilai = $total_sks * $request->nilai_angka;

            }
//
            $validasi_bentrok = ModelNilaiMHS::where('nim', $request->nim)
                ->where('matakuliah_id',$request->matakuliah_id)
                ->where('tahun_akademik',$request->tahun_akademik)
                ->where('status', 1)
                ->first();

            if ($validasi_bentrok){
                return response()->json(['errors' => 'Nilai matakuliah sudah ada !'], 422);
            }

//            ModelNilaiMHS::create([
//                'tahun_akademik' => $request->tahun_akademik,
//                'matakuliah_id' => $request->matakuliah_id,
//                'sks' =>$total_sks,
//                'nim' => $request->nim,
//                'total_nilai' => $total_nilai,
//                'nilai_angka' => $request->nilai_angka,
//                'nilai_huruf' => $request->nilai_huruf,
//            ]);

            $data = [
                'total_nilai'=>$total_nilai,
                'nilai_angka' => $request->nilai_angka,
                'nilai_huruf' => $request->nilai_huruf,
                'status' => 1,
            ];

            ModelNilaiMHS::where('nim', $request->nim)
                ->where('matakuliah_id', $request->matakuliah_id)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->update($data);

            return response()->json(['success' => 'Nilai berhasil disimpan!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan nilai:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memperbarui nilai, coba lagi!'], 500);
        }
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
        try {

            $validasi = $request->validate([
                'matakuliah_id' => 'required',
                'tahun_akademik' => 'required',
                'aspek_id' => 'required',
                'nim' => 'required',
                'nilai' => 'required',
            ], [
                'aspek_id.required' => "Aspek penilai belum dipilih!",
                'nilai.required' => "Nilai belum diisi!",
            ]);

            $validasi['nilai_angka'] = $validasi['nilai'];

            $nilai_mhs = ModelNilaiSemester::find($id);
            $nilai_mhs->update($validasi);

            return response()->json(['success' => 'Nilai berhasil diperbarui!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan nilai:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memperbarui nilai, coba lagi!'], 500);
        }
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
        //
        try {

            $data = ModelNilaiSemester::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data aspek penilaian berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function hapusNilai(Request $request)
    {
        try {
//            $data = ModelNilaiMHS::where('nim', $request->nim)
//                ->where('matakuliah_id',$request->matakuliah_id)
//                ->where('tahun_akademik',$request->tahun_akademik)
//                ->first();
//
//            $data->delete();

            $data = [
                'status' => 0,
            ];

            ModelNilaiMHS::where('nim', $request->nim)
                ->where('matakuliah_id', $request->matakuliah_id)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Nilai berhasil direset !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
