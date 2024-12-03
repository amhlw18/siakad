<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelMatakuliah;
use Faker\Factory as Faker;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $kode_prodi =['13211','13263','15401','59201'];
        $kelompokMK = ['MPK-Pengembangan Kepribadian', 'MKK-Keilmuan dan Keterampilan',
            'MKB-Keahlian Berkarya','MPK-Prilaku Berkarya','MBB-Berkehidupan Bermasyarakat','MKU/MKDU','MKDK','MKK'];
        $jenisKelompok = ['Inti', 'Institusi'];
        $jenisMK = ['Wajib', 'Pilihan', 'Wajib Peminatan','Pilihan Peminatan','TA/Skripsi/Tesis/Desertasi'];
        $statusMK = ['Aktif', 'Nonaktif','Ahli Bentuk','Hapus','Alih Kelola','Marger'];

        for ($i = 1; $i <= 20; $i++) {
            ModelMatakuliah::create([
                'kurikulum_id' => '1',
                'kode_prodi' => $kode_prodi[array_rand($kode_prodi)],
                'kode_mk' => 'MK-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_mk' => $faker->words(3, true),
                'semester' => $faker->numberBetween(1, 8),
                'sks_teori' => $faker->numberBetween(1, 3),
                'sks_praktek' => $faker->numberBetween(0, 2),
                'sks_lapangan' => $faker->numberBetween(0, 2),
                'kelompok_mk' => $kelompokMK[array_rand($kelompokMK)],
                'jenis_kelompok' => $jenisKelompok[array_rand($jenisKelompok)],
                'jenis_mk' => $jenisMK[array_rand($jenisMK)],
                'status_mk' => $statusMK[array_rand($statusMK)],
                'silabus_mk' => $faker->boolean ? 'Ya' : 'Tidak',
                'sap_mk' => $faker->boolean ? 'Ya' : 'Tidak',
                'bahan_ajar' => $faker->boolean ? 'Ya' : 'Tidak',
                'diktat' => $faker->boolean ? 'Ya' : 'Tidak',
            ]);
        }
    }
}
