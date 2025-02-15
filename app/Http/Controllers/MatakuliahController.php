<?php

namespace App\Http\Controllers;

use App\Models\ModelProdi;
use Illuminate\Http\Request;
use App\Models\ModelKurikulum;
use App\Models\ModelMatakuliah;
use Yajra\DataTables\Facades\DataTables;

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
        $prodi = ModelProdi::all();
        $kurikulum = ModelKurikulum::where('status', 1)->get();

        return view('admin.matakuliah.index',[
            'matkuls' => ModelMatakuliah::get(),
            'prodis' => $prodi,
            'kurikulums' => $kurikulum,
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

    public function filterData(Request $request)
    {

        $query = ModelMatakuliah::query();

        if ($request->prodi) {
            $query->where('kode_prodi', $request->prodi);
        }

        if ($request->kurikulum) {
            $query->where('kurikulum_id', $request->kurikulum);
        }

        return DataTables::of($query)
            ->addIndexColumn() // Menambahkan nomor index
            ->addColumn('action', function ($row) {
                return '
            <form action="/dashboard/matakuliah/' . $row->kode_mk . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                <input type="hidden" name="_method" value="DELETE">
                <a href="/dashboard/matakuliah/' . $row->kode_mk . '/edit" class="btn btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="return confirm(\'Yakin akan menghapus?\')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        ';
            })
            ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
            ->make(true);
    }

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
            'sks_teori' => 'required|numeric',
            'sks_praktek' => 'required|numeric',
            'sks_lapangan' => 'required|numeric',
            'kelompok_mk' => 'nullable',
            'jenis_kelompok' => 'nullable',
            'jenis_mk' => 'nullable',
            'status_mk' => 'nullable',
            'silabus_mk' => 'nullable',
            'sap_mk' => 'nullable',
            'bahan_ajar' => 'nullable',
            'diktat' => 'nullable',
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

        $id =decrypt($id);
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
            'sks_teori' => 'required|numeric',
            'sks_praktek' => 'required|numeric',
            'sks_lapangan' => 'required|numeric',
            'kelompok_mk' => 'nullable',
            'jenis_kelompok' => 'nullable',
            'jenis_mk' => 'nullable',
            'status_mk' => 'nullable',
            'silabus_mk' => 'nullable',
            'sap_mk' => 'nullable',
            'bahan_ajar' => 'nullable',
            'diktat' => 'nullable',
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
        $id =decrypt($id);
        $data = ModelMatakuliah::where('kode_mk',$id)->first();

        $data->delete();

        return redirect('/dashboard/matakuliah')->with('success', 'Matakuliah berhasil di hapus !');
    }
}
