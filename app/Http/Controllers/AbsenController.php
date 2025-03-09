<?php

namespace App\Http\Controllers;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
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

        $krs_mhs = ModelMahasiswa::with('krs_mhs')->get();


        return view('admin.absen.index',[
            'prodis' => $prodi,
            'krs_mhs' => $krs_mhs,
        ]);
    }

    public function getMatkul($prodiId)
    {
        if ($prodiId == 15401){
            $matkul = ModelMatakuliah::where('kode_prodi', $prodiId)
                ->where('kurikulum_id', '48f1386f-6e78-4f15-ae2b-8774468ffca9')
                ->get();
        }else{
            $matkul = ModelMatakuliah::where('kode_prodi', $prodiId)->get();
        }

        return response()->json($matkul);
    }

//    public function filterData(Request $request)
//    {
//        if (Auth::user()->role==1 || Auth::user()->role == 6){
//            $query = ModelKRSMahasiwa::with('krs_mhs'); // Include relasi 'prodi_mhs'
//
//            if ($request->prodi) {
//                $query->where('prodi_id', $request->prodi)->orderBY('nim','asc');
//            }
//
//            if ($request->angkatan) {
//                $query->where('tahun_masuk', $request->angkatan)->orderBY('nim','asc');
//            }
//
//            return DataTables::of($query)
//                ->addIndexColumn() // Menambahkan nomor index
//                ->addColumn('action', function ($row) {
//                    return '';
//                })
//                ->addColumn('nim', function ($row) {
//                    return $row->krs_mhs->nim ?? '-';
//                }) // Tambahkan kolom 'nama_prodi' ke JSON
//                ->addColumn('nama', function ($row) {
//                    return $row->krs_mhs->nama_mhs ?? '-';
//                })
//                ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
//                ->make(true);
//        }
//
//    }

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
