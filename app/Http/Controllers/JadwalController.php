<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelJadwal;
use App\Models\ModelKelas;
use App\Models\ModelMatakuliah;
use App\Models\ModelProdi;
use App\Models\ModelRuangan;
use App\Models\ModelTahunAkademik;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
        $prodi = ModelProdi::get();

        //dd($prodi);
//
//
        return view('admin.jadwal.index', [
            'prodis' => $prodi,
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
        \Log::info('Data diterima:', $request->all());

        // Validasi awal
        $validasi = $request->validate([
            'prodi_id' => 'required',
            'tahun_akademik' => 'required',
            'matakuliah_id' => 'required',
            'nidn' => 'required',
            'kelas_id' => 'required',
            'ruangan_id' => 'required',
            'hari' => 'required',
            'jam_awal' => 'required|date_format:H:i',
            'jam_akhir' => 'required|date_format:H:i|after:jam_awal'
        ], [
            'matakuliah_id.required' => "Matakuliah belum dipilih!",
            'nidn.required' => "Dosen belum dipilih!",
            'kelas_id.required' => "Kelas belum dipilih!",
            'ruangan_id.required' => "Ruangan belum dipilih!",
            'hari.required' => "Hari belum dipilih!",
            'jam_awal.required' => "Jam masuk belum diatur!",
            'jam_akhir.required' => "Jam keluar belum diatur!",
            'jam_akhir.after' => "Jam keluar harus di atas jam masuk!"
        ]);

        $jam_awal = $request->jam_awal;
        $jam_akhir = $request->jam_akhir;
        $hari = $request->hari;
        $ruangan_id = $request->ruangan_id;

        // Cek bentrok jadwal
        $bentrok = ModelDetailJadwal::where('hari', $hari)
            ->where('ruangan_id', $ruangan_id)
            ->where(function ($query) use ($jam_awal, $jam_akhir) {
                $query->whereRaw("
                TIME(SUBSTRING_INDEX(jam, ' - ', 1)) BETWEEN ? AND ?
                OR TIME(SUBSTRING_INDEX(jam, ' - ', -1)) BETWEEN ? AND ?
                OR (TIME(SUBSTRING_INDEX(jam, ' - ', 1)) < ? AND TIME(SUBSTRING_INDEX(jam, ' - ', -1)) > ?)
            ", [$jam_awal, $jam_akhir, $jam_awal, $jam_akhir, $jam_awal, $jam_akhir]);
            })
            ->exists();

        if ($bentrok) {
            return response()->json(['error' => 'Jadwal bertabrakan dengan jadwal lain!'], 422);
        }

        // Gabungkan jam_awal dan jam_akhir untuk disimpan dalam kolom 'jam'
        $validasi['jam'] = $jam_awal . ' - ' . $jam_akhir;

        try {
            ModelDetailJadwal::create($validasi);
            return response()->json(['success' => 'Jadwal berhasil dibuat!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan jadwal, coba lagi!']);
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
        $prodi = ModelProdi::where('kode_prodi',$id)->first();
        $tahun_akademik = ModelTahunAkademik::where('status',1)->first();

        $jadwal = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
            'jadwal_matakuliah','jadwal_dosen','jadwal_kelas','jadwal_ruangan')
            ->where('prodi_id',$id)
            ->where('tahun_akademik', $tahun_akademik->id)
            ->get();

        return view('admin.jadwal.show',[
            'jadwals' => $jadwal,
            'prodi' => $prodi,
            'tahun_aktif' => $tahun_akademik,
            'tahun_akademik' => ModelTahunAkademik::get(),
            'dosens' => ModelDosen::get(),
            'ruangans' =>ModelRuangan::get(),
        ]);



    }

    public function getByProdi($id)
    {
        // Ambil data kelas dan ruangan berdasarkan ID prodi
        $kelas = ModelKelas::where('prodi_id', $id)->get();
        $ruangan = ModelRuangan::where('prodi_id', $id)->get();
        $matkul = ModelMatakuliah::where('kode_prodi', $id)->get();

//        if ($kelas->isEmpty() && $ruangan->isEmpty()) {
//            return response()->json(['message' => 'Data tidak ditemukan'], 404);
//        }

        return response()->json([
            'matkul'=> $matkul,
            'kelas' => $kelas,
            'ruangan' => $ruangan,
        ], 200);
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
