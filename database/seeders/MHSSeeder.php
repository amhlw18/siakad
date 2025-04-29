<?php

namespace Database\Seeders;

use App\Models\ModelBuatMHS;
use App\Models\ModelMahasiswa;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class MHSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi_id = 15401;
//        $tahun_masuk = '2022';
//
//        $mhs_angkatan_2022 = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        foreach ($mhs_angkatan_2022 as $item){
//            $namaLower = Str::lower($item->nama_mhs);
//            $email = str_replace(' ', '', $namaLower) . '@gmail.com';
//
//            ModelBuatMHS::create([
//               'fakultas_id' => 12,
//                'kelas_id' => 10,
//                'nim' => $item->nim,
//                'nama' => $item->nama_mhs,
//                'email' => $email,
//                'password' => Hash::make('12345678'),
//                'foto' => 'default.png',
//            ]);
//        }
//
//        $tahun_masuk = '2023';
//        $mhs_angkatan_2023 = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
//            ->where('prodi_id', $prodi_id)
//            ->get();
//
//        foreach ($mhs_angkatan_2023 as $item){
//            $namaLower = Str::lower($item->nama_mhs);
//            $email = str_replace(' ', '', $namaLower) . '@gmail.com';
//
//            ModelBuatMHS::create([
//                'fakultas_id' => 12,
//                'kelas_id' => 12,
//                'nim' => $item->nim,
//                'nama' => $item->nama_mhs,
//                'email' => $email,
//                'password' => Hash::make('12345678'),
//                'foto' => 'default.png',
//            ]);
//        }

        $tahun_masuk = '2024';
        $mhs_angkatan_2024 = ModelMahasiswa::where('tahun_masuk', $tahun_masuk)
            ->where('prodi_id', $prodi_id)
            ->get();

        foreach ($mhs_angkatan_2024 as $item){
            $namaLower = Str::lower($item->nama_mhs);
            $email = str_replace(' ', '', $namaLower) . '@gmail.com';

            ModelBuatMHS::create([
                'fakultas_id' => 12,
                'kelas_id' => 14,
                'nim' => $item->nim,
                'nama' => $item->nama_mhs,
                'email' => $email,
                'password' => Hash::make('12345678'),
                'foto' => 'default.png',
            ]);
        }
    }
}
