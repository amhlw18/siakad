<?php

namespace App\Http\Controllers;

use App\Models\ModelDosen;
use App\Models\ModelMahasiswa;
use App\Models\ModelPAMahasiswa;
use App\Models\ModelProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PAMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 1){
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

        if (Auth::user()->role == 5){
            $prodi_id = Auth::user()->prodi;
            $dosens = ModelDosen::with('dosen_homebase')
                ->where('prodi_id',$prodi_id)
                ->get();

            $jumlah_pa = ModelPAMahasiswa::select('nidn', \DB::raw('COUNT(*) as jumlah_mahasiswa'))
                ->groupBy('nidn')
                ->get()
                ->keyBy('nidn'); // Mengubah menjadi array dengan nidn sebagai kunci

            return view('admin.pa-mhs.index', [
                'dosens' => $dosens,
                'jumlah_pa' => $jumlah_pa,
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
        try {

            $validasi = $request->validate([
                'prodi_id' => 'required',
                'nim' => 'required|unique:model_p_a_mahasiswas,nim',
                'nidn' => 'required',
            ],[
                'nim.unique' => 'Mahasiswa sudah ditambahkan !',
            ]);

            ModelPAMahasiswa::create($validasi);
            return response()->json(['success' => 'Mahasiswa berhsil ditambahkan !']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan mahasiswa, coba lagi!'], 500);
        }

    }

    function filter(Request $request)
    {

        $query = ModelPAMahasiswa::with('pa_prodi','pa_dosen','pa_mhs');
        if ($request->nidn){
            $query->where('nidn', $request->nidn);
        }

        $data = $query->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' =>$item->id,
                'nim' => $item->pa_mhs->nim,
                'nama' => $item->pa_mhs->nama_mhs,
                'angkatan' => $item->pa_mhs->nama_mhs,
            ];
        }));

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
        if (Auth::user()->role == 1){
            $pa = ModelPAMahasiswa::with('pa_prodi','pa_dosen','pa_mhs')
                ->where('nidn', $id)
                ->get();

            $dosen = ModelDosen::where('nidn', $id)->first();
            $prodi_id = $dosen->prodi_id;

            $prodi = ModelProdi::where('kode_prodi',$prodi_id)->first();

            $mahasiswa = ModelMahasiswa::with('prodi_mhs')
                ->where('prodi_id', $prodi_id)
                ->get();

            return view('admin.pa-mhs.show',[
                'mahasiswa' => $mahasiswa,
                'pas' => $pa,
                'dosen' => $dosen,
                'mahasiswa' => $mahasiswa,
                'prodi' => $prodi,
            ]);
        }

        if (Auth::user()->role == 5){
            $prodi_id = Auth::user()->prodi;
            $pa = ModelPAMahasiswa::with('pa_prodi','pa_dosen','pa_mhs')
                ->where('nidn', $id)
                ->get();

            $dosen = ModelDosen::where('nidn', $id)->first();
            $prodi = ModelProdi::where('kode_prodi',$prodi_id)->first();

            $mahasiswa = ModelMahasiswa::with('prodi_mhs')
                ->where('prodi_id', $prodi_id)
                ->get();

            return view('admin.pa-mhs.show',[
                'mahasiswa' => $mahasiswa,
                'pas' => $pa,
                'dosen' => $dosen,
                'mahasiswa' => $mahasiswa,
                'prodi' => $prodi,
            ]);
        }

        //$mahasiswa = ModelMahasiswa::all();

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
        try {

            $data = ModelPAMahasiswa::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil dihapus dari list PA.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
