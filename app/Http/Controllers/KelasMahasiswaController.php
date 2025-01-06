<?php

namespace App\Http\Controllers;

use App\Models\ModelKelas;
use App\Models\ModelKelasMahasiswa;
use App\Models\ModelMahasiswa;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KelasMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->role==1){
            $kelas_mhs =ModelKelasMahasiswa::with(
                'prodi_kelas_mhs','mhs_kelas_mhs',
                'kelas_mahasiswa')
                ->orderBY('nim','asc')
                ->get();

            $cekData = $kelas_mhs->first();
            $nim = $cekData ? $cekData->nim : null;

            return view('admin.kelas-mahasiswa.index',[
                'mahasiswa' => $kelas_mhs,
                'prodis'=>ModelProdi::get(),
                'nim'=>$nim,
            ]);
        }

        if (Auth::user()->role==5){
            $prodi_id = Auth::user()->prodi;
            $kelas_mhs =ModelKelasMahasiswa::with(
                'prodi_kelas_mhs','mhs_kelas_mhs',
                'kelas_mahasiswa')
                ->where('prodi_id',$prodi_id)
                ->orderBY('nim','asc')
                ->get();

            $cekData = $kelas_mhs->first();
            $nim = $cekData ? $cekData->nim : null;

            return view('admin.kelas-mahasiswa.index',[
                'mahasiswa' => $kelas_mhs,
                'prodis'=>ModelProdi::get(),
                'nim'=>$nim,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $query = ModelKelasMahasiswa::with(
            'prodi_kelas_mhs',
            'mhs_kelas_mhs',
            'kelas_mahasiswa'
        );

        // Tambahkan kondisi filter jika ada nilai prodi
        if ($request->prodi){
            $query->where('prodi_id', $request->prodi);
        }


        // Filter berdasarkan tahun_masuk (relasi ke tabel mahasiswa)
        if ($request->tahun){
            $query->whereHas('mhs_kelas_mhs', function ($subQuery) use ($request) {
                $subQuery->where('tahun_masuk', $request->tahun);
            });
        }

        $data = $query->get();

        // Format data untuk respon JSON
        return response()->json($data->map(function ($item) {
            return [
                'nim' => $item->nim,
                'nama_mhs' => $item->mhs_kelas_mhs->nama_mhs ?? '-',
                'prodi' => $item->prodi_kelas_mhs->nama_prodi,
                'program' => $item->kelas_mahasiswa->nama_kelas ?? '-',
                'tahun_masuk' => $item->mhs_kelas_mhs->tahun_masuk ?? '-',
            ];
        }));
    }

    public function create()
    {
        //

        if (Auth::user()->role==1){
            return view('admin.kelas-mahasiswa.create',[
                'mahasiswa'=>ModelMahasiswa::with('prodi_mhs')
                    ->orderBY('nim','desc')
                    ->get(),
                'prodis' =>ModelProdi::get(),
                'kelas' =>ModelKelas::get(),
            ]);
        }

        if (Auth::user()->role==5){
            $prodi_id = Auth::user()->prodi;

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('prodi_id', $prodi_id)
                ->orderBY('nim','desc')
                ->get();

            $prodi = ModelProdi::where('kode_prodi',$prodi_id)->get();

            return view('admin.kelas-mahasiswa.create',[
                'mahasiswa'=> $mhs,
                'prodis' =>$prodi,
                'kelas' =>ModelKelas::get(),
            ]);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getKelas($prodiId)
    {
        $kelas = ModelKelas::where('prodi_id', $prodiId)->get();
        return response()->json($kelas);
    }

    public function filterDataKelas(Request $request)
    {
        $query = ModelKelasMahasiswa::with('prodi_kelas_mhs','mhs_kelas_mhs',
            'kelas_mahasiswa');

        if ($request->prodi) {
            $query->where('prodi_id', $request->prodi)->orderBY('nim','asc');
        }

        // Filter berdasarkan tahun_masuk (relasi ke tabel mahasiswa)
        if ($request->tahun){
            $query->whereHas('mhs_kelas_mhs', function ($subQuery) use ($request) {
                $subQuery->where('tahun_masuk', $request->tahun)->orderBY('nim','desc');
            });
        }

        return DataTables::of($query)
            ->addIndexColumn() // Menambahkan nomor index
            ->addColumn('action', function ($row) {
                return '

                                    <a href=""
                                       class="btn btn-danger btn-hapus"
                                       data-id="' .$row->id. '">
                                       <i class="bi bi-trash"></i>
                                    </a>


        ';
            })
            ->addColumn('nama_mhs', function ($row) {
                return $row->mhs_kelas_mhs->nama_mhs ?? '-';
            }) // Tambahkan kolom 'nama_prodi' ke JSON
            ->addColumn('nama_prodi', function ($row) {
                return $row->prodi_kelas_mhs->nama_prodi ?? '-';
            }) // Tambahkan kolom 'nama_prodi' ke JSON
            ->addColumn('nama_kelas', function ($row) {
                return $row->kelas_mahasiswa->nama_kelas ?? '-';
            })
            ->addColumn('tahun_masuk', function ($row) {
                return $row->mhs_kelas_mhs->tahun_masuk ?? '-';
            })
            ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
            ->make(true);
    }

    public function filterData(Request $request)
    {
        if (Auth::user()->role==1){
            $query = ModelMahasiswa::with('prodi_mhs'); // Include relasi 'prodi_mhs'

            if ($request->prodi) {
                $query->where('prodi_id', $request->prodi)->orderBY('nim','asc');
            }

            if ($request->angkatan) {
                $query->where('tahun_masuk', $request->angkatan)->orderBY('nim','desc');
            }

            return DataTables::of($query)
                ->addIndexColumn() // Menambahkan nomor index
                ->addColumn('action', function ($row) {
                    return '

                                    <a href=""
                                       class="btn btn-primary btn-tambah"
                                       data-id="' .$row->nim. '">
                                        Tambah
                                    </a>


        ';
                })
                ->addColumn('nama_prodi', function ($row) {
                    return $row->prodi_mhs->nama_prodi ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
                ->make(true);
        }

        if (Auth::user()->role==5){
            $query = ModelMahasiswa::with('prodi_mhs'); // Include relasi 'prodi_mhs'

            $request->prodi = Auth::user()->prodi;

            if ($request->prodi) {
                $query->where('prodi_id', $request->prodi)->orderBY('nim','asc');
            }

            if ($request->angkatan) {
                $query->where('tahun_masuk', $request->angkatan)->orderBY('nim','desc');
            }

            return DataTables::of($query)
                ->addIndexColumn() // Menambahkan nomor index
                ->addColumn('action', function ($row) {
                    return '

                                    <a href=""
                                       class="btn btn-primary btn-tambah"
                                       data-id="' .$row->nim. '">
                                        Tambah
                                    </a>


        ';
                })
                ->addColumn('nama_prodi', function ($row) {
                    return $row->prodi_mhs->nama_prodi ?? '-';
                }) // Tambahkan kolom 'nama_prodi' ke JSON
                ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
                ->make(true);
        }
    }

    public function store(Request $request)
    {
//        //dd(request()->all());
//        $mahasiswa = ModelMahasiswa::where('prodi_id',$request->prodi_id)
//            ->where('status','Aktif')
//            ->where('semester_masuk',$request->semester_masuk)
//            ->get();
//
////        foreach ($mahasiswa as $item) {
////            if ($item->nama_mhs) {
////                dump($item->nama_mhs);
////            } else {
////                dump("Dosen tidak ditemukan untuk NIDN: " . $item->nama_mhs);
////            }
////        }
////        exit;
//
//        if (!$mahasiswa) {
//            return redirect()->back()->with('error', 'Tidak ditemukan mahasiswa aktif.');
//        }
//
//        //$mhs = $mahasiswa->first();
//        //dd($request->kelas_id);
//
//
//        foreach ($mahasiswa as $mhs) {
//
//            $kelas_mhs = ModelKelasMahasiswa::with('prodi_kelas_mhs',
//                'mhs_kelas_mhs','kelas_mahasiswa')
//                ->where('nim',$mhs->nim)
//                ->where('prodi_id', $mhs->prodi_id)
//                ->first();
//
//
//            if ($kelas_mhs) {
//                return redirect()->back()->with('error', 'Kelas mahasiswa sudah terdaftar.');
//            }
//
//            ModelKelasMahasiswa::create([
//                'prodi_id' => $mhs->prodi_id,
//                'kelas_id' => $request->kelas_id,
//                'nim' => $mhs->nim,
//            ]);
//        }
//        return redirect('/dashboard/kls-mhs')->with('success', 'Kelas mahasiswa berhasil di tambahkan !');

        try {



            $validasi = $request->validate([
                'prodi_id' => 'required',
                'nim' => 'required|unique:model_kelas_mahasiswas,nim',
                'kelas_id' => 'required',
            ],[
                'prodi_id.required' => 'Prodi belum dipilih !',
                'kelas_id.required' => 'Kelas belum dipilih !',
                'nim.unique' => 'Mahasiswa sudah ditambahkan !',
            ]);

            ModelKelasMahasiswa::create($validasi);
            return response()->json(['success' => 'Mahasiswa berhsil ditambahkan !']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan mahasiswa, coba lagi!'], 500);
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

            $data = ModelKelasMahasiswa::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil dihapus dari kelas.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }



    public function deleteAll()
    {
        try {
//            // Hapus semua data pada tabel
            DB::table('model_kelas_mahasiswas')->truncate();

             //Atau menggunakan model (jika ada event Model untuk menghapus)
             //ModelKelasMahasiswa::query()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Semua data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
