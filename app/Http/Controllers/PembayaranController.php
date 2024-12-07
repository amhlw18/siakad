<?php

namespace App\Http\Controllers;

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
        // Mengambil semua data tahun akademik
        $tahun_akademiks = ModelTahunAkademik::orderByDesc('status')
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        // Cari tahun akademik dengan status aktif
        $tahun_aktif = $tahun_akademiks->firstWhere('status', 1);

        // Filter data pembayaran berdasarkan tahun aktif
        $pembayarans = ModelPembayaran::with(['pembayaran_mhs', 'prodi_pembayaran', 'tahun_akademik_pembayaran'])
            ->when($tahun_aktif, function ($query) use ($tahun_aktif) {
                return $query->where('tahun_akademik', $tahun_aktif->id);
            })
            ->get();

        return view('admin.pembayaran.index', [
            'pembayarans' => $pembayarans,
            'tahun_akademiks' => $tahun_akademiks,
            'prodis' => ModelProdi::get(),
            'tahun_aktif_id' => $tahun_aktif->id ?? null,
        ]);
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
            $query->where('id', $request->tahun);
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
