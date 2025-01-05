<?php

namespace Database\Seeders;

use App\Models\ModelMahasiswa;
use App\Models\ModelStatusKRS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKRSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $mahasiswa = ModelMahasiswa::where('status','Aktif')->get(); // Ambil semua data mahasiswa

        foreach ($mahasiswa as $mhs) {
            ModelStatusKRS::create([
                'nim' => $mhs->nim,
                'dikunci' => 1,
                'disetujui' => 1,
            ]);
        }
    }
}
