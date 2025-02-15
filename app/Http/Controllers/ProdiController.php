<?php

namespace App\Http\Controllers;

use App\Models\ModelDosen;
use App\Models\ModelProdi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        return view('admin.prodi.index',[
            'prodis' => ModelProdi::with('dosen')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prodi.create',[
        'dosens' => ModelDosen::get()
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
        //
         //dd($request->all());
         $validasi = $request->validate([
            'kode_prodi' => 'required|integer|unique:model_prodis,kode_prodi',
            'nama_prodi' => 'required|unique:model_prodis,nama_prodi',
            'jenjang' => 'required',
            'ka_prodi' => 'required',
        ]);

        ModelProdi::create($validasi);

        return redirect('/dashboard/prodi')->with('success', 'Program studi berhasil di tambahkan !');
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
        $id = decrypt($id);
        return view('admin.prodi.edit',[
            'prodi' => ModelProdi::where('kode_prodi', $id)->first(),
            'dosens' => ModelDosen::all()
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
        //dd($request->all());
        $validasi = $request->validate([
            'kode_prodi' => 'required',
            'nama_prodi' => 'required',
            'jenjang' => 'required',
            'ka_prodi' => 'required',
        ]);

        ModelProdi::where('kode_prodi', $id)->update($validasi);
        return redirect('/dashboard/prodi')->with('success', 'Program studi berhasil di ubah !');
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
        $data = ModelProdi::where('kode_prodi',$id)->first();

        $data->delete();
        return redirect('/dashboard/prodi')->with('success', 'Program studi berhasil di hapus !');
    }
}
