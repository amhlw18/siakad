<?php

use App\Http\Controllers\AspekPenilaianController;
use App\Http\Controllers\NeoFeeederController;
use App\Http\Controllers\NilaiSemesterController;
use App\Http\Controllers\PAMhsController;
use App\Http\Controllers\PenilaianController;
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
        Route::resource('/dashboard/kls-mhs', KelasMahasiswaController::class);

        Route::resource('/dashboard/data-jadwal', JadwalController::class);



        Route::get('/dashboard/kelas-mahasiswa/filter', [KelasMahasiswaController::class, 'filter']);
        Route::delete('/dashboard/kelas-mahasiswa/delete-all', [KelasMahasiswaController::class, 'deleteAll']);

        Route::get('/dashboard/data-jadwal-kuliah/{id}',[JadwalController::class, 'getByProdi']);
        Route::post('/dashboard/data-jadwal', [JadwalController::class, 'store']);
        Route::get('/dashboard/data-jadwal/{id}/edit', [JadwalController::class, 'edit']);
        Route::put('/dashboard/data-jadwal-update/{id}', [JadwalController::class, 'update']);
        Route::get('/dashboard/jadwal-kls/filter-data', [JadwalController::class, 'filter_data']);

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
    });


    Route::resource('/dashboard/pa-mhs', PAMhsController::class);
    Route::get('/dashboard/pa-mhss/filter', [PAMhsController::class,'filter']);
    //Route::get('/dashboard/get-data/filter', [PAMhsController::class,'filter']);

});

Route::middleware('guest')->group(function (){
    Route::get('/', [ LoginController::class,'index'])->name('login');
    Route::post('/login-user', [LoginController::class, 'authenticate']);
});

Route::get('/mata-kuliah', [NeoFeeederController::class, 'getListMataKuliah']);
Route::get('/kurikulum', [NeoFeeederController::class, 'getKurikulum']);
Route::get('/dosen', [NeoFeeederController::class, 'getDosen']);
Route::get('/matkul-dosen', [NeoFeeederController::class, 'getMatkulDosen']);
Route::get('/mahasiswa', [NeoFeeederController::class, 'getMahasiswa']);
Route::get('/krs-mhs', [NeoFeeederController::class, 'getKRSMhs']);

//Route::get('/coba', function (){
//    return view('admin.pa-mhs.index');
//});


Route::get('/home',function (){
   return redirect('/dashboard');
});


