<?php

namespace App\Http\Controllers;

use App\Models\ModelProdi;
use App\Models\ModelRuangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(ModelRuangan::with('prodi')->get());
        return view('admin.ruangan.index',[
            'ruangans' => ModelRuangan::with('prodi_ruangan')->get()
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
        return view('admin.ruangan.create',[
            'ruangans' => ModelRuangan::get(),
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
            'prodi_id' => 'required',
            'nama_ruangan' => 'required',
            'gedung' => 'required',
            'lantai' => 'required',
        ]);

        ModelRuangan::create($validasi);

        return redirect('/dashboard/ruangan')->with('success', 'Ruangan berhasil di tambahkan !');
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
        return view('admin.ruangan.edit',[
            'ruangan' => ModelRuangan::where('id',$id)->first(),
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
        //
        //dd($request->all());
        $validasi = $request->validate([
            'prodi_id' => 'required|',
            'nama_ruangan' => 'required',
            'gedung' => 'required',
            'lantai' => 'required',
        ]);

        ModelRuangan::where('id',$id)->update($validasi);

        return redirect('/dashboard/ruangan')->with('success', 'Ruangan berhasil di ubah !');
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
        //
        $data = ModelRuangan::where('id',$id)->first();

        $data->delete();
        return redirect('/dashboard/ruangan')->with('success', 'Ruangan berhasil di hapus !');
    }
}
