<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KurikulumControlller;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TahunAkademikControlller;
use App\Http\Controllers\RiwayatPeminjamanController;

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

Route::resource('/dashboard/databuku', DataBukuController::class);
Route::resource('/dashboard/kategori-buku', KategoriController::class);
Route::resource('/dashboard/datamhs', MahasiswaController::class);
Route::resource('/dashboard/datadosen', DosenController::class);
Route::resource('/dashboard/datapeminjaman', PeminjamanController::class);
Route::resource('/dashboard/riwayatpeminjaman', RiwayatPeminjamanController::class);

Route::resource('/dashboard/kurikulum', KurikulumControlller::class);
Route::resource('/dashboard/tahun-akademik', TahunAkademikControlller::class);

Route::get('/', [ DashBoardController::class,'index']);
