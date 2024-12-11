<?php

namespace App\Http\Controllers;

use App\Models\ModelJadwal;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        // Ambil data jadwal, prodi, dan tahun akademik aktif
//        $jadwal = ModelJadwal::with('prodi_jadwal', 'tahun_jadwal')->get();
//        $tahun_akademik = ModelTahunAkademik::where('status', '1')->first();
//
//        if (!$tahun_akademik) {
//            return redirect()->back()->withErrors(['error' => 'Tahun Akademik aktif tidak ditemukan.']);
//        }
//
//        // Ambil semua data program studi
        $prodi = ModelProdi::get();
//
//        // Cek apakah jadwal sudah ada, jika kosong maka buat jadwal baru
//        if ($jadwal->isEmpty()) {
//            foreach ($prodis as $prodi) {
//                ModelJadwal::create([
//                    'prodi_id' => $prodi->kode_prodi,
//                    'tahun_akademik' => $tahun_akademik->id, // Gunakan ID tahun akademik
//                ]);
//            }
//            // Refresh data jadwal setelah input
//            $jadwal = ModelJadwal::with('prodi_jadwal', 'tahun_jadwal')->get();
//        }

        // Kembalikan ke view dengan data yang diperlukan
        return view('admin.jadwal.index', [
            'prodis' => $prodi,
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
