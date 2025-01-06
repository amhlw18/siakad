<?php

namespace App\Http\Controllers;

use App\Models\ModelDosen;
use App\Models\ModelProdi;
use Carbon\Carbon;
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
            'dosens' => ModelDosen::get()
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
            'nama_dosen' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'alamat' => 'required|string|max:255',
            'tgl_kerja' => 'nullable',
            'ikatan_kerja' => 'required|string|max:50',
            'pendidikan' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'jabatan_akademik' => 'required|string|max:50',
            'jabatan_struktural' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
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
       $dosen = ModelDosen::where('nidn',$id)->first();

       //dd($dosen->tgl_lahir);
       // $dosen->tgl_lahir = Carbon::createFromFormat('d-m-Y', $dosen->tgl_lahir)->format('Y-m-d');

        return view('admin.dosen.edit',[
            'dosen' => $dosen,
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
            'nidn' => 'required',
            'nama_dosen' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'alamat' => 'required|string|max:255',
            'tgl_kerja' => 'nullable',
            'ikatan_kerja' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'jabatan_akademik' => 'nullable|string|max:50',
            'jabatan_struktural' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
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
