<?php

use App\Http\Controllers\admin\LoginAuth;
use App\Http\Controllers\rt\LoginRT;
use App\Http\Controllers\rw\LoginRW;
use App\Http\Controllers\admin\Main;
use App\Http\Controllers\admin\PemohonController;
use App\Http\Controllers\admin\PendudukController;
use App\Http\Controllers\admin\PetugasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\rt\KetuaRTController;
use App\Http\Controllers\rw\KetuaRWController;
use Illuminate\Support\Facades\Route;

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

Route::any('/',                                         [HomeController::class, 'main'])->name('home');
Route::any('/logout',                                   [HomeController::class, 'logout'])->name('logout');
Route::post('/data/proses',                             [HomeController::class, 'process_data'])->name('process-data');

Route::any('/kritik-saran',                             [KritikSaranController::class, 'main'])->name('krisar');
Route::any('/kritik-saran/process',                     [KritikSaranController::class, 'process'])->name('krisar.process');

// RT
Route::prefix('rt')->group(function () {
    Route::get('/auth',                                 [LoginRT::class, 'main'])->name('ketua_rt.login')->middleware('auth.login');
    Route::any('/auth/process',                         [LoginRT::class, 'process'])->name('ketua_rt.login-process');

    Route::middleware(['auth.rt'])->group(function () {
        Route::get('/',                                 [KetuaRTController::class, 'main'])->name('ketua_rt.home');
        Route::get('/verifikasi',                       [KetuaRTController::class, 'verifikasi'])->name('ketua_rt.verifikasi');
        Route::get('/verifikasi/{id}',                  [KetuaRTController::class, 'verify'])->name('ketua_rt.verify');
        Route::get('/delete/{id}',                      [KetuaRTController::class, 'delete'])->name('ketua_rt.delete');
    });
});

// RW
Route::prefix('rw')->group(function () {
    Route::get('/auth',                                 [LoginRW::class, 'main'])->name('ketua_rw.login')->middleware('auth.login');
    Route::any('/auth/process',                         [LoginRW::class, 'process'])->name('ketua_rw.login-process');

    Route::middleware(['auth.rw'])->group(function () {
        Route::get('/',                                 [KetuaRWController::class, 'main'])->name('ketua_rw.home');
        Route::get('/verifikasi',                       [KetuaRWController::class, 'verifikasi'])->name('ketua_rw.verifikasi');
        Route::get('/verifikasi/{id}',                  [KetuaRWController::class, 'verify'])->name('ketua_rw.verify');
        Route::get('/delete/{id}',                      [KetuaRWController::class, 'delete'])->name('ketua_rw.delete');
    });
});

// Kelurahan
Route::prefix('admin')->group(function () {
    Route::get('/auth',                                 [LoginAuth::class, 'main'])->name('lurah.login')->middleware('auth.login');
    Route::any('/auth/process',                         [LoginAuth::class, 'process'])->name('lurah.login-process');

    Route::middleware(['auth.loggedin'])->group(function () {
        Route::any('/',                                 [Main::class, 'home'])->name('lurah.home');

        // Data Petugas
        Route::get('kritik-saran',                      [Main::class, 'krisar'])->name('krisar.main');

        // Data Petugas
        Route::get('petugas',                           [PetugasController::class, 'main'])->name('petugas.main');
        Route::get('petugas/create',                    [PetugasController::class, 'create'])->name('petugas.create');
        Route::any('petugas/create/action',             [PetugasController::class, 'tambah'])->name('petugas.tambah');
        Route::get('petugas/delete/{id}',               [PetugasController::class, 'delete'])->name('petugas.delete');
        Route::post('petugas/edit/{id}',                [PetugasController::class, 'edit'])->name('petugas.edit');

        // Data Penduduk
        Route::get('penduduk',                          [PendudukController::class, 'main'])->name('penduduk.index');
        Route::get('penduduk/create',                   [PendudukController::class, 'add'])->name('penduduk.add');
        Route::post('penduduk/create',                  [PendudukController::class, 'create'])->name('penduduk.create');
        Route::post('penduduk/edit',                    [PendudukController::class, 'edit'])->name('penduduk.edit');
        Route::any('penduduk/delete/{id}',              [PendudukController::class, 'delete'])->name('penduduk.delete');

        // Data Pemohon
        Route::get('pemohon/cetak/{id}',                [PemohonController::class, 'cetak'])->name('pemohon.cetak');
        Route::get('pemohon/unduh/{id}',                [PemohonController::class, 'download'])->name('pemohon.download');
        Route::any('pemohon/delete/{id}',               [PemohonController::class, 'delete'])->name('pemohon.delete');
        Route::get('pemohon/verifikasi/lurah/{id}',     [PemohonController::class, 'verify_lurah'])->name('pemohon.verifikasi_lurah');
        Route::get('pemohon/verifikasi/rt/{id}',        [PemohonController::class, 'verify_rt'])->name('pemohon.verifikasi_rt');
        Route::get('pemohon/verifikasi/rw/{id}',        [PemohonController::class, 'verify_rw'])->name('pemohon.verifikasi_rw');
        Route::post('pemohon/add',                      [PemohonController::class, 'add'])->name('pemohon.add');
        Route::get('pemohon',                           [PemohonController::class, 'main'])->name('pemohon.index');
        Route::get('pemohon/verify-lurah',              [PemohonController::class, 'verifikasi_lurah'])->name('pemohon.verify_lurah');
        Route::get('pemohon/verify-rt',                 [PemohonController::class, 'verifikasi_rt'])->name('pemohon.verify_rt');
        Route::get('pemohon/verify-rw',                 [PemohonController::class, 'verifikasi_rw'])->name('pemohon.verify_rw');
        Route::get('pemohon/arsip/{id}',                [PemohonController::class, 'arsipkan'])->name('pemohon.arsipkan');
    });
});
