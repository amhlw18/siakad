<?php

namespace App\Http\Controllers;

use App\Models\ModelAspekPenilaian;
use App\Models\ModelDetailJadwal;
use App\Models\ModelMatakuliah;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspekPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$aspek_nilai = ModelAspekPenilaian::with('aspek_penilaian')->where('matakuliah_id','1')->get();
        $aspek_nilai = ModelAspekPenilaian::with('aspek_penilaian')->get();

        if (Auth::user()->role == 3){
            $nidn =Auth::user()->user_id;

            $matakuliah = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
                'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
                ->where('tahun_akademik',1)
                ->where('nidn', $nidn)->get();

        }else{
            $matakuliah = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
                'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
                ->where('tahun_akademik',1)
                ->get();
        }

        return view('admin.menu-dosen.index',[
           'aspeks' => $aspek_nilai,
            'matakuliah' => $matakuliah,
        ]);
    }

    public function filter(Request $request)
    {

        $query = ModelAspekPenilaian::with('aspek_penilaian');
        $nidn = Auth::user()->user_id;

        if (Auth::user()->role==3){
            if ($request->matkul){
                $query->where('matakuliah_id', $request->matkul)
                    ->where('nidn', $nidn);

            }
        }else{
            if ($request->matkul){
                $query->where('matakuliah_id', $request->matkul);

            }
        }



        $data = $query->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' =>$item->id,
                'aspek' => $item->aspek,
                'bobot' => $item->bobot,

            ];
        }));
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

        $validasi = $request->validate([
            'matakuliah_id' => 'required',
            'nidn' => 'required',
            'nama_dosen' => 'required',
            'aspek' => 'required',
            'bobot' => [
                'required',
                'regex:/^(0(\.[0-9]{1,2})?)$/', // Validasi untuk angka desimal 0 hingga 0.99
            ],
        ], [
            'matakuliah_id.required' => "Matakuliah belum dipilih!",
            'nidn.required' => "Dosen belum dipilih!",
            'nama_dosen.required' => "Nama dosen belum diisi!",
            'aspek.required' => "Aspek belum diisi!",
            'bobot.required' => "Bobot belum diisi!",
            'bobot.regex' => "Bobot harus berupa angka desimal antara 0 hingga 0.99 dengan pemisah titik!",
        ]);


        try {
            ModelAspekPenilaian::create($validasi);
            return response()->json(['success' => 'Aspek penilaian berhasil dibuat!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan aspek penilaian, coba lagi!']);
        }
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
        $aspek = ModelAspekPenilaian::find($id);


        return response()->json($aspek);
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
            'matakuliah_id' => 'required',
            'nidn' => 'required',
            'nama_dosen' => 'required',
            'aspek' => 'required',
            'bobot' => [
                'required',
                'regex:/^(0(\.[0-9]{1,2})?)$/', // Validasi untuk angka desimal 0 hingga 0.99
            ],
        ], [
            'matakuliah_id.required' => "Matakuliah belum dipilih!",
            'nidn.required' => "Dosen belum dipilih!",
            'nama_dosen.required' => "Nama dosen belum diisi!",
            'aspek.required' => "Aspek belum diisi!",
            'bobot.required' => "Bobot belum diisi!",
            'bobot.regex' => "Bobot harus berupa angka desimal antara 0 hingga 0.99 dengan pemisah titik!",
        ]);


        $aspek = ModelAspekPenilaian::find($id);
        try {
            $aspek->update($validasi);
            return response()->json(['success' => 'Aspek penilaian berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengubah aspek penilaian, coba lagi!']);
        }
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

            $data = ModelAspekPenilaian::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data aspek penilaian berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
