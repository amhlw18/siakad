<?php

namespace App\Http\Controllers;

use App\Models\ModelProdi;
use Illuminate\Http\Request;
use App\Models\ModelKurikulum;
use App\Models\ModelMatakuliah;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.matakuliah.index',[
            'matkuls' => ModelMatakuliah::get()
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
        return view('admin.matakuliah.create',[
            'kurikulums' => ModelKurikulum::get(),
            'prodis' => ModelProdi::get()
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
        //
         //dd($request->all());
         $validasi = $request->validate([
            'kurikulum_id' => 'required',
             'kode_prodi' => 'required',
            'kode_mk' => 'required|unique:model_matakuliahs,kode_mk',
            'nama_mk' => 'required|unique:model_matakuliahs,nama_mk',
            'semester' => 'required|integer',
            'sks_teori' => 'required|integer',
            'sks_praktek' => 'required|integer',
            'sks_lapangan' => 'required|integer',
            'kelompok_mk' => 'required',
            'jenis_kelompok' => 'required',
            'jenis_mk' => 'required',
            'status_mk' => 'required',
            'silabus_mk' => 'required',
            'sap_mk' => 'required',
            'bahan_ajar' => 'required',
            'diktat' => 'required',
        ]);

        ModelMatakuliah::create($validasi);

        return redirect('/dashboard/matakuliah')->with('success', 'Matakuliah berhasil di tambahkan !');

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

        return view('admin.matakuliah.edit',[
            'kurikulums' => ModelKurikulum::all(),
            'matkul' => ModelMatakuliah::where('kode_mk', $id)->first(),
            'prodis' => ModelProdi::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_kurikulum)
    {

         //dd($request->all());
         $validasi = $request->validate([
            'kurikulum_id' => 'required',
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'semester' => 'required|integer',
            'sks_teori' => 'required|integer',
            'sks_praktek' => 'required|integer',
            'sks_lapangan' => 'required|integer',
            'kelompok_mk' => 'required',
            'jenis_kelompok' => 'required',
            'jenis_mk' => 'required',
            'status_mk' => 'required',
            'silabus_mk' => 'required',
            'sap_mk' => 'required',
            'bahan_ajar' => 'required',
            'diktat' => 'required',
        ]);

        ModelMatakuliah::where('kode_mk', $kode_kurikulum)->update($validasi);

        return redirect('/dashboard/matakuliah')->with('success', 'Matakuliah berhasil di ubah !');
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
        $data = ModelMatakuliah::where('kode_mk',$id)->first();

        $data->delete();

        return redirect('/dashboard/matakuliah')->with('success', 'Matakuliah berhasil di hapus !');
    }
}
