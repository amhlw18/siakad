<?php

namespace Database\Seeders;

use App\Models\ModelProdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ModelProdi::create([
            'kode_prodi' => '13211',
            'nama_prodi' => 'Gizi',
            'Jenjang' => 'S-1',
            'ka_prodi' => '1',
        ]);

        ModelProdi::create([
            'kode_prodi' => '13263',
            'nama_prodi' => 'Adminstrasi Kesehatan',
            'Jenjang' => 'S-1',
            'ka_prodi' => '1',
        ]);

        ModelProdi::create([
            'kode_prodi' => '15401',
            'nama_prodi' => 'Kebidanan',
            'Jenjang' => 'D-3',
            'ka_prodi' => '1',
        ]);

        ModelProdi::create([
            'kode_prodi' => '59201',
            'nama_prodi' => 'Teknologi Informasi',
            'Jenjang' => 'S-1',
            'ka_prodi' => '1',
        ]);
    }
}
