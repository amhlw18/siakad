<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelTahunAkademik;
use Illuminate\Support\Carbon;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$semesters = ['Ganjil', 'Genap'];
        $startDate = Carbon::now()->subYears(rand(0, 5))->startOfYear();

        ModelTahunAkademik::create([
            'Kode' => '20211',
            'tahun_akademik' => '2021/2022 Ganjil',
            'semester' => 'Ganjil',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20212',
            'tahun_akademik' => '2021/2022 Genap',
            'semester' => 'Genap',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20221',
            'tahun_akademik' => '2022/2023 Ganjil',
            'semester' => 'Ganjil',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20222',
            'tahun_akademik' => '2022/2023 Genap',
            'semester' => 'Genap',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20223',
            'tahun_akademik' => '2022/2023 Pendek',
            'semester' => 'Pendek',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20231',
            'tahun_akademik' => '2023/2024 Ganjil',
            'semester' => 'Ganjil',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20232',
            'tahun_akademik' => '2023/2024 Genap',
            'semester' => 'Genap',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 0, // Status aktif hanya untuk data pertama
        ]);

        ModelTahunAkademik::create([
            'Kode' => '20241',
            'tahun_akademik' => '2024/2025 Ganjil',
            'semester' => 'Ganjil',
            'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
            'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
            'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
            'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
            'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
            'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
            'status' => 1, // Status aktif hanya untuk data pertama
        ]);
    }
}
