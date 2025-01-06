<?php

namespace App\Http\Controllers;

use App\Models\ModelDetailJadwal;
use App\Models\ModelDosen;
use App\Models\ModelKRSMahasiwa;
use App\Models\ModelKurikulum;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use App\Models\ModelProdi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NeoFeeederController extends Controller
{
    //

    protected $apiUrl;
    protected $token;

    public function __construct()
    {
        // Set nilai URL dan token saat controller dipanggil
        $this->apiUrl = 'http://localhost:3003/ws/live2.php';
        $this->token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9wZW5nZ3VuYSI6IjFlYmI2OWRkLTY3N2UtNGJmMi1hMmVmLTRkODFkYTc0Njc4MiIsInVzZXJuYW1lIjoid2FvZGVoYXNyaWF0aW9mZmljaWFsQGdtYWlsLmNvbSIsIm5tX3BlbmdndW5hIjoiQkFIVElBUiIsInRlbXBhdF9sYWhpciI6bnVsbCwidGdsX2xhaGlyIjpudWxsLCJqZW5pc19rZWxhbWluIjoiTCIsImFsYW1hdCI6bnVsbCwieW0iOiJ5YXIudW5hYWhhODBAZ21haWwuY29tIiwic2t5cGUiOm51bGwsIm5vX3RlbCI6bnVsbCwiYXBwcm92YWxfcGVuZ2d1bmEiOiI1IiwiYV9ha3RpZiI6IjEiLCJ0Z2xfZ2FudGlfcHdkIjoiMjAyNC0wNi0yNVQxNjowMDowMC4wMDBaIiwiaWRfc2RtX3BlbmdndW5hIjoiNGViNWE4NjUtYTMwNy00ZmEyLWJiZmMtMGQ1YzY4NTM0ZDUwIiwiaWRfcGRfcGVuZ2d1bmEiOm51bGwsImlkX3dpbCI6Ijk5OTk5OSAgIiwibGFzdF91cGRhdGUiOiIyMDI0LTA3LTI2VDEzOjI0OjUxLjM5N1oiLCJzb2Z0X2RlbGV0ZSI6IjAiLCJsYXN0X3N5bmMiOiIyMDI0LTEyLTE3VDAzOjUxOjA1LjYyMFoiLCJpZF91cGRhdGVyIjoiOTE2Y2IzMjgtM2VjNi00YjBiLWIyZmYtZDE3YjAzNDQ1YTBmIiwiY3NmIjoiMCIsInRva2VuX3JlZyI6bnVsbCwiamFiYXRhbiI6bnVsbCwidGdsX2NyZWF0ZSI6IjIwMjQtMDUtMTZUMDI6MjM6NTguMDQwWiIsIm5payI6bnVsbCwic2FsdCI6bnVsbCwiaWRfcGVyYW4iOjMsIm5tX3BlcmFuIjoiQWRtaW4gUERESUtUSSIsImlkX3NwIjoiY2FiNjMzMjMtZmMwYy00ODFmLThlNDMtOTMyYzhjMzhkMDkwIiwiaWRfc210IjoiMjAyNDEiLCJpYXQiOjE3MzYxNjUwMzMsImV4cCI6MTczNjE4MzAzM30.ZHbWr0g6b9NDO9biuS8tPi5uVl21oz1av-C7Cm-NdYs';

    }


    public function getProdi()
    {
        $body = [
            "act" => "GetProdi",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            // Periksa jika data tersedia
            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $prodi) {
                    ModelProdi::create([
                        'kode_prodi' => $prodi['kode_program_studi'],
                        'nama_prodi' => $prodi['nama_program_studi'],
                        'jenjang' => $prodi['nama_jenjang_pendidikan'],
                        'ka_prodi' => '0',
                    ]);
                }
                return response()->json(['message' => 'Data prodi berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }

    public function getKurikulum()
    {
        $body = [
            "act" => "GetListKurikulum",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            // Periksa jika data tersedia
            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $kurikulum) {
                    ModelKurikulum::create([
                        'tahun_akademik_id' => 1,
                        'kode_kurikulum' => $kurikulum['id_kurikulum'],
                        'nama_kurikulum' => $kurikulum['nama_kurikulum'],
                        'sks_wajib' => $kurikulum['jumlah_sks_wajib'],
                        'sks_pilihan' => $kurikulum['jumlah_sks_pilihan'],
                        'jumlah_sks' => $kurikulum['jumlah_sks_lulus'],
                    ]);
                }
                return response()->json(['message' => 'Data berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }
    public function getListMataKuliah()
    {
        // URL API dan Body request
        //$url = 'http://localhost:3003/ws/live2.php';
        $body = [
            "act" => "GetMatkulKurikulum",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            // Periksa jika data tersedia
            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $mataKuliah) {
                    $kodeProdi = null;

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($mataKuliah['nama_program_studi']) {
                        case 'D3 Kebidanan':
                            $kodeProdi = 15401;
                            break;
                        case 'S1 Administrasi Kesehatan':
                            $kodeProdi = 13263;
                            break;
                        case 'S1 Gizi':
                            $kodeProdi = 13211;
                            break;
                        case 'S1 Teknologi Informasi':
                            $kodeProdi = 59201;
                            break;
                    }

                    // Simpan data ke database
                    if ($kodeProdi) {
                        ModelMatakuliah::create([
                            'kurikulum_id' => $mataKuliah['id_kurikulum'],
                            'kode_prodi' => $kodeProdi,
                            'kode_mk' => $mataKuliah['kode_mata_kuliah'],
                            'nama_mk' => $mataKuliah['nama_mata_kuliah'],
                            'semester' => $mataKuliah['semester'],
                            'sks_teori' => $mataKuliah['sks_tatap_muka'],
                            'sks_praktek' => $mataKuliah['sks_praktek'],
                            'sks_lapangan' => $mataKuliah['sks_praktek_lapangan'],
                        ]);
                    }
                }
                return response()->json(['message' => 'Data Matakuliah berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);


    }

    public function getDosen()
    {
        $body = [
            "act" => "DetailBiodataDosen",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            // Periksa jika data tersedia
            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $dosen) {

                    $jk = null;

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($dosen['jenis_kelamin']) {
                        case 'L':
                            $jk = "Laki-Laki";
                            break;
                        case 'P':
                            $jk = "Perempuan";
                            break;

                    }

                    $tgl_lahir = Carbon::createFromFormat('d-m-Y', $dosen['tanggal_lahir'])->format('Y-m-d');

                    ModelDosen::create([
                        'nidn' => $dosen['nidn'] ?? '-',
                        'prodi_id' => 0,
                        'nama_dosen' => $dosen['nama_dosen'] ?? '-',
                        'tempat_lahir' => $dosen['tempat_lahir'] ?? '-',
                        'tgl_lahir' => $tgl_lahir ?? '-',
                        'jenis_kelamin' => $jk,
                        'agama' => $dosen['nama_agama'] ?? '-',
                        'no_hp' => $dosen['handphone'] ?? '-',
                        'alamat' => $dosen['jalan'] ?? '-',
                    ]);
                }
                return response()->json(['message' => 'Data Dosen berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }

    public function getMatkulDosen()
    {
        $body = [
            "act" => "GetListKelasKuliah",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $item) {

                    $kodeProdi = null;

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($item['nama_program_studi']) {
                        case 'D3 Kebidanan':
                            $kodeProdi = 15401;
                            break;
                        case 'S1 Administrasi Kesehatan':
                            $kodeProdi = 13263;
                            break;
                        case 'S1 Gizi':
                            $kodeProdi = 13211;
                            break;
                        case 'S1 Teknologi Informasi':
                            $kodeProdi = 59201;
                            break;
                    }

                    $nama_dosen = explode(',', $item['nama_dosen']);


                    $nidn = ModelDosen::whereIn('nama_dosen',$nama_dosen)->get();

                    foreach ($nidn as $data){
                        ModelDetailJadwal::create([
                            'prodi_id' => $kodeProdi ?? '-',
                            'tahun_akademik' => $item['id_semester'] ?? '-',
                            'matakuliah_id' => $item['kode_mata_kuliah'] ?? '-',
                            'nidn' => $data->nidn ?? '-',
                        ]);
                    }


                }
                return response()->json(['message' => 'Data Matakuliah dosen berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }


    public function getMahasiswa()
    {
        $body = [
            "act" => "GetDataLengkapMahasiswaProdi",
            "token" => $this->token,
            "filter" => "",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $item) {

                    $kodeProdi = null;

                    $jk = null;

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($item['jenis_kelamin']) {
                        case 'L':
                            $jk = "Laki-Laki";
                            break;
                        case 'P':
                            $jk = "Perempuan";
                            break;

                    }

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($item['nama_program_studi']) {
                        case 'D3 Kebidanan':
                            $kodeProdi = 15401;
                            break;
                        case 'S1 Administrasi Kesehatan':
                            $kodeProdi = 13263;
                            break;
                        case 'S1 Gizi':
                            $kodeProdi = 13211;
                            break;
                        case 'S1 Teknologi Informasi':
                            $kodeProdi = 59201;
                            break;
                    }

                    $angkatan = null;
                    switch ($item['id_periode_masuk']) {
                        case '20212':
                            $angkatan = '2021';
                            break;
                        case '20221':
                            $angkatan = "2022";
                            break;
                        case '20231':
                            $angkatan = "2023";
                            break;
                        case '20241':
                            $angkatan = "2024";
                            break;
                    }

                    ModelMahasiswa::create([
                        'prodi_id' => $kodeProdi ?? '0',
                        'semester_masuk' => $item['id_periode_masuk'] ?? '0',
                        'nim' => $item['nim'] ?? '-',
                        'nama_mhs' => $item['nama_mahasiswa'] ?? '-',
                        'tempat_lahir' => $item['tempat_lahir'] ?? '-',
                        'tgl_lahir' => $item['tanggal_lahir'] ?? '-',
                        'nama_ibu' => $item['nama_ibu_kandung'] ?? '-',
                        'nama_ayah' => $item['nama_ayah'] ?? '-',

                        'jenis_kelamin' => $jk ?? '-',
                        'agama' => $item['nama_agama'] ?? '-',
                        'no_hp' => $item['handphone'] ?? '-',
                        'email' => $item['email'] ?? '-',

                        'nik' => $item['nik'] ?? '-',
                        'alamat' => $item['handphone'] ?? '-',
                        'jalan' => $item['jalan'] ?? '-',

                        'tahun_masuk' =>  $angkatan?? '0',
                        'status' => $item['nama_status_mahasiswa'] ?? '-',
                    ]);



                }
                return response()->json(['message' => 'Data mahasiswa berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }

    public function getKRSMhs()
    {
        $body = [
            "act" => "GetKRSMahasiswa",
            "token" => $this->token,
            "filter" => "",
            //"filter" => "nim LIKE '2024103043%'",
            "order" => "",
            "limit" => "",
            "offset" => "0"
        ];

        // Fetch data dari API
        $response = Http::post($this->apiUrl, $body);
        //dd($response->body());

        if ($response->successful()) {
            $data = $response->json();

            if ($data['error_code'] == 0 && isset($data['data'])) {
                foreach ($data['data'] as $item) {

                    $kodeProdi = null;

                    // Atur kode_prodi berdasarkan nama_program_studi
                    switch ($item['nama_program_studi']) {
                        case 'D3 Kebidanan':
                            $kodeProdi = 15401;
                            break;
                        case 'S1 Administrasi Kesehatan':
                            $kodeProdi = 13263;
                            break;
                        case 'S1 Gizi':
                            $kodeProdi = 13211;
                            break;
                        case 'S1 Teknologi Informasi':
                            $kodeProdi = 59201;
                            break;
                    }


                    ModelKRSMahasiwa::create([
                        'tahun_akademik' => $item['id_periode'] ?? '0',
                        'prodi_id' => $kodeProdi ?? '0',
                        'matakuliah_id' => $item['kode_mata_kuliah'] ?? '-',
                        'nim' => $item['nim'] ?? '-',
                    ]);



                }
                return response()->json(['message' => 'Data mahasiswa berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);
    }

}
