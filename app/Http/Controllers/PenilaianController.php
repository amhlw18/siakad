<?php

namespace App\Http\Controllers;

use App\Models\ModelAspekPenilaian;
use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelNilaiSemester;
use App\Models\ModelTahunAkademik;
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
        $matakuliah = ModelDetailJadwal::with('jadwal_matakuliah')
            ->where('nidn',$dosen->nidn)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->get();

        // Hitung jumlah mahasiswa per mata kuliah berdasarkan tahun akademik aktif
        $jumlah_mahasiswa = ModelKRSMahasiwa::where('tahun_akademik', $tahun_aktif->kode)
            ->select('matakuliah_id', \DB::raw('count(*) as total'))
            ->groupBy('matakuliah_id')
            ->pluck('total', 'matakuliah_id');

        return view('admin.penilaian.index',[
            'matakuliah'=> $matakuliah,
            'tahun' => $tahun_aktif,
            'dosen' => $dosen,
            'jumlah_mahasiswa' => $jumlah_mahasiswa,
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
    public function show($id)
    {

        $matakuliah = ModelMatakuliah::where('kode_mk',$id)->first();

        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $mahasiswa = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
            ->where('matakuliah_id',$id)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->get();

        $aspek_nilai = ModelAspekPenilaian::where('matakuliah_id', $id)
            ->where('nidn', Auth::user()->user_id)
            ->get();

        return view('admin.penilaian.show',[
            'mahasiswa'=> $mahasiswa,
            'tahun' => $tahun_aktif,
            'matkul' => $matakuliah,
            'aspeks' => $aspek_nilai,
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

        $mhs = ModelMahasiswa::where('nim', $id)->first();
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $matakuliah = ModelMatakuliah::where('kode_mk',$mk)->first();

        $nilai = ModelNilaiSemester::with('nilai_aspek','nilai_mhs')
            ->where('nim',$id)
            ->where('matakuliah_id', $mk)
            ->where('tahun_akademik', $tahun_aktif->kode)->get();

        $nilai_angka = DB::table('model_nilai_semesters')
            ->where('nim',$id)
            ->where('matakuliah_id', $mk)
            ->where('tahun_akademik', $tahun_aktif->kode)
            ->sum('nilai');

        return view('admin.penilaian.edit',[
            'nilais' => $nilai,
            'mhs' => $mhs,
            'tahun' => $tahun_aktif,
            'matkul' => $matakuliah,
            'total_nilai' => $nilai_angka,
        ]);

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
}
