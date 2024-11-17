<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelTahunAkademik;

class TahunAkademikControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tahun-akademik.index',[
            'akademis' => ModelTahunAkademik::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tahun-akademik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validasi = $request->validate([
            'kode' => 'required',
            'tahun_akademik' => 'required',
            'semester' => 'required|string|max:255',
            'tanggal_awal_pembayaran' => 'required|date',
            'tanggal_akhir_pemabayaran' => 'required|date|after_or_equal:tanggal_awal_pembayaran',
            'tanggal_awal_perkuliahan' => 'required|date',
            'tanggal_akhir_perkuliahan' => 'required|date|after_or_equal:tanggal_awal_perkuliahan',
            'krs_awal' => 'required|date',
            'krs_akhir' => 'required|date|after_or_equal:krs_awal',
            'penilaian_awal' => 'required|date',
            'penilaian_akhir' => 'required|date|after_or_equal:penilaian_awal',
            'uts_awal' => 'required|date',
            'uts_akhir' => 'required|date|after_or_equal:uts_awal',
            'uas_awal' => 'required|date',
            'uas_akhir' => 'required|date|after_or_equal:uas_awal',
        ]);

        $validasi['periode_pembayaran'] = $request->tanggal_awal_pembayaran . ' - ' . $request->tanggal_akhir_pemabayaran;
        $validasi['periode_perkuliahan'] = $request->tanggal_awal_perkuliahan . ' - ' . $request->tanggal_akhir_perkuliahan;

        $validasi['periode_krs'] = $request->krs_awal . ' - ' . $request->krs_akhir;
        $validasi['periode_penilaian'] = $request->penilaian_awal . ' - ' . $request->penilaian_akhir;

        $validasi['periode_uts'] = $request->uts_awal . ' - ' . $request->uts_akhir;
        $validasi['periode_uas'] = $request->uas_awal . ' - ' . $request->uas_akhir;

        ModelTahunAkademik::create($validasi);

        return redirect('/dashboard/tahun-akademik')->with('success', 'Tahun akademik berhasil di tambahkan !');
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
         $akademik = ModelTahunAkademik::where('id', $id)->first();
         return view('admin.tahun-akademik.edit',[
            'akademik' => $akademik,
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
        $validasi = $request->validate([
            'kode' => 'required',
            'tahun_akademik' => 'required',
            'semester' => 'required|string|max:255',
            'tanggal_awal_pembayaran' => 'required|date',
            'tanggal_akhir_pemabayaran' => 'required|date|after_or_equal:tanggal_awal_pembayaran',
            'tanggal_awal_perkuliahan' => 'required|date',
            'tanggal_akhir_perkuliahan' => 'required|date|after_or_equal:tanggal_awal_perkuliahan',
            'krs_awal' => 'required|date',
            'krs_akhir' => 'required|date|after_or_equal:krs_awal',
            'penilaian_awal' => 'required|date',
            'penilaian_akhir' => 'required|date|after_or_equal:penilaian_awal',
            'uts_awal' => 'required|date',
            'uts_akhir' => 'required|date|after_or_equal:uts_awal',
            'uas_awal' => 'required|date',
            'uas_akhir' => 'required|date|after_or_equal:uas_awal',
        ]);

        $validate['kode'] = $request->kode;
        $validate['tahun_akademik'] = $request->tahun_akademik;
        $validate['semester'] = $request->semester;
        $validate['periode_pembayaran'] = $request->tanggal_awal_pembayaran . ' - ' . $request->tanggal_akhir_pemabayaran;
        $validate['periode_perkuliahan'] = $request->tanggal_awal_perkuliahan . ' - ' . $request->tanggal_akhir_perkuliahan;
        $validate['periode_krs'] = $request->krs_awal . ' - ' . $request->krs_akhir;
        $validate['periode_penilaian'] = $request->penilaian_awal . ' - ' . $request->penilaian_akhir;
        $validate['periode_uts'] = $request->uts_awal . ' - ' . $request->uts_akhir;
        $validate['periode_uas'] = $request->uas_awal . ' - ' . $request->uas_akhir;

        // Defaultkan status ke 0 jika checkbox tidak dicentang
        $validate['status'] = $request->has('status') ? 1 : 0;
    
        ModelTahunAkademik::where('id', $id)->update($validate);

        return redirect('/dashboard/tahun-akademik')->with('success', 'Tahun akademik berhasil di ubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ModelTahunAkademik::where('id', $id)->first();
        
        $data->delete();

        return redirect('/dashboard/tahun-akademik')->with('success', 'Tahun akademik berhasil di hapus !');
    }
}
