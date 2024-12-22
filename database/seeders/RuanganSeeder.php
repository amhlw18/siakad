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

        ModelRuangan::create([
            'prodi_id' => '13211',
            'nama_ruangan' => 'Ruangan 1',
            'gedung' => 'A',
            'lantai' => '3',
        ]);

        ModelRuangan::create([
            'prodi_id' => '13211',
            'nama_ruangan' => 'Lab Kimia 1',
            'gedung' => 'A',
            'lantai' => '3',
        ]);

        ModelRuangan::create([
            'prodi_id' => '13211',
            'nama_ruangan' => 'Ruangan 2',
            'gedung' => 'A',
            'lantai' => '3',
        ]);

        ModelRuangan::create([
            'prodi_id' => '13263',
            'nama_ruangan' => 'Ruangan 2',
            'gedung' => 'A',
            'lantai' => '3',
        ]);

        ModelRuangan::create([
            'prodi_id' => '13263',
            'nama_ruangan' => 'Ruangan 3',
            'gedung' => 'A',
            'lantai' => '3',
        ]);

        ModelRuangan::create([
            'prodi_id' => '59201',
            'nama_ruangan' => 'Ruangan 1',
            'gedung' => 'A',
            'lantai' => '2',
        ]);

        ModelRuangan::create([
            'prodi_id' => '15401',
            'nama_ruangan' => 'Ruangan 2',
            'gedung' => 'A',
            'lantai' => '1',
        ]);

        ModelRuangan::create([
            'prodi_id' => '15401',
            'nama_ruangan' => 'Ruangan 3',
            'gedung' => 'A',
            'lantai' => '1',
        ]);

    }
}
