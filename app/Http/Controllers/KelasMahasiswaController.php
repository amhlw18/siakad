<?php

namespace App\Http\Controllers;

use App\Models\ModelKelas;
use App\Models\ModelKelasMahasiswa;
use App\Models\ModelMahasiswa;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas_mhs =ModelKelasMahasiswa::with(
            'prodi_kelas_mhs','mhs_kelas_mhs',
            'kelas_mahasiswa')->get();
        //

        $cekData = $kelas_mhs->first();
        $nim = $cekData ? $cekData->nim : null;


        return view('admin.kelas-mahasiswa.index',[
            'mahasiswa' => $kelas_mhs,
            'prodis'=>ModelProdi::get(),
            'nim'=>$nim,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $query = ModelKelasMahasiswa::with(
            'prodi_kelas_mhs',
            'mhs_kelas_mhs',
            'kelas_mahasiswa'
        );

        // Tambahkan kondisi filter jika ada nilai prodi
        if ($request->prodi){
            $query->where('prodi_id', $request->prodi);
        }


        // Filter berdasarkan tahun_masuk (relasi ke tabel mahasiswa)
        if ($request->tahun){
            $query->whereHas('mhs_kelas_mhs', function ($subQuery) use ($request) {
                $subQuery->where('tahun_masuk', $request->tahun);
            });
        }

        $data = $query->get();

        // Format data untuk respon JSON
        return response()->json($data->map(function ($item) {
            return [
                'nim' => $item->nim,
                'nama_mhs' => $item->mhs_kelas_mhs->nama_mhs ?? '-',
                'program' => $item->kelas_mahasiswa->program ?? '-',
                'tahun_masuk' => $item->mhs_kelas_mhs->tahun_masuk ?? '-',
            ];
        }));
    }

    public function create()
    {
        //


        return view('admin.kelas-mahasiswa.create',[
            'mahasiswa'=>ModelMahasiswa::get(),
            'prodis' =>ModelProdi::get(),
            'kelas' =>ModelKelas::get(),
            'tahun_akademis' =>ModelTahunAkademik::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());
        $mahasiswa = ModelMahasiswa::where('prodi_id',$request->prodi_id)
            ->where('status','Aktif')
            ->where('semester_masuk',$request->semester_masuk)
            ->get();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Tidak ditemukan mahasiswa aktif.');
        }

        //$mhs = $mahasiswa->first();
        //dd($request->kelas_id);


        foreach ($mahasiswa as $mhs) {

            $kelas_mhs = ModelKelasMahasiswa::with('prodi_kelas_mhs',
                'mhs_kelas_mhs','kelas_mahasiswa')
                ->where('nim',$mhs->nim)
                ->where('prodi_id', $mhs->prodi_id)
                ->first();


            if ($kelas_mhs) {
                return redirect()->back()->with('error', 'Kelas mahasiswa sudah terdaftar.');
            }

            ModelKelasMahasiswa::create([
                'prodi_id' => $mhs->prodi_id,
                'kelas_id' => $request->kelas_id,
                'nim' => $mhs->nim,
            ]);
        }
        return redirect('/dashboard/kls-mhs')->with('success', 'Kelas mahasiswa berhasil di tambahkan !');

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



    public function deleteAll()
    {
        try {
//            // Hapus semua data pada tabel
            DB::table('model_kelas_mahasiswas')->truncate();

             //Atau menggunakan model (jika ada event Model untuk menghapus)
             //ModelKelasMahasiswa::query()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Semua data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
