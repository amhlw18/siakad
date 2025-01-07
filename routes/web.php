<?php

use App\Http\Controllers\AspekPenilaianController;
use App\Http\Controllers\KHSController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\NeoFeeederController;
use App\Http\Controllers\NilaiSemesterController;
use App\Http\Controllers\PAMhsController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TranskripNilaiController;
use App\Models\ModelKRSMahasiwa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KurikulumControlller;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\TahunAkademikControlller;
use \App\Http\Controllers\RuanganController;
use \App\Http\Controllers\KelasController;
use \App\Http\Controllers\BatasSKSController;
use \App\Http\Controllers\KelasMahasiswaController;
use \App\Http\Controllers\PembayaranController;
use \App\Http\Controllers\JadwalController;
use \App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function (){
    Route::middleware('superadmin')->group(function () {
        Route::resource('/dashboard/kurikulum', KurikulumControlller::class);
        Route::resource('/dashboard/tahun-akademik', TahunAkademikControlller::class);
        Route::resource('/dashboard/matakuliah', MatakuliahController::class);

        Route::resource('/dashboard/prodi', ProdiController::class);
        Route::resource('/dashboard/ruangan', RuanganController::class);
        Route::resource('/dashboard/kelas', KelasController::class);
        Route::resource('/dashboard/batas-sks', BatasSKSController::class);
        Route::resource('/dashboard/data-dosen', DosenController::class);
        Route::resource('/dashboard/data-mahasiswa', MahasiswaController::class);


    });
    Route::post('/logout-user', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ DashBoardController::class,'index']);

    Route::middleware('bendahara')->group(function () {
        Route::resource('/dashboard/pembayaran', PembayaranController::class);
        Route::get('/dashboard/data-pembayaran/filter', [PembayaranController::class, 'filter']);
        Route::post('/dashboard/data-pembayaran', [PembayaranController::class, 'store']);
        Route::get('/dashboard/data-pembayaran/{nim}/edit', [PembayaranController::class, 'edit']);
        Route::post('/dashboard/data-pembayaran/{nim}', [PembayaranController::class, 'destroy']);
    });

    Route::middleware('dosen')->group(function (){
        Route::resource('/dashboard/aspek-nilai', AspekPenilaianController::class);
        Route::post('/dashboard/aspekk-nilai', [AspekPenilaianController::class, 'store']);
        Route::get('/dashboard/aspekk-nilai/{id}/edit', [AspekPenilaianController::class, 'edit']);
        Route::get('/dashboard/aspekk-nilai/filter', [AspekPenilaianController::class, 'filter']);

        Route::resource('/dashboard/nilai-semester',PenilaianController::class);
        Route::get('/dashboard/nilai-semester/{id}/{mk}/edit', [PenilaianController::class, 'edit']);
        Route::get('/dashboard/nilai-semester/{id}/filter', [PenilaianController::class, 'filter']);
        Route::get('/dashboard/nilai-semester/{id}/{id_kelas}', [PenilaianController::class, 'show']);
        Route::post('/dashboard/nilai-semester/simpan-nilai',[PenilaianController::class,'simpanNilai']);
        Route::post('/dashboard/nilai-semester/hapus-nilai',[PenilaianController::class,'hapusNilai']);

        Route::get('/dashboard/dosen/detail-pa/{id}',[DashBoardController::class, 'detailPA']);
        Route::post('/dashboard/dosen/detail-pa',[DashBoardController::class,'simpanKRS']);
        Route::post('/dashboard/dosen/detail-pa/delete',[DashBoardController::class,'batalkanKRS']);
    });

    Route::middleware('prodi')->group(function (){
        Route::resource('/dashboard/kls-mhs', KelasMahasiswaController::class);

        Route::resource('/dashboard/data-jadwal', JadwalController::class);
        Route::get('/dashboard/kelas-mahasiswa/filter', [KelasMahasiswaController::class, 'filter']);
        Route::delete('/dashboard/kelas-mahasiswa/delete-all', [KelasMahasiswaController::class, 'deleteAll']);

        // Route::get('/dashboard/data-jadwal-kuliah/{id}',[JadwalController::class, 'getByProdi']);
        Route::post('/dashboard/data-jadwal', [JadwalController::class, 'store']);
        // Route::get('/dashboard/data-jadwal/{id}/{prodi_id}/edit', [JadwalController::class, 'edit']);
        Route::put('/dashboard/data-jadwal-update/{id}', [JadwalController::class, 'update']);
        Route::post('/dashboard/data-jadwal-update/{id}', [JadwalController::class, 'update']);

        Route::resource('/dashboard/pa-mhs', PAMhsController::class);
        Route::get('/dashboard/pa-mhss/filter', [PAMhsController::class,'filter']);
        //Route::get('/dashboard/get-data/filter', [PAMhsController::class,'filter']);
    });

    Route::middleware('mahasiswa')->group(function (){
        Route::resource('/dashboard/krs-mhs', KRSController::class);
        Route::resource('/dashboard/khs-mhs', KHSController::class);
        Route::resource('/dashboard/transkrip-nilai', TranskripNilaiController::class);

        Route::post('/print/khs', [PrintController::class,'print_khs']);
        Route::post('/print/transkrip-nilai', [PrintController::class,'print_transkrip_nilai']);
    });

    Route::get('/dashboard/profile', [ProfileController::class,'index']);

});

Route::middleware('guest')->group(function (){
    Route::get('/', [ LoginController::class,'index'])->name('login');
    Route::post('/login-user', [LoginController::class, 'authenticate']);
});

Route::get('/mata-kuliah', [NeoFeeederController::class, 'getListMataKuliah']);
Route::get('/kurikulum', [NeoFeeederController::class, 'getKurikulum']);
Route::get('/prodi', [NeoFeeederController::class, 'getProdi']);
Route::get('/dosen', [NeoFeeederController::class, 'getDosen']);
Route::get('/matkul-dosen', [NeoFeeederController::class, 'getMatkulDosen']);
Route::get('/mahasiswa', [NeoFeeederController::class, 'getMahasiswa']);
Route::get('/krs-mhs', [NeoFeeederController::class, 'getKRSMhs']);

Route::get('matakuliah/filter', [MatakuliahController::class, 'filterData'])->name('matakuliah.filter');
Route::get('mhs/filter', [MahasiswaController::class, 'filterData'])->name('mhs.filter');
Route::get('kls/filter', [KelasMahasiswaController::class, 'filterData'])->name('kelas.filter');
Route::get('kls-mhs/filter', [KelasMahasiswaController::class, 'filterDataKelas'])->name('kelas-mhs.filter');
Route::get('/get-kelas/{prodiId}', [KelasMahasiswaController::class, 'getKelas'])->name('get.kelas');

Route::get('/filter-kls/filter-data', [JadwalController::class, 'filter_data'])->name('get.jadwal');
Route::get('/krs/filter-data', [KRSController::class, 'filter_data'])->name('get.krs');
Route::get('/khs/filter-data', [KHSController::class, 'filter_data'])->name('get.khs');

//Route::get('/coba', function (){
//    return view('admin.pa-mhs.index');
//});


Route::get('/home',function (){
   return redirect('/dashboard');
});


