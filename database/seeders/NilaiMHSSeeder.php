<?php

namespace Database\Seeders;

use App\Models\ModelKRSMahasiwa;
use App\Models\ModelNilaiMHS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiMHSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tahun_akademik = 20221;

        $krs_mhs = ModelKRSMahasiwa::where('tahun_akademik',$tahun_akademik)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        foreach ($krs_mhs as $item){
            ModelNilaiMHS::create([
                'tahun_akademik' => $item->tahun_akademik,
                'matakuliah_id' => $item->matakuliah_id,
                'sks' => $item->total_sks,
                'nim' => $item->nim,
                'total_nilai' => '0',
                'nilai_angka' => '0',
                'nilai_huruf' => 'E',
                'status' => 1,
            ]);
        }

        $tahun_akademik = 20222;

        $krs_mhs = ModelKRSMahasiwa::where('tahun_akademik',$tahun_akademik)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        foreach ($krs_mhs as $item){
            ModelNilaiMHS::create([
                'tahun_akademik' => $item->tahun_akademik,
                'matakuliah_id' => $item->matakuliah_id,
                'sks' => $item->total_sks,
                'nim' => $item->nim,
                'total_nilai' => '0',
                'nilai_angka' => '0',
                'nilai_huruf' => 'E',
                'status' => 1,
            ]);
        }

        $tahun_akademik = 20231;

        $krs_mhs = ModelKRSMahasiwa::where('tahun_akademik',$tahun_akademik)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        foreach ($krs_mhs as $item){
            ModelNilaiMHS::create([
                'tahun_akademik' => $item->tahun_akademik,
                'matakuliah_id' => $item->matakuliah_id,
                'sks' => $item->total_sks,
                'nim' => $item->nim,
                'total_nilai' => '0',
                'nilai_angka' => '0',
                'nilai_huruf' => 'E',
                'status' => 1,
            ]);
        }

        $tahun_akademik = 20232;

        $krs_mhs = ModelKRSMahasiwa::where('tahun_akademik',$tahun_akademik)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        foreach ($krs_mhs as $item){
            ModelNilaiMHS::create([
                'tahun_akademik' => $item->tahun_akademik,
                'matakuliah_id' => $item->matakuliah_id,
                'sks' => $item->total_sks,
                'nim' => $item->nim,
                'total_nilai' => '0',
                'nilai_angka' => '0',
                'nilai_huruf' => 'E',
                'status' => 1,
            ]);
        }

        $tahun_akademik = 20241;

        $krs_mhs = ModelKRSMahasiwa::where('tahun_akademik',$tahun_akademik)
            ->get()
            ->map(function ($item) {
                $item->total_sks =
                    (int) ($item->krs_matkul->sks_teori ?? 0) +
                    (int) ($item->krs_matkul->sks_praktek ?? 0) +
                    (int) ($item->krs_matkul->sks_lapangan ?? 0);
                return $item;
            });

        foreach ($krs_mhs as $item){
            ModelNilaiMHS::create([
                'tahun_akademik' => $item->tahun_akademik,
                'matakuliah_id' => $item->matakuliah_id,
                'sks' => $item->total_sks,
                'nim' => $item->nim,
                'total_nilai' => '0',
                'nilai_angka' => '0',
                'nilai_huruf' => 'E',
                'status' => 1,
            ]);
        }

    }
}
