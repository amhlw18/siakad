<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelDosen;
use Faker\Factory as Faker;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $gelarBelakang = ['S.Kom', 'M.Kom', 'Dr.', 'Ir.', 'S.T', 'M.T'];
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $agama = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'];
        $ikatanKerja = ['Dosen DPK PNS', 'Dosen Luar Biasa', 'Dosen Kontrak','Dosen Tetap'];
        $pendidikan = ['S-1', 'S-2', 'S-3','D-4','D-3','D-2','D-1','SP-1','SP-2','Profesi'];
        $status = ['Aktif Mengajar', 'Cuti','Keluar','Meninggal','Pensiun','Studi Lanjut','Tugas Di Instansi Lain','Aktif Mengajar'];
        $jabatanAkademik = ['Tenaga Pengajar','Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'];
        $golongan =['IIIA Penata Muda','IIIB Penata Muda Tk.1','IIIC Penata','IIID Penata Tk.1','IVA Pembina','IVB Pembina Tk.1',
            'IVC Pembina Utama Muda','IVD Pembina Utama Madya','IVE Pembina Utama'];

        for ($i = 1; $i <= 20; $i++) {
            $gender = $jenisKelamin[array_rand($jenisKelamin)];
            $name = $faker->name($gender == 'Laki-laki' ? 'male' : 'female');

            ModelDosen::create([
                'nidn' => $faker->numerify('09#########'),
                'nama_dosen' => $name,
                'gelar_depan' => '',
                'gelar_belakang' => $gelarBelakang[array_rand($gelarBelakang)],
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '-30 years'),
                'jenis_kelamin' => $gender,
                'agama' => $agama[array_rand($agama)],
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'tgl_kerja' => $faker->date('Y-m-d', '-5 years'),
                'ikatan_kerja' => $ikatanKerja[array_rand($ikatanKerja)],
                'pendidikan' => $pendidikan[array_rand($pendidikan)],
                'status' => $status[array_rand($status)],
                'jabatan_akademik' => $jabatanAkademik[array_rand($jabatanAkademik)],
                'jabatan_struktural' => rand(0, 1) ? 'Kepala Program Studi' : null,
                'golongan' => $golongan[array_rand($golongan)],
            ]);
        }
    }
}
