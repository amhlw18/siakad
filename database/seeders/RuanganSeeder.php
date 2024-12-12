<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelRuangan;
use Faker\Factory as Faker;

class RuanganSeeder extends Seeder
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
        $gedungs = ['Gedung A', 'Gedung B', 'Gedung C', 'Gedung D'];

        for ($i = 1; $i <= 20; $i++) {
            ModelRuangan::create([
                'prodi_id' => $kode_prodi[array_rand($kode_prodi)], // Sesuaikan dengan jumlah data prodi
                'nama_ruangan' => 'Ruangan ' . $faker->unique()->numberBetween(101, 120),
                'gedung' => $gedungs[array_rand($gedungs)],
                'lantai' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
