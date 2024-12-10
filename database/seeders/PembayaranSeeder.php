<?php

namespace Database\Seeders;

use App\Models\ModelMahasiswa;
use App\Models\ModelPembayaran;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $mahasiswa = ModelMahasiswa::all(); // Ambil semua data mahasiswa

        foreach ($mahasiswa as $mhs) {
            ModelPembayaran::create([
                'tahun_akademik' => '1',
                'nim' => $mhs->nim,
                'prodi_id' => $mhs->prodi_id,
                'tgl_bayar' => now()->format('Y-m-d H:i:s'),
                'is_bayar' => 1,
            ]);
        }
    }
}
