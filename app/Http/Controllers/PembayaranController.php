<?php

namespace App\Http\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\ModelPembayaran;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = ModelPembayaran::with(['pembayaran_mhs', 'prodi_pembayaran'])->get();
        $tahun_akademiks = ModelTahunAkademik::orderByDesc('status') // Prioritaskan status aktif
        ->orderBy('tahun_akademik', 'desc')
            ->get();

        // Debug
//        foreach ($pembayarans as $pembayaran) {
//            dd($pembayaran->pembayaran_mhs); // Periksa apakah data mahasiswa muncul
//        }

        return view('admin.pembayaran.index', [
            'tahun_akademiks'=>$tahun_akademiks,
            'prodis' => ModelProdi::get()
        ],
            compact('pembayarans'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $query = ModelPembayaran::with(['pembayaran_mhs', 'prodi_pembayaran']);

        if ($request->tahun) {
            $query->where('tahun_akademik', $request->tahun);
        }

        if ($request->prodi) {
            $query->where('prodi_id', $request->prodi);
        }

        $pembayarans = $query->get();

        return response()->json($pembayarans->map(function ($pembayaran) {
            return [
                'nim' => $pembayaran->pembayaran_mhs->nim,
                'nama_mhs' => $pembayaran->pembayaran_mhs->nama_mhs,
                'nama_prodi' => $pembayaran->prodi_pembayaran->nama_prodi,
                'is_bayar' => $pembayaran->is_bayar,
            ];
        }));
    }




    public function create()
    {
        // Ambil tahun akademik yang aktif
        $tahun_akademik_aktif = ModelTahunAkademik::where('status', 1)->first();

        if (!$tahun_akademik_aktif) {
            return redirect()->back()->with('error', 'Tidak ada tahun akademik yang aktif.');
        }

        // Ambil mahasiswa yang belum lunas pada tahun akademik aktif
        $pembayarans = ModelMahasiswa::whereDoesntHave('pembayaran_mhs', function ($query) use ($tahun_akademik_aktif) {
            $query->where('tahun_akademik', $tahun_akademik_aktif->id)
                ->where('is_bayar', 1); // Misalnya 'is_bayar' 1 berarti lunas
        })->with(['pembayaran_mhs', 'prodi_mhs'])->get();

        // Ambil data tahun akademik untuk dropdown
        $tahun_akademiks = ModelTahunAkademik::orderByDesc('status') // Prioritaskan status aktif
        ->orderBy('tahun_akademik', 'desc')
            ->get();

        return view('admin.pembayaran.create', [
            'tahun_akademiks' => $tahun_akademiks,
            'prodis' => ModelProdi::get(),
        ], compact('pembayarans'));
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
