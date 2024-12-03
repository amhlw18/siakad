<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelKelas;
use Faker\Factory as Faker;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kode_prodi =['13211','13263','15401','59201'];
        $programs = ['Reguler', 'Non-Reguler'];

        for ($i = 1; $i <= 4; $i++) {
            ModelKelas::create([
                'prodi_id' => $kode_prodi[array_rand($kode_prodi)], // Sesuaikan dengan jumlah data prodi
                'nama_kelas' => 'Kelas ' . strtoupper($faker->randomLetter()) . $faker->unique()->numberBetween(1, 5),
                'program' => $programs[array_rand($programs)],
                'kapasitas' => $faker->numberBetween(20, 50),
                'aktif' => $faker->boolean(70), // 70% kemungkinan kelas aktif
            ]);
        }
    }
}
