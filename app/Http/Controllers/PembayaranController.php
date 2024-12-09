<?php

namespace App\Http\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\ModelPembayaran;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pembayaran.index', [
            'mahasiswa' => ModelMahasiswa::with('prodi_mhs')->get(),
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
//        // Ambil tahun akademik yang aktif
//        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();



//        // Ambil mahasiswa yang belum lunas pada tahun akademik aktif
//        $pembayarans = ModelMahasiswa::whereDoesntHave('pembayaran_mhs', function ($query) use ($tahun_akademik_aktif) {
//            $query->where('tahun_akademik', $tahun_akademik_aktif->id)
//                ->where('is_bayar', 1); // Misalnya 'is_bayar' 1 berarti lunas
//        })->with(['pembayaran_mhs', 'prodi_mhs'])->get();
//
//        // Ambil data tahun akademik untuk dropdown
//        $tahun_akademiks = ModelTahunAkademik::orderByDesc('status') // Prioritaskan status aktif
//        ->orderBy('tahun_akademik', 'desc')
//            ->get();



        return view('admin.pembayaran.create', [
            'mahasiswa' => ModelMahasiswa::with('prodi_mhs')->get(),
            'prodis' => ModelProdi::get(),
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
        $mahasiswa = ModelMahasiswa::with('prodi_mhs')->where('nim', $request->id)->first();
        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();

        // Cek apakah data pembayaran sudah ada
        $existingPembayaran = ModelPembayaran::where('nim', $mahasiswa->nim)
            ->where('tahun_akademik', $tahun_akademik->id)
            ->first();

        if ($existingPembayaran) {
            return response()->json(['error' => 'Data pembayaran dengan NIM dan tahun akademik ini sudah lunas.'], 400);
        }

        $validatedData['is_bayar'] = $request->has('is_bayar') ? 1 : 0;

        ModelPembayaran::create([
           'tahun_akademik'=>$tahun_akademik->id,
           'nim' => $mahasiswa->nim,
           'prodi_id' => $mahasiswa->prodi_id,
            'tgl_bayar' => now()->format('Y-m-d H:i:s'),
            'is_bayar' => $validatedData['is_bayar']
        ]);

        return response()->json(['success' => 'Data berhasil diperbarui']);
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
        $pembayarans = ModelPembayaran::with(['pembayaran_mhs', 'prodi_pembayaran','tahun_akademik_pembayaran'])->where('nim', $id)
            ->orderBy('id', 'desc')
            ->get();
//        $tahun_akademiks = ModelTahunAkademik::orderByDesc('status') // Prioritaskan status aktif
//        ->orderBy('tahun_akademik', 'desc')
//            ->get();

        // Debug
//        foreach ($pembayarans as $pembayaran) {
//            dd($pembayaran->pembayaran_mhs); // Periksa apakah data mahasiswa muncul
//        }

        $mahasiswa = $pembayarans->first()->pembayaran_mhs; // Ambil data mahasiswa dari relasi
        $prodi = $pembayarans->first()->prodi_pembayaran; // Ambil data prodi dari relasi

        return view('admin.pembayaran.show', [
            'pembayarans' => $pembayarans,
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
//        $mahasiswa = Mahasiswa::with('prodi_mhs')->where('nim', $nim)->first();
//
//        if (!$mahasiswa) {
//            return response()->json(['error' => 'Mahasiswa tidak ditemukan.'], 404);
//        }

        $mahasiswa = ModelMahasiswa::with('prodi_mhs')->where('nim', $nim)->first();
        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();

        return response()->json([
            'tahun_akademik' => $tahun_akademik->id,
            'nama_tahun' => $tahun_akademik->tahun_akademik,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama_mhs,
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
