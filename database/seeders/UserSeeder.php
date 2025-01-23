<?php

namespace Database\Seeders;

use App\Models\ModelDosen;
use App\Models\ModelMahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'user_id' => '12345',
            'name' => 'Administrator',
            'email' => '-',
            'email_verified_at' => now(),
            'role' => '1',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        $dosen = ModelDosen::all();

        foreach ($dosen as $item){
            User::create([
                'user_id' => $item->nidn,
                'name' => $item->nama_dosen,
                'email' => $item->email ?? '-',
                'email_verified_at' => now(),
                'role' => '3',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]);
        }

        $mahasiswa = ModelMahasiswa::all(); // Ambil semua data mahasiswa

        foreach ($mahasiswa as $mhs) {
            User::create([
                'user_id' => $mhs->nim,
                'name' => $mhs->nama_mhs,
                'email' => $mhs->email ?? '-',
                'email_verified_at' => now(),
                'role' => '4',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]);
        }

        User::create([
            'user_id' => 13211,
            'name' => 'Prodi Gizi',
            'email' => 'prodi.gizi@email.com' ?? '-',
            'email_verified_at' => now(),
            'role' => '5',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => 13263,
            'name' => 'Prodi Adminkes',
            'email' => 'prodi.adminkes@email.com' ?? '-',
            'email_verified_at' => now(),
            'role' => '5',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => 15401,
            'name' => 'Prodi Bidan',
            'email' => 'prodi.bidan@email.com' ?? '-',
            'email_verified_at' => now(),
            'role' => '5',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => 20240918,
            'name' => 'BAAK',
            'email' => 'baak.ikt@email.com' ?? '-',
            'email_verified_at' => now(),
            'role' => '6',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'user_id' => 20221104,
            'name' => 'Bendahara',
            'email' => 'bendahara.ikt@email.com' ?? '-',
            'email_verified_at' => now(),
            'role' => '2',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
    }
}
