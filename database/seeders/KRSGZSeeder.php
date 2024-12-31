<?php

namespace Database\Seeders;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelMahasiswa;
use App\Models\ModelMatakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KRSGZSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Angkatan 2022
//        $prodi_id = 13211;
//        $tahun_masuk = '2022';
//        $semester = '1';
//        $tahun_akademik = 20221;
//
//        $mhs_angkatan_2023_GZ = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_GZ_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_GZ as $mhs){
//            foreach ($mk_GZ_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }

//        $prodi_id = 13211;
//        $tahun_masuk = '2022';
//        $semester = '2';
//        $tahun_akademik = 20222;
//
//        $mhs_angkatan_2023_GZ = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_GZ_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_GZ as $mhs){
//            foreach ($mk_GZ_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }
//
//        $prodi_id = 13211;
//        $tahun_masuk = '2022';
//        $semester = '3';
//        $tahun_akademik = 20231;
//
//        $mhs_angkatan_2023_GZ = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_GZ_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_GZ as $mhs){
//            foreach ($mk_GZ_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }
//
//        $prodi_id = 13211;
//        $tahun_masuk = '2022';
//        $semester = '4';
//        $tahun_akademik = 20232;
//
//        $mhs_angkatan_2023_GZ = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_GZ_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_GZ as $mhs){
//            foreach ($mk_GZ_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }
//
//        $prodi_id = 13211;
//        $tahun_masuk = '2022';
//        $semester = '5';
//        $tahun_akademik = 20241;
//
//        $mhs_angkatan_2023_GZ = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_GZ_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_GZ as $mhs){
//            foreach ($mk_GZ_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }

        //Angkatan 2023

//        $prodi_id = 13211;
//        $tahun_masuk = '2023';
//        $semester = '1';
//        $tahun_akademik = 20231;
//
//        $mhs_angkatan_2023_AK = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_AK_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_AK as $mhs){
//            foreach ($mk_AK_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }
//
//        $prodi_id = 13211;
//        $tahun_masuk = '2023';
//        $semester = '2';
//        $tahun_akademik = 20232;
//
//        $mhs_angkatan_2023_AK = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_AK_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_AK as $mhs){
//            foreach ($mk_AK_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }
//
//        $prodi_id = 13211;
//        $tahun_masuk = '2023';
//        $semester = '3';
//        $tahun_akademik = 20241;
//
//        $mhs_angkatan_2023_AK = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_AK_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_AK as $mhs){
//            foreach ($mk_AK_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }

        // Angkatan 2024

//        $prodi_id = 13211;
//        $tahun_masuk = '2024';
//        $semester = '1';
//        $tahun_akademik = 20241;
//
//        $mhs_angkatan_2023_AK = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        $mk_AK_smt_iii = ModelMatakuliah::where('kode_prodi', $prodi_id)
//            ->where('semester', $semester)
//            ->get();
//
//        foreach ($mhs_angkatan_2023_AK as $mhs){
//            foreach ($mk_AK_smt_iii as $mk){
//                ModelKRSMahasiwa::create([
//                    'tahun_akademik' => $tahun_akademik,
//                    'prodi_id' => $prodi_id,
//                    'matakuliah_id' => $mk->kode_mk,
//                    'nim' => $mhs->nim,
//                ]);
//            }
//        }

    }
}
