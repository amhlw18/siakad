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



Route::resource('/dashboard/kurikulum', KurikulumControlller::class);
Route::resource('/dashboard/tahun-akademik', TahunAkademikControlller::class);
Route::resource('/dashboard/matakuliah', MatakuliahController::class);
Route::resource('/dashboard/prodi', ProdiController::class);
Route::resource('/dashboard/ruangan', RuanganController::class);
Route::resource('/dashboard/kelas', KelasController::class);
Route::resource('/dashboard/batas-sks', BatasSKSController::class);
Route::resource('/dashboard/data-dosen', DosenController::class);
Route::resource('/dashboard/data-mahasiswa', MahasiswaController::class);
Route::resource('/dashboard/kelas-mhs', KelasMahasiswaController::class);
Route::resource('/dashboard/pembayaran',\App\Http\Controllers\PembayaranController::class);

Route::get('/', [ DashBoardController::class,'index']);
