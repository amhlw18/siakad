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


        ModelKelas::create([
            'prodi_id' => '13211',
            'nama_kelas' => 'Gizi 2022',
            'program' => 'Reguler',
            'kapasitas' => '10',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13211',
            'nama_kelas' => 'Gizi 2023',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13211',
            'nama_kelas' => 'Gizi 2024 A',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13211',
            'nama_kelas' => 'Gizi 2024 B',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13263',
            'nama_kelas' => 'Adminkes 2022',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13263',
            'nama_kelas' => 'Adminkes 2023',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13263',
            'nama_kelas' => 'Adminkes 2024 A',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '13263',
            'nama_kelas' => 'Adminkes 2024 B',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '59201',
            'nama_kelas' => 'TI 2022',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '59201',
            'nama_kelas' => 'TI 2023',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);

        ModelKelas::create([
            'prodi_id' => '59201',
            'nama_kelas' => 'TI 2024',
            'program' => 'Reguler',
            'kapasitas' => '20',
            'aktif' => 1, // Status aktif hanya untuk data pertama
        ]);
    }
}
