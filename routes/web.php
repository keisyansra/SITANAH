<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
    // return redirect('/login');
// });

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');



Route::middleware(['auth'])->group(function() {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::middleware(['auth', 'role:admin'])->group(function() {
        // ROUTE USER //
        Route::group(['prefix' => 'user'], function () {
            Route::post('/', [UserController::class, 'index']);
            Route::get('/', [UserController::class, 'index']); // Menampilkan halaman awal 
            Route::post('/list', [UserController::class, 'list']); // Menampilkan data dalam bentuk JSON untuk DataTables
            Route::get('/create', [UserController::class, 'create']); // Menampilkan halaman form tambah
            Route::post('/store', [UserController::class, 'store']); // Menyimpan data baru
            Route::get('/{id}/show', [UserController::class, 'show']); // Menampilkan detail 
            Route::get('/{id}/edit', [UserController::class, 'edit']); // Menampilkan halaman form edit 
            Route::put('/{id}/update', [UserController::class, 'update']); // Menyimpan perubahan data 
            Route::get('/{id}/delete', [UserController::class, 'confirm']); // Tampilan form delete  AJAX
            Route::delete('/{id}/delete', [UserController::class, 'delete']); // Hapus data  AJAX
            Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus data
        });

        // ROUTE LOKASI //
        Route::group(['prefix' => 'lokasi'], function () {
            Route::post('/', [LokasiController::class, 'index']);
            Route::get('/', [LokasiController::class, 'index']); // Menampilkan halaman awal level
            Route::post('/list', [LokasiController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
            Route::get('/create', [LokasiController::class, 'create']); // Menampilkan halaman form tambah level
            Route::post('/store', [LokasiController::class, 'store']); // Menyimpan data level baru
            Route::get('/{id}/show', [LokasiController::class, 'show']); // Menampilkan detail level
            Route::get('/{id}/edit', [LokasiController::class, 'edit']); // Menampilkan halaman form edit level
            Route::put('/{id}/update', [LokasiController::class, 'update']); // Menyimpan perubahan data level
            Route::get('/{id}/delete', [LokasiController::class, 'confirm']); // Tampilan form delete level AJAX
            Route::delete('/{id}/delete', [LokasiController::class, 'delete']); // Hapus data level AJAX
            Route::delete('/{id}', [LokasiController::class, 'destroy']); // Menghapus data level
        });
        // ROUTE TANAH //
        Route::group(['prefix' => 'tanah'], function () {
            Route::post('/', [TanahController::class, 'index']);
            Route::get('/', [TanahController::class, 'index']); // Menampilkan halaman awal level
            Route::post('/list', [TanahController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
            Route::get('/create', [TanahController::class, 'create']); // Menampilkan halaman form tambah level
            Route::post('/store', [TanahController::class, 'store']); // Menyimpan data level baru
            Route::get('/{id}/show', [TanahController::class, 'show']); // Menampilkan detail level
            Route::get('/{id}/edit', [TanahController::class, 'edit']); // Menampilkan halaman form edit level
            Route::put('/{id}/update', [TanahController::class, 'update']); // Menyimpan perubahan data level
            Route::get('/{id}/delete', [TanahController::class, 'confirm']); // Tampilan form delete level AJAX
            Route::delete('/{id}/delete', [TanahController::class, 'delete']); // Hapus data level AJAX
            Route::delete('/{id}', [TanahController::class, 'destroy']); // Menghapus data level
        });
    });

    Route::middleware(['auth','role:kasir'])->group(function(){

        // ROUTE NASABAH //
        Route::group(['prefix' => 'nasabah'], function () {
            Route::post('/', [NasabahController::class, 'index']);
            Route::get('/', [NasabahController::class, 'index']); // Menampilkan halaman awal level
            Route::post('/list', [NasabahController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
            Route::get('/create', [NasabahController::class, 'create']); // Menampilkan halaman form tambah level
            Route::post('/store', [NasabahController::class, 'store']); // Menyimpan data level baru
            Route::get('/{id}/show', [NasabahController::class, 'show']); // Menampilkan detail level
            Route::get('/{id}/edit', [NasabahController::class, 'edit']); // Menampilkan halaman form edit level
            Route::put('/{id}/update', [NasabahController::class, 'update']); // Menyimpan perubahan data level
            Route::get('/{id}/delete', [NasabahController::class, 'confirm']); // Tampilan form delete level AJAX
            Route::delete('/{id}/delete', [NasabahController::class, 'delete']); // Hapus data level AJAX
            Route::delete('/{id}', [NasabahController::class, 'destroy']); // Menghapus data level
        });
    
        // ROUTE PENJUALAN //
        Route::group(['prefix' => 'penjualan'], function () {
            Route::post('/', [PenjualanController::class, 'index']);
            Route::get('/', [PenjualanController::class, 'index']); // Menampilkan halaman awal level
            Route::post('/list', [PenjualanController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
            Route::get('/create', [PenjualanController::class, 'create']); // Menampilkan halaman form tambah level
            Route::post('/store', [PenjualanController::class, 'store']); // Menyimpan data level baru
            Route::get('/{id}/show', [PenjualanController::class, 'show']); // Menampilkan detail level
            Route::get('/{id}/edit', [PenjualanController::class, 'edit']); // Menampilkan halaman form edit level
            Route::put('/{id}/update', [PenjualanController::class, 'update']); // Menyimpan perubahan data level
            Route::get('/{id}/delete', [PenjualanController::class, 'confirm']); // Tampilan form delete level AJAX
            Route::delete('/{id}/delete', [PenjualanController::class, 'delete']); // Hapus data level AJAX
            Route::delete('/{id}', [PenjualanController::class, 'destroy']); // Menghapus data level
        });
    });

});