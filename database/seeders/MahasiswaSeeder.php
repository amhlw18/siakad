<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelMahasiswa;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kode_prodi =['13211','13263','15401','59201'];
        $faker = Faker::create('id_ID');
        $genders = ['Laki-laki', 'Perempuan'];
        $religions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $status_masuk =['Peserta Didik Baru','Pindahan','Pindahan Alih Bentuk','Alih Jenjang','Lintas Jalur','Naik Kelas',
            'Akselerasi','Mengulang','Lanjut Semester','Rekognisi Pembelajaran Lampau','Course','Fast Track'];
        $programs = ['Reguler', 'Non-Reguler'];
        $statuses = ['Aktif', 'Lulus', 'Non Aktif'];

        for ($i = 1; $i <= 50; $i++) {
            $gender = $genders[array_rand($genders)];
            ModelMahasiswa::create([
                'prodi_id' => $kode_prodi[array_rand($kode_prodi)],
                'nim' => $faker->unique()->numberBetween(100000000, 999999999),
                'nama_mhs' => $faker->name($gender == 'Laki-laki' ? 'male' : 'female'),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-12-31'),
                'nama_ayah' => $faker->name('male'),
                'nama_ibu' => $faker->name('female'),
                'jenis_kelamin' => $gender,
                'agama' => $religions[array_rand($religions)],
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'nik' => $faker->nik(),
                'alamat' => $faker->address,
                'status_masuk' => $status_masuk[array_rand($status_masuk)],
                'program' => $programs[array_rand($programs)],
                'tahun_masuk' => $faker->year($max = 'now'),
                'semester_masuk' => $faker->randomElement(['Ganjil', 'Genap']),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
