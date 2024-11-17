<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

//php artisan serve --host 192.168.1.39 --port 8001

class DashBoardController extends Controller
{
    public function index()
    {
        $status = 0;
        $peminjaman = Peminjaman::with(['data_buku', 'data_mhs', 'data_dosen'])
            ->where('status', $status)
            ->groupBy('user_id')
            ->select(
                'user_id',
                DB::raw('MAX(tanggal_pinjam) as tanggal_pinjam'),
                DB::raw('MAX(tanggal_kembali) as tanggal_kembali'),
                DB::raw('COUNT(buku_id) as jumlah_buku')
            )
            ->get();

        $jumlahBuku = DataBuku::get()->count();
        $jumlahBukuBelumKembali = Peminjaman::where('status', 0)->count();
        $jumlahBukuKembali = Peminjaman::where('status', 1)->count();

        return view('admin.index', [
            'pinjams' => $peminjaman,
            'jumlahBuku' => $jumlahBuku,
            'jumlahBukuKembali' => $jumlahBukuKembali,
            'jumlahBukuBelumKembali' => $jumlahBukuBelumKembali
        ]);
    }
}
