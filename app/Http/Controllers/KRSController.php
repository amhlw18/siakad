<?php

namespace App\Http\Controllers;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelNilaiMHS;
use App\Models\ModelPembayaran;
use App\Models\ModelProdi;
use App\Models\ModelStatusKRS;
use App\Models\ModelTahunAkademik;
use Carbon\Carbon;
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
        if (Auth::user()->role == 1 || Auth::user()->role == 6){
            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('status', 'AKTIF')
                ->orderBy('nim','asc')
                ->get();

            return view('mahasiswa.krs.index',[
                'mahasiswa' => $mhs,

            ]);
        }

        if (Auth::user()->role == 4){
            $tanggalSekarang = Carbon::today();

            $tahunAkademik = ModelTahunAkademik::where('status', 1)->get();

            $pesan = null;
            $periode = false;
            foreach ($tahunAkademik as $item) {
                // Pisahkan tanggal awal dan akhir dari kolom periode
                [$tanggalAwal, $tanggalAkhir] = explode(' - ', $item->periode_krs);

                // Konversi menjadi format Carbon
                $tanggalAwal = Carbon::parse($tanggalAwal);
                $tanggalAkhir = Carbon::parse($tanggalAkhir);

                //dd($tanggalAwal .' '. $tanggalAkhir);

                //Cek apakah tanggal sistem berada di antara tanggal awal dan akhir
                if ($tanggalSekarang->between($tanggalAwal, $tanggalAkhir)) {
                    $pesan = 'Periode KRS sedang berlangsung '.' s/d ' . $tanggalAkhir;
                    $periode = true;
                    break; // Keluar dari loop jika sudah menemukan periode yang sesuai
                }elseif ($tanggalSekarang->lessThan($tanggalAwal)) {
                    // Jika periode belum dimulai
                    $pesan = 'Periode KRS akan dimulai pada tanggal ' . $tanggalAwal;
                    $periode = false;
                    break;
                } elseif ($tanggalSekarang->greaterThan($tanggalAkhir)) {
                    // Jika periode telah berakhir
                    $pesan = 'Periode KRS telah berakhir pada tanggal ' . $tanggalAkhir;
                    $periode = false;
                }


            }
            $nim = Auth::user()->user_id;
            $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();

            $mhs = ModelMahasiswa::with('prodi_mhs')
                ->where('nim', $nim)
                ->first();

            $pembayaran = ModelPembayaran::where('nim', $nim)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->first();

            $status_krs = ModelStatusKRS::where('nim',$nim)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->first();

            if ($periode){
                if (!$status_krs){
                    ModelStatusKRS::create([
                        'tahun_akademik' => $tahun_aktif->kode,
                        'prodi_id' => $mhs->prodi_id,
                        'nim' => $nim,
                    ]);
                }
            }

            $krs_mhs = ModelKRSMahasiwa::with('krs_matkul')
                ->where('nim',$nim)
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });


            if ($mhs->prodi_id == 15401){
                $khs_smt_lalu = $tahun_aktif->kode - 9;
            }else{
                $khs_smt_lalu = $tahun_aktif->kode - 10;
            }

            $khs_mhs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
                ->where('tahun_akademik', $khs_smt_lalu)
                ->orderBy('matakuliah_id', 'asc')
                ->get();

            $validasi_kosong_khs = ModelNilaiMHS::with('nilai_matakuliah_mhs')
                ->where('nim', $nim)
                ->where('tahun_akademik', $khs_smt_lalu)
                ->first();

            $jumlah_sks =0;
            $jumlah_mk =0;
            $ips =0;


            if ($validasi_kosong_khs){

                $jumlah_sks = ModelNilaiMHS::where('nim', $nim)
                    ->where('tahun_akademik', $khs_smt_lalu)
                    ->sum('sks');

                $total_nilai = ModelNilaiMHS::where('nim', $nim)
                    ->where('tahun_akademik', $khs_smt_lalu)
                    ->sum('total_nilai');

                $ips = $total_nilai/$jumlah_sks;
                $ips = number_format($ips, 2,'.','');
            }

            //$beban_sks = null;

            if ($ips >= 0.00 && $ips <= 2.00){
                $beban_sks = 18;
            }else if ($ips >= 2.01 && $ips < 2.50){
                $beban_sks = 20;
            }else if ($ips >=2.51 && $ips < 2.99){
                $beban_sks =22;
            }else if ($ips >=3.00 && $ips <= 4.00){
                $beban_sks = 24;
            }

            if ($mhs->semester == 1 || $mhs->semester == 2){
                $beban_sks = 24;
            }

            $total_sks = ModelKRSMahasiwa::where('nim',$nim)
                ->where('tahun_akademik',$tahun_aktif->kode)
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->krs_matkul->sks_teori ?? 0) +
                        (int) ($item->krs_matkul->sks_praktek ?? 0) +
                        (int) ($item->krs_matkul->sks_lapangan ?? 0);
                    return $item;
                });

            $total_sks = $total_sks->sum('total_sks');


            return view('mahasiswa.krs.index',[
                'mhs' => $mhs,
                'pesan' => $pesan,
                'periode' => $periode,
                'tahun_aktif' => $tahun_aktif,
                'pembayaran' => $pembayaran,
                'status_krs' => $status_krs ?? 0,
                'krs_mhs' => $krs_mhs,
                'ips' => $ips,
                'beban_sks' => $beban_sks,
                'total_sks' => $total_sks,

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

    }

    public function ambil_krs(Request $request)
    {
        $nim = $request->nim;
        $prodi_id = $request->prodi_id;
        $semester = $request->semester;
        $beban_sks = $request->beban_sks;

        //dd($nim);

        $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();

        $periode = $tahun_akademik->semester;

        if ($periode == 'Ganjil'){
            $matakuliah = ModelMatakuliah::where('kode_prodi',$prodi_id)
                ->whereIn('semester',[1,3,5,7])
                ->orderBy('semester', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->sks_teori ?? 0) +
                        (int) ($item->sks_praktek ?? 0) +
                        (int) ($item->sks_lapangan ?? 0);
                    return $item;
                });
        }if ($periode == 'Genap'){

            $matakuliah = ModelMatakuliah::where('kode_prodi',$prodi_id)
                ->whereIn('semester',[2,4,6,8])
                ->orderBy('semester', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->sks_teori ?? 0) +
                        (int) ($item->sks_praktek ?? 0) +
                        (int) ($item->sks_lapangan ?? 0);
                    return $item;
                });

        }
        if ($periode == 'Pendek'){
            $matakuliah = ModelMatakuliah::where('kode_prodi',$prodi_id)
                ->orderBy('semester', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->total_sks =
                        (int) ($item->sks_teori ?? 0) +
                        (int) ($item->sks_praktek ?? 0) +
                        (int) ($item->sks_lapangan ?? 0);
                    return $item;
                });
        }

        if ($prodi_id == 15401){
            if ($semester > 6 ){
                $matakuliah = ModelMatakuliah::where('semester', 6)
                    ->where('kode_prodi', 15401)
                    ->where('kurikulum_id', '48f1386f-6e78-4f15-ae2b-8774468ffca9')
                    ->get()
                    ->map(function ($item) {
                        $item->total_sks =
                            (int) ($item->sks_teori ?? 0) +
                            (int) ($item->sks_praktek ?? 0) +
                            (int) ($item->sks_lapangan ?? 0);
                        return $item;
                    });
            }
            else{
                $matakuliah = ModelMatakuliah::where('semester', $semester)
                    ->where('kode_prodi', 15401)
                    ->where('kurikulum_id', '48f1386f-6e78-4f15-ae2b-8774468ffca9')
                    ->get()
                    ->map(function ($item) {
                        $item->total_sks =
                            (int) ($item->sks_teori ?? 0) +
                            (int) ($item->sks_praktek ?? 0) +
                            (int) ($item->sks_lapangan ?? 0);
                        return $item;
                    });
            }
        }



        return view('mahasiswa.krs.create',[
            'matakuliah' => $matakuliah,
            'tahun_aktif' => $tahun_akademik,
            'nim' => $nim,
            'prodi_id' => $prodi_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function kunciKRS (Request $request)
    {
        try {
            $tahun_aktif = $request->tahun_akademik;
            $nim = $request->nim;

            $query = ModelStatusKRS::where('tahun_akademik', $tahun_aktif)
                ->where('nim',$nim);

            $query->update(['dikunci' => 1]);

            return response()->json(['success' => 'KRS berhasil dikunci !']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengunci KRS, coba lagi!'], 500);
        }
    }

    public function bukaKRS (Request $request)
    {
        try {
            $tahun_aktif = $request->tahun_akademik;
            $nim = $request->nim;

            $status_krs = ModelStatusKRS::where('nim', $nim)
                ->where('tahun_akademik', $tahun_aktif)
                ->where('disetujui', 1)
                ->first();

            if ($status_krs){
                return response()->json(['errors' => 'KRS telah disetujui oleh PA !.'], 422);
            }

            $query = ModelStatusKRS::where('tahun_akademik', $tahun_aktif)
                ->where('nim',$nim);

            $query->update(['dikunci' => 0]);

            return response()->json(['success' => 'KRS berhasil dibuka !']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuka KRS, coba lagi!'], 500);
        }
    }
    public function store(Request $request)
    {
        //
        try {

            $nim = $request->nim;
            $matakuliah_id = $request->matakuliah_id;
            $prodi_id = $request->prodi_id;
            $tahun_akademik = ModelTahunAkademik::where('status', 1)->first();


            // Cek apakah data pembayaran sudah ada
            $existingPembayaran = ModelKRSMahasiwa::where('nim', $nim)
                ->where('tahun_akademik', $tahun_akademik->kode)
                ->where('matakuliah_id', $matakuliah_id)
                ->where('tahun_akademik', $tahun_akademik->kode)
                ->first();

            if ($existingPembayaran) {
                return response()->json(['errors' => 'Matakuliah sudah di program untuk semester ini !.'], 422);
            }

            ModelKRSMahasiwa::create([
                'tahun_akademik' => $tahun_akademik->kode,
                'nim' => $nim,
                'prodi_id' => $prodi_id,
                'matakuliah_id' => $matakuliah_id,
            ]);

            return response()->json(['success' => 'Matakuliah berhasil ditambahkan !']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mambahkan matakuliah, coba lagi!'], 500);
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
        $id =decrypt($id);
        if (Auth::user()->role == 1 || Auth::user()->role == 5 || Auth::user()->role == 6){

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

            $status_krs = ModelStatusKRS::where('nim',$id)
                ->where('tahun_akademik', $tahun_aktif->kode)
                ->first();

            return view('mahasiswa.krs.show',[
                'tahun_aktif' => $tahun_aktif,
                'tahun_akademik' => $tahun_akademik,
                'mhs' => $mhs,
                'status_krs' => $status_krs,
                'krs' => $krs,
            ]);
        }
    }

    public function filter_data(Request $request)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 5 || Auth::user()->role == 6){
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
        try {

            $data = ModelKRSMahasiwa::where('id',$id)->first();

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Matakuliah berhasil dihapus dari KRS.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


}
