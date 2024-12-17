<?php

namespace App\Http\Controllers;

use App\Models\ModelKurikulum;
use App\Models\ModelMatakuliah;
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
        $this->token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9wZW5nZ3VuYSI6IjFlYmI2OWRkLTY3N2UtNGJmMi1hMmVmLTRkODFkYTc0Njc4MiIsInVzZXJuYW1lIjoid2FvZGVoYXNyaWF0aW9mZmljaWFsQGdtYWlsLmNvbSIsIm5tX3BlbmdndW5hIjoiQkFIVElBUiIsInRlbXBhdF9sYWhpciI6bnVsbCwidGdsX2xhaGlyIjpudWxsLCJqZW5pc19rZWxhbWluIjoiTCIsImFsYW1hdCI6bnVsbCwieW0iOiJ5YXIudW5hYWhhODBAZ21haWwuY29tIiwic2t5cGUiOm51bGwsIm5vX3RlbCI6bnVsbCwiYXBwcm92YWxfcGVuZ2d1bmEiOiI1IiwiYV9ha3RpZiI6IjEiLCJ0Z2xfZ2FudGlfcHdkIjoiMjAyNC0wNi0yNVQxNjowMDowMC4wMDBaIiwiaWRfc2RtX3BlbmdndW5hIjoiNGViNWE4NjUtYTMwNy00ZmEyLWJiZmMtMGQ1YzY4NTM0ZDUwIiwiaWRfcGRfcGVuZ2d1bmEiOm51bGwsImlkX3dpbCI6Ijk5OTk5OSAgIiwibGFzdF91cGRhdGUiOiIyMDI0LTA3LTI2VDEzOjI0OjUxLjM5N1oiLCJzb2Z0X2RlbGV0ZSI6IjAiLCJsYXN0X3N5bmMiOiIyMDI0LTEyLTE3VDAzOjUxOjA1LjYyMFoiLCJpZF91cGRhdGVyIjoiOTE2Y2IzMjgtM2VjNi00YjBiLWIyZmYtZDE3YjAzNDQ1YTBmIiwiY3NmIjoiMCIsInRva2VuX3JlZyI6bnVsbCwiamFiYXRhbiI6bnVsbCwidGdsX2NyZWF0ZSI6IjIwMjQtMDUtMTZUMDI6MjM6NTguMDQwWiIsIm5payI6bnVsbCwic2FsdCI6bnVsbCwiaWRfcGVyYW4iOjMsIm5tX3BlcmFuIjoiQWRtaW4gUERESUtUSSIsImlkX3NwIjoiY2FiNjMzMjMtZmMwYy00ODFmLThlNDMtOTMyYzhjMzhkMDkwIiwiaWRfc210IjoiMjAyNDEiLCJpYXQiOjE3MzQ0MTI5MjIsImV4cCI6MTczNDQzMDkyMn0.boXLV8-DXV_cbYYGh6miy_u3sFVO9PUzzU2OKDXJw7Y';
    }



//    public function getKurikulum()
//    {
//        $body = [
//            "act" => "GetListKurikulum",
//            "token" => $this->token,
//            "filter" => "",
//            "order" => "",
//            "limit" => "",
//            "offset" => "0"
//        ];
//
//        // Fetch data dari API
//        $response = Http::post($this->apiUrl, $body);
//        //dd($response->body());
//
//        if ($response->successful()) {
//            $data = $response->json();
//
//            // Periksa jika data tersedia
//            if ($data['error_code'] == 0 && isset($data['data'])) {
//                foreach ($data['data'] as $kurikulum) {
//                    ModelKurikulum::create([
//                        'tahun_akademik_id' => 1,
//                        'kode_kurikulum' => 1,
//                        'nama_kurikulum' => $kurikulum['nama_kurikulum'],
//                        'sks_wajib' => $kurikulum['jumlah_sks_wajib'],
//                        'sks_pilihan' => $kurikulum['jumlah_sks_pilihan'],
//                        'jumlah_sks' => $kurikulum['jumlah_sks_lulus'],
//                    ]);
//                }
//                return response()->json(['message' => 'Data berhasil disimpan.']);
//            }
//        }
//
//        return response()->json(['error' => 'Gagal mengambil data dari API.']);
//    }
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
                            'kurikulum_id' => 1,
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
                return response()->json(['message' => 'Data berhasil disimpan.']);
            }
        }

        return response()->json(['error' => 'Gagal mengambil data dari API.']);


    }

}
