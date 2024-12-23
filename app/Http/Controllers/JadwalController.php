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

    public function filter_data(Request $request)
    {

        $query = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
            'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan');

        // Tambahkan kondisi filter jika ada nilai prodi
        if ($request->prodi){
            $query->where('prodi_id', $request->prodi)
                ->where('tahun_akademik', $request->tahun);
        }

        $data = $query->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' =>$item->id,
                'hari' => $item->hari ?? '-',
                'jam' => $item->jam  ?? '-',
                'matakuliah' => $item->jadwal_matakuliah->nama_mk  ?? '-',
                'semester' => $item->jadwal_matakuliah->semester  ?? '-',
                'dosen' => $item->dosen->nama_dosen  ?? '-',
                'kelas' => $item->jadwal_kelas->nama_kelas  ?? '-',
                'ruangan' => $item->jadwal_ruangan->nama_ruangan  ?? '-',
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
        //\Log::info('Data diterima:', $request->all());

        try {
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

            $jam_awal_baru = $request->jam_awal;
            $jam_akhir_baru = $request->jam_akhir;
            $prodi_id = $request->prodi_id;
            $tahun = $request->tahun_akademik;
            $hari = $request->hari;
            $ruangan_id = $request->ruangan_id;

            // Cek bentrok jadwal berdasarkan irisan waktu
            $bentrok = ModelDetailJadwal::where('tahun_akademik', $tahun)
                ->where('hari', $hari)
                ->where('ruangan_id', $ruangan_id)
                ->get()
                ->filter(function ($jadwal) use ($jam_awal_baru, $jam_akhir_baru) {
                    [$jam_awal, $jam_akhir] = explode(' - ', $jadwal->jam);

                    return (
                    ($jam_awal_baru < $jam_akhir && $jam_akhir_baru > $jam_awal) // Periksa irisan waktu
                    );
                })
                ->first();

            if ($bentrok) {
                return response()->json(['errors' => 'Jadwal bertabrakan dengan jadwal lain!'], 422);
            }

            // Gabungkan jam_awal dan jam_akhir untuk disimpan dalam kolom 'jam'
            $validasi['jam'] = $jam_awal_baru . ' - ' . $jam_akhir_baru;


            ModelDetailJadwal::create($validasi);
            return response()->json(['success' => 'Jadwal berhasil dibuat!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan jadwal, coba lagi!'], 500);
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

        $prodi = ModelProdi::where('kode_prodi',$id)->first();
        $tahun_akademik = ModelTahunAkademik::where('status',1)->first();

        $jadwal = ModelDetailJadwal::with('prodi_jadwal','tahun_jadwal',
            'jadwal_matakuliah','dosen','jadwal_kelas','jadwal_ruangan')
            ->where('prodi_id',$id)
            ->where('tahun_akademik', $tahun_akademik->kode)
            ->get();

        // Ambil data kelas dan ruangan berdasarkan ID prodi
        $kelas = ModelKelas::where('prodi_id', $id)->get();
        $ruangan = ModelRuangan::where('prodi_id', $id)->get();
        $matkul = ModelMatakuliah::where('kode_prodi', $id)->get();

//        foreach ($jadwal as $item) {
//            if ($item->dosen) {
//                dump($item->dosen->toArray());
//            } else {
//                dump("Dosen tidak ditemukan untuk NIDN: " . $item->nidn);
//            }
//        }
//        exit;

        return view('admin.jadwal.show',[
            'jadwals' => $jadwal,
            'prodi' => $prodi,
            'tahun_aktif' => $tahun_akademik,
            'tahun_akademik' => ModelTahunAkademik::get(),
            'dosens' => ModelDosen::get(),
            'kelas' => $kelas,
            'ruangans' => $ruangan,
            'matakuliah' => $matkul,
        ]);



    }

//    public function getByProdi($id)
//    {
//        // Ambil data kelas dan ruangan berdasarkan ID prodi
//        $kelas = ModelKelas::where('prodi_id', $id)->get();
//        $ruangan = ModelRuangan::where('prodi_id', $id)->get();
//        $matkul = ModelMatakuliah::where('kode_prodi', $id)->get();
//
//        if ($kelas->isEmpty() && $ruangan->isEmpty()) {
//            return response()->json(['message' => 'Data tidak ditemukan'], 404);
//        }
//
//        return response()->json([
//            'matkul'=> $matkul,
//            'kelas' => $kelas,
//            'ruangan' => $ruangan,
//        ], 200);
//    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $jadwal = ModelDetailJadwal::where('id', $id)->first();

        if ($jadwal) {
            // Pisahkan jam awal dan akhir berdasarkan karakter "-"
            if (isset($jadwal->jam)) {
                $jam = explode('-', $jadwal->jam);
                $jadwal->jam_awal = isset($jam[0]) ? trim(date('H:i', strtotime($jam[0]))) : null;
                $jadwal->jam_akhir = isset($jam[1]) ? trim(date('H:i', strtotime($jam[1]))) : null;
            }
        }

        return response()->json($jadwal);
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
        \Log::info('Request masuk ke controller:', ['request' => $request->all()]);
        //dd($request->all());
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

        $jam_awal_baru = $request->jam_awal;
        $jam_akhir_baru = $request->jam_akhir;
//        $prodi_id = $request->prodi_id;
//        $tahun = $request->tahun_akademik;
//        $hari = $request->hari;
//        $ruangan_id = $request->ruangan_id;

        // Gabungkan jam_awal dan jam_akhir untuk disimpan dalam kolom 'jam'
        $validasi['jam'] = $jam_awal_baru . ' - ' . $jam_akhir_baru;

        $jadwal = ModelDetailJadwal::find($id);


        $jadwal->update($validasi);

        return response()->json(['success' => 'Jadwal berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            $data = ModelDetailJadwal::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data jadwal berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


}
