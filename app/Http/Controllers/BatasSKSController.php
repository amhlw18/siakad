<?php

namespace App\Http\Controllers;

use App\Models\ModelBatasSKS;
use App\Models\ModelProdi;
use Illuminate\Http\Request;

class BatasSKSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.batas-sks.index',[
            'batass' => ModelBatasSKS::with('prodi_batas_sks')->get()
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
        return view('admin.batas-sks.create',[
            'batas' => ModelBatasSKS::get(),
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
        // Validasi input
        $validasi = $request->validate([
            'prodi_id' => 'required',
            'ipk_min' => 'required|numeric|min:0|max:4',
            'ipk_max' => 'required|numeric|min:0|max:4|gte:ipk_min',
            'jumlah_sks' => 'required|integer',
        ]);

        // Format IPK menjadi dua angka di belakang koma
        $validasi['ipk_min'] = number_format($validasi['ipk_min'], 2, '.', '');
        $validasi['ipk_max'] = number_format($validasi['ipk_max'], 2, '.', '');

        ModelBatasSKS::create($validasi);

        return redirect('/dashboard/batas-sks')->with('success', 'Batas SKS berhasil di tambahkan !');
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
        $id = decrypt($id);
        return view('admin.batas-sks.edit',[
            'batas' => ModelBatasSKS::where('id',$id)->first(),
            'prodis' => ModelProdi::get()
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
            'prodi_id' => 'required',
            'ipk_min' => 'required|numeric|min:0|max:4',
            'ipk_max' => 'required|numeric|min:0|max:4|gte:ipk_min',
            'jumlah_sks' => 'required|integer',
        ]);

        // Format IPK menjadi dua angka di belakang koma
        $validasi['ipk_min'] = number_format($validasi['ipk_min'], 2, '.', '');
        $validasi['ipk_max'] = number_format($validasi['ipk_max'], 2, '.', '');

        ModelBatasSKS::where('id', $id)->update($validasi);


        return redirect('/dashboard/batas-sks')->with('success', 'Batas SKS berhasil di ubah !');
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
        $id = decrypt($id);
        $data = ModelBatasSKS::where('id',$id)->first();

        $data->delete();
        return redirect('/dashboard/batas-sks')->with('success', 'Batas SKS berhasil di hapus !');
    }
}
