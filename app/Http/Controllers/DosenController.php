<?php

namespace App\Http\Controllers;

use App\Models\ModelDosen;
use App\Models\ModelProdi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.dosen.index',[
            'dosens' => ModelDosen::with('prodi')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dosen.create',[
            'dosen' => ModelDosen::get(),
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
            'nidn' => 'required|unique:model_dosens,nidn',
            'nama_dosen' => 'required',
            'gelar_depan' => 'string',
            'gelar_belakang' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required',
            'email' => 'string',
            'prodi_id' => 'required',
            'alamat' => 'required',
            'tgl_kerja' => 'string',
            'ikatan_kerja' => 'required',
            'status' => 'required',
            'jabatan_akademik' => 'required',
            'jabatan_struktural' => 'required',
            'golongan' => 'required',
        ]);


        ModelDosen::create($validasi);

        return redirect('/dashboard/data-dosen')->with('success', 'Dosen berhasil di tambahkan !');
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
        return view('admin.dosen.edit',[
            'dosen' => ModelKelas::where('nidn',$id)->first(),
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
        //dd($request->all());
        $validasi = $request->validate([
            'nidn' => 'required|unique:model_dosens,nidn',
            'nama_dosen' => 'required',
            'gelar_depan' => 'string',
            'gelar_belakang' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required',
            'email' => 'string',
            'prodi_id' => 'required',
            'alamat' => 'required',
            'tgl_kerja' => 'string',
            'ikatan_kerja' => 'required',
            'status' => 'required',
            'jabatan_akademik' => 'required',
            'jabatan_struktural' => 'required',
            'golongan' => 'required',
        ]);


        ModelDosen::where('nidn',$id)->update($validasi);

        return redirect('/dashboard/data-dosen')->with('success', 'Dosen berhasil di ubah !');
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
        $data = ModelDosen::where('nidn',$id)->first();

        $data->delete();
        return redirect('/dashboard/data-dosen')->with('success', 'Dosen berhasil di hapus !');
    }
}
