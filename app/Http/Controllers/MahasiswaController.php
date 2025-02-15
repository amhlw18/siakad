<?php

namespace App\Http\Controllers;

use App\Models\ModelMahasiswa;
use App\Models\ModelProdi;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mahasiswa =  ModelMahasiswa::with('prodi_mhs')
            ->orderBy('nim', 'desc')
            ->get();

        return view('admin.mahasiswa.index',[
            'mahasiswa' => $mahasiswa,
            'prodis' => ModelProdi::all(),
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
        return view('admin.mahasiswa.create',[
            'mhs' => ModelMahasiswa::get(),
            'prodis' => ModelProdi::get(),
            'tahun_akademis'=> ModelTahunAkademik::get()
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
        $query = ModelMahasiswa::with('prodi_mhs')
            ->orderBy('nim', 'asc')
        ; // Include relasi 'prodi_mhs'


        if ($request->prodi) {
            $query->where('prodi_id', $request->prodi);

        }

        if ($request->angkatan) {
            $query->where('tahun_masuk', $request->angkatan);
        }

        return DataTables::of($query)
            ->addIndexColumn() // Menambahkan nomor index
            ->addColumn('action', function ($row) {
                return '
            <form action="/dashboard/data-mahasiswa/' . $row->nim . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                <input type="hidden" name="_method" value="DELETE">
                <a href="/dashboard/data-mahasiswa/' . $row->nim . '/edit" class="btn btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="return confirm(\'Yakin akan menghapus?\')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        ';
            })
            ->addColumn('nama_prodi', function ($row) {
                return $row->prodi_mhs->nama_prodi ?? '-';
            }) // Tambahkan kolom 'nama_prodi' ke JSON
            ->rawColumns(['action']) // Mengizinkan kolom 'action' menggunakan HTML
            ->make(true);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $validasi = $request->validate([
            'prodi_id' => 'required', // memastikan prodi_id valid berdasarkan tabel prodis
            'nim' => 'required|unique:model_mahasiswas,nim|string|max:50',
            'nama_mhs' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date', // validasi format tanggal
            'nama_ibu' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string', // contoh validasi untuk Laki-laki/Perempuan
            'agama' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'nik' => 'required|string|size:16', // NIK biasanya 16 digit
            'alamat' => 'required|string|max:255',
            'status_masuk' => 'required|string|max:50',
            'program' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4', // validasi tahun 4 digit
            'semester_masuk' => 'required|string',
            'status' => 'required|string|max:50',
        ]);



        ModelMahasiswa::create($validasi);

        return redirect('/dashboard/data-mahasiswa')->with('success', 'Mahasiswa berhasil di tambahkan !');
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
        $id =decrypt($id);
        return view('admin.mahasiswa.edit',[
            'mhs' => ModelMahasiswa::where('nim',$id)->first(),
            'prodis' => ModelProdi::get(),
            'tahun_akademis' => ModelTahunAkademik::get()
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
        //
        //dd($request->all());
        $validasi = $request->validate([
            'prodi_id' => 'required', // memastikan prodi_id valid berdasarkan tabel prodis
            'nim' => 'required',
            'nama_mhs' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date', // validasi format tanggal
            'nama_ibu' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string', // contoh validasi untuk Laki-laki/Perempuan
            'agama' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'nik' => 'required|string|size:16', // NIK biasanya 16 digit
            'alamat' => 'required|string|max:255',
            'status_masuk' => 'required|string|max:50',
            'program' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4', // validasi tahun 4 digit
            'semester_masuk' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        ModelMahasiswa::where('nim',$id)->update($validasi);

        return redirect('/dashboard/data-mahasiswa')->with('success', 'Mahasiswa berhasil di ubah !');
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
        //
        $id =decrypt($id);
        $data = ModelMahasiswa::where('nim',$id)->first();

        $data->delete();
        return redirect('/dashboard/data-mahasiswa')->with('success', 'Mahasiswa berhasil di hapus !');
    }
}
