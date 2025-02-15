<?php

namespace App\Http\Controllers;

use App\Models\ModelKelas;
use App\Models\ModelProdi;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.kelas.index',[
            'kelass' => ModelKelas::with('prodi_kelas')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create',[
            'kelas' => ModelKelas::get(),
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
            'nama_kelas' => 'required',
            'program' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        ModelKelas::create($validasi);

        return redirect('/dashboard/kelas')->with('success', 'Kelas berhasil di tambahkan !');
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
        $id =decrypt($id);
        return view('admin.kelas.edit',[
            'kelas' => ModelKelas::where('id',$id)->first(),
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

        $validasi = $request->validate([
            'prodi_id' => 'required',
            'nama_kelas' => 'required',
            'program' => 'required',
            'kapasitas' => 'required',
        ]);


        $validasi['aktif'] = $request->has('aktif') ? 1 : 0;

        ModelKelas::where('id', $id)->update($validasi);

        return redirect('/dashboard/kelas')->with('success', 'Kelas berhasil di tambahkan !');
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
        $id =decrypt($id);
        $data = ModelKelas::where('id',$id)->first();

        $data->delete();
        return redirect('/dashboard/kelas')->with('success', 'Kelas berhasil di hapus !');
    }
}
