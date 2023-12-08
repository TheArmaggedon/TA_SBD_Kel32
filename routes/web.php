<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\KartuAksesController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RecyclebinController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route karyawan
Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('karyawan/add', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('karyawan/store', [KaryawanController::class , 'store'])->name('karyawan.store');
Route::get('karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::post('karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::post('karyawan/softDelete/{id}', [KaryawanController::class, 'softDelete'])->name('karyawan.softDelete');


//Route kartu akses
Route::get('kartu_akses', [KartuAksesController::class, 'index'])->name('kartu_akses.index');
Route::get('kartu_akses/add', [KartuAksesController::class, 'create'])->name('kartu_akses.create');
Route::post('kartu_akses/store', [KartuAksesController::class , 'store'])->name('kartu_akses.store');
Route::get('kartu_akses/edit/{id}', [KartuAksesController::class, 'edit'])->name('kartu_akses.edit');
Route::post('kartu_akses/update/{id}', [KartuAksesController::class, 'update'])->name('kartu_akses.update');
Route::post('kartu_akses/softDelete/{id}', [KartuAksesController::class, 'softDelete'])->name('kartu_akses.softDelete');


//route pengguna untuk proses login
Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
Route::get('pengguna/add', [PenggunaController::class, 'create'])->name('pengguna.create');
Route::post('pengguna/login', [PenggunaController::class,'login'])->name('pengguna.login');
Route::post('pengguna/signup', [PenggunaController::class , 'signup'])->name('pengguna.signup');
Route::post('pengguna/softDelete/{id}', [PenggunaController::class, 'softDelete'])->name('pengguna.softDelete');

//route ruangan
Route::get('ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('ruangan/add', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('ruangan/store', [RuanganController::class , 'store'])->name('ruangan.store');
Route::get('ruangan/edit/{id}', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::post('ruangan/update/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::post('ruangan/softDelete/{id}', [RuanganController::class, 'softDelete'])->name('ruangan.softDelete');

//route recycle-bin
Route::get('/recyclebin/index', [RecyclebinController::class,'index'])->name('recyclebin.index');
Route::post('karyawan/hardDelete/{id}', [KaryawanController::class, 'hardDelete' ])->name('karyawan.hardDelete');
Route::post('karyawan/restore/{id}', [KaryawanController::class, 'restore'])->name('karyawan.restore');
Route::post('ruangan/hardDelete/{id}', [RuanganController::class, 'hardDelete' ])->name('ruangan.hardDelete');
Route::post('ruangan/restore/{id}', [RuanganController::class, 'restore'])->name('ruangan.restore');
Route::post('pengguna/hardDelete/{id}', [PenggunaController::class, 'hardDelete' ])->name('pengguna.hardDelete');
Route::post('kartu_akses/hardDelete/{id}', [KartuAksesController::class, 'hardDelete' ])->name('kartu_akses.hardDelete');
Route::post('kartu_akses/restore/{id}', [KartuAksesController::class, 'restore'])->name('kartu_akses.restore');

//route challenge
Route::get('/challenge/index', [ChallengeController::class, 'index'])->name('challenge.index');

