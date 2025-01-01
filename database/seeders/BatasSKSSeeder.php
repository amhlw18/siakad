<?php

namespace Database\Seeders;

use App\Models\ModelBatasSKS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatasSKSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $prodi_id = 13211;
        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '2.00',
            'jumlah_sks' => '18',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.01',
            'ipk_max' => '2.50',
            'jumlah_sks' => '20',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.51',
            'ipk_max' => '2.99',
            'jumlah_sks' => '22',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '3.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);


        $prodi_id = 13263;
        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '2.00',
            'jumlah_sks' => '18',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.01',
            'ipk_max' => '2.50',
            'jumlah_sks' => '20',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.51',
            'ipk_max' => '2.99',
            'jumlah_sks' => '22',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '3.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        $prodi_id = 15401;
        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '2.00',
            'jumlah_sks' => '18',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.01',
            'ipk_max' => '2.50',
            'jumlah_sks' => '20',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.51',
            'ipk_max' => '2.99',
            'jumlah_sks' => '22',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '3.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        $prodi_id = 59201;
        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '2.00',
            'jumlah_sks' => '18',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.01',
            'ipk_max' => '2.50',
            'jumlah_sks' => '20',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '2.51',
            'ipk_max' => '2.99',
            'jumlah_sks' => '22',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '3.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);

        ModelBatasSKS::create([
            'prodi_id' => $prodi_id,
            'ipk_min' => '0.00',
            'ipk_max' => '4.00',
            'jumlah_sks' => '24',
        ]);
    }
}
