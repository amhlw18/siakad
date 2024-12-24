<?php

namespace Database\Seeders;

use App\Models\ModelDosen;
use App\Models\ModelMahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'name' => 'Madi',
            'email' => '-',
            'email_verified_at' => now(),
            'role' => '1',
            'password' => '$2a$12$GIlBJCcwXEp.hn0Y3CxuKuberB1jyWHSes2ZqeOV6DhZFMNG5jeBK', // 12345
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
                'password' => '$2a$12$GIlBJCcwXEp.hn0Y3CxuKuberB1jyWHSes2ZqeOV6DhZFMNG5jeBK', // 12345
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
                'password' => '$2a$12$GIlBJCcwXEp.hn0Y3CxuKuberB1jyWHSes2ZqeOV6DhZFMNG5jeBK', // 12345
                'remember_token' => Str::random(10),
            ]);
        }

    }
}
