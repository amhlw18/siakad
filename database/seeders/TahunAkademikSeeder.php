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
        $semesters = ['Ganjil', 'Genap'];

        for ($i = 1; $i <= 10; $i++) {
            $startDate = Carbon::now()->subYears(rand(0, 5))->startOfYear();
            $endDate = $startDate->copy()->endOfYear();

            ModelTahunAkademik::create([
                'kode' => 'TA-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tahun_akademik' => $startDate->year . '/' . ($startDate->year + 1),
                'semester' => $semesters[array_rand($semesters)],
                'periode_pembayaran' => $startDate->copy()->addMonths(1)->format('Y-m-d'),
                'periode_perkuliahan' => $startDate->copy()->addMonths(2)->format('Y-m-d'),
                'periode_krs' => $startDate->copy()->addMonths(3)->format('Y-m-d'),
                'periode_penilaian' => $startDate->copy()->addMonths(4)->format('Y-m-d'),
                'periode_uts' => $startDate->copy()->addMonths(5)->format('Y-m-d'),
                'periode_uas' => $startDate->copy()->addMonths(6)->format('Y-m-d'),
                'status' => $i === 1 ? true : false, // Status aktif hanya untuk data pertama
            ]);
        }
    }
}
