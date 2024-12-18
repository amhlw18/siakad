<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelKurikulum;
use Faker\Factory as Faker;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 4; $i++) {
            $prodi =['Teknologi Informasi','Gizi','Kebidanan','Administrasi Kesehatan'];
            $sksWajib = $faker->numberBetween(100, 130);
            $sksPilihan = $faker->numberBetween(20, 40);
            $jumlahSks = $sksWajib + $sksPilihan;

            ModelKurikulum::create([
                'tahun_akademik_id' => '1', // Sesuaikan dengan jumlah data tahun akademik
                'kode_kurikulum' => 'KUR-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_kurikulum' => $prodi[array_rand($prodi)] . $faker->year,
                'sks_wajib' => $sksWajib,
                'sks_pilihan' => $sksPilihan,
                'jumlah_sks' => $jumlahSks,
                'status' => $faker->boolean,
            ]);
        }



    }
}

