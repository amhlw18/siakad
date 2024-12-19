<?php

namespace App\Http\Controllers;

use App\Models\ModelDosen;
use App\Models\ModelPAMahasiswa;
use Illuminate\Http\Request;

class PAMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = ModelDosen::all();

        // Menghitung jumlah mahasiswa bimbingan per dosen
        $jumlah_pa = ModelPAMahasiswa::select('nidn', \DB::raw('COUNT(*) as jumlah_mahasiswa'))
            ->groupBy('nidn')
            ->get()
            ->keyBy('nidn'); // Mengubah menjadi array dengan nidn sebagai kunci

        return view('admin.pa-mhs.index', [
            'dosens' => $dosens,
            'jumlah_pa' => $jumlah_pa,
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
    }
}
