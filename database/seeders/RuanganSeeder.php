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
