<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $dosen = ModelDosen::where('nidn',Auth::user()->user_id)->first();
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $mahasiswa = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
            ->where('matakuliah_id',$id)
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->get();


        return view('admin.penilaian.show',[
            'mahasiswa'=> $mahasiswa,
            'tahun' => $tahun_aktif,
            'dosen' => $dosen,
        ]);
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
