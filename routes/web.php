<?php

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

    Route::middleware('shared')->group(function () {
        Route::resource('/dashboard/pembayaran', PembayaranController::class);
        Route::get('/dashboard/data-pembayaran/filter', [PembayaranController::class, 'filter']);
        Route::post('/dashboard/data-pembayaran', [PembayaranController::class, 'store']);
        Route::get('/dashboard/data-pembayaran/{nim}/edit', [PembayaranController::class, 'edit']);
        Route::post('/dashboard/data-pembayaran/{nim}', [PembayaranController::class, 'destroy']);
    });

});

Route::middleware('guest')->group(function (){
    Route::get('/', [ LoginController::class,'index']);
    Route::post('/login-user', [LoginController::class, 'authenticate'])->name('login');
});




Route::get('/home',function (){
   return redirect('/dashboard');
});


