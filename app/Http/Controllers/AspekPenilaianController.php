<?php

namespace App\Http\Controllers;

use App\Models\ModelAspekPenilaian;
use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
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
        // = ModelAspekPenilaian::with('aspek_penilaian')->get();

        $dosen = ModelDosen::where('nidn', Auth::user()->user_id)->first();
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

        if (Auth::user()->role == 3){
            $nidn =Auth::user()->user_id;

            $matakuliah = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
                'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->where('nidn', $nidn)->get();

        }else{
            $matakuliah = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
                'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->get();
        }

        return view('admin.aspek-nilai.index',[
           'dosen' => $dosen,
            'tahun_aktif' => $tahun_aktif,
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
        try {
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

//            if (Auth::user()->role == 3){
//                ModelAspekPenilaian::create($validasi);
//            }else{
//                $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
//
//                $nidn = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
//                    'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
//                    ->where('tahun_akademik',$tahun_aktif->kode)
//                    ->where('nidn', $request->matakuliah_id)
//                    ->first();
//
//                $validasi['nidn'] = $nidn->dosen->nidn;
//                $validasi['nama_dosen'] = $nidn->dosen->nama_dosen;
//
//
//
//
//            }
            ModelAspekPenilaian::create($validasi);
            return response()->json(['success' => 'Aspek penilaian berhasil dibuat!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan aspek penilaian, coba lagi!'], 500);
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
        $matakuliah_id = ModelMatakuliah::where('kode_mk', $id)->first();

        $aspek_nilai = ModelAspekPenilaian::with('aspek_penilaian')
            ->where('matakuliah_id', $id)->get();

        $nidn = ModelDosen::where('nidn', Auth::user()->user_id)->first();
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

        $role = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
            'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
            ->where('tahun_akademik',$tahun_aktif->kode)
            ->where('nidn', $nidn->nidn)
            ->where('matakuliah_id', $id)->first();

        return view('admin.aspek-nilai.show',[
            'aspeks' => $aspek_nilai,
            'matkuls' => $matakuliah_id,
            'role' => $role->id ?? ''
        ]);
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

        try {
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
            $aspek->update($validasi);
            return response()->json(['success' => 'Aspek penilaian berhasil dibuat!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan aspek penilaian, coba lagi!'], 500);
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
