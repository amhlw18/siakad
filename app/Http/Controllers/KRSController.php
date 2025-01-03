<?php

namespace App\Http\Controllers;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KRSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role == 1){

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'mahasiswa' => $mhs,

            ]);
        }

        if (Auth::user()->role == 4){

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'mahasiswa' => $mhs,

            ]);
        }

        if (Auth::user()->role == 5){
            $prodi_id = Auth::user()->prodi;
            $prodi = ModelProdi::where('kode_prodi', $prodi_id)->first();
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->where('prodi_id', $prodi_id)
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'prodi' => $prodi,
                'mahasiswa' => $mhs,
            ]);
        }
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
        if (Auth::user()->role == 1 || Auth::user()->role == 5){

            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
            $tahun_akademik = ModelTahunAkademik::all();
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $id)
                ->first();

            $krs = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->where('nim', $id)
                ->orderBy('matakuliah_id', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });

            return view('mahasiswa.krs.show',[
                'tahun_aktif' => $tahun_aktif,
                'tahun_akademik' => $tahun_akademik,
                'mhs' => $mhs,
                'krs' => $krs,
            ]);
        }


    }

    public function filter_data(Request $request)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 5){
            $query = ModelKRSMahasiwa::with('krs_mhs','krs_matkul')
                ->where('tahun_akademik', $request->tahun)
                ->where('nim', $request->nim)
                ->orderBy('matakuliah_id', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });


            return DataTables::of($query)
                ->addIndexColumn() // Menambahkan nomor index
                ->addColumn('action', function ($row) {
                    return '
        ';
                })
                ->addColumn('matakuliah', function ($row) {
                    return $row->krs_matkul->nama_mk ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->addColumn('semester', function ($row) {
                    return $row->krs_matkul->semester ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
                ->make(true);
        }



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
