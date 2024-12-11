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
            'prodis' => ModelProdi::get()
        ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $query = ModelMahasiswa::with('prodi_mhs')->where('prodi_id', $request->prodi)
            ->get();

        return response()->json($query->map(function ($query) {
            return [
                'nim' => $query->nim,
                'nama_mhs' => $query->nama_mhs,
                'nama_prodi' => $query->prodi_mhs->nama_prodi,

            ];
        }));
    }




    public function create()
    {
        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();

        // Fallback jika tidak ada tahun akademik aktif
        $tahun = $tahun_akademik->tahun_akademik;
        $smt = $tahun_akademik->semester;
        return view('admin.pembayaran.create', [
            'mahasiswa' => ModelMahasiswa::with('prodi_mhs')->where('status','Aktif')
                ->get(),
            'prodis' => ModelProdi::get(),
            'tahun' => $tahun,
            'smt' =>$smt
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
            ->where('is_bayar','1')
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

        return response()->json(['success' => 'Pembayaran berhasil dilakukan']);
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
            ->orderBy('id', 'desc')->get();

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
//        //
//
//        $mahasiswa = ModelMahasiswa::with('prodi_mhs')->where('nim', $id)->first();
//        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();
//
//        $validatedData['is_bayar'] = $request->has('is_bayar') ? 1 : 0;
//
//        ModelPembayaran::where('nim',$id)
//            ->where('tahun_akademik', $tahun_akademik->id)
//            ->update([
//            'tahun_akademik'=>$tahun_akademik->id,
//            'nim' => $mahasiswa->nim,
//            'prodi_id' => $mahasiswa->prodi_id,
//            'tgl_bayar'=>null,
//            'is_bayar' => '0'
//        ]);
//
//        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();
        $data = ModelPembayaran::where('nim',$id)
            ->where('tahun_akademik', $tahun_akademik->id)->first();

        $data->delete();
        return response()->json(['success' => 'Data berhasil diperbarui']);
    }
}
