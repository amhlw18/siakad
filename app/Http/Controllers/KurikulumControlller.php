<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelKurikulum;
use App\Models\ModelTahunAkademik;

class KurikulumControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kurikulum.index',[
            'kurikulums'=>ModelKurikulum::with('tahun_akademik')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kurikulum.create',[
            'tahun_akademis' => ModelTahunAkademik::all()
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
        //dd($request->all());
        $validasi = $request->validate([
            'tahun_akademik_id' => 'required',
            'kode_kurikulum' => 'required|unique:model_kurikulums,kode_kurikulum',
            'nama_kurikulum' => 'required|unique:model_kurikulums,nama_kurikulum',
            'sks_wajib' => 'required|integer',
            'sks_pilihan' => 'required|integer',
            'jumlah_sks' => 'required|integer',
        ]);

        ModelKurikulum::create($validasi);

        return redirect('/dashboard/kurikulum')->with('success', 'Kurikulum berhasil di tambahkan !');
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
        //$id =decrypt($id);
        $kurikulum = ModelKurikulum::where('kode_kurikulum', $id)->first();
        $tahun_akademik = ModelTahunAkademik::all();
        return view('admin.kurikulum.edit',[
            'kurikulum' => $kurikulum,
            'tahun_akademis' => $tahun_akademik

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
        $validatedData = $request->validate([
            'kode_kurikulum' => 'required|string|max:255',
            'nama_kurikulum' => 'required|string|max:255',
            'sks_wajib' => 'required|integer',
            'sks_pilihan' => 'required|integer',
            'jumlah_sks' => 'required|integer',
            'tahun_akademik_id' => 'required|integer',
        ]);

        // Defaultkan status ke 0 jika checkbox tidak dicentang
        $validatedData['status'] = $request->has('status') ? 1 : 0;

        ModelKurikulum::where('kode_kurikulum', $kode_kurikulum)->update($validatedData);

        return redirect('/dashboard/kurikulum')->with('success', 'Data kurikulum berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$id =decrypt($id);
        $data = ModelKurikulum::where('kode_kurikulum',$id)->first();

        $data->delete();

        return redirect('/dashboard/kurikulum')->with('success', 'Data kurikulum berhasil dihapus.');
    }
}
