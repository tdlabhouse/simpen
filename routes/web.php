<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating']);


// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    //
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('add-barang', [BarangController::class, 'addbarang'])->name('add-barang');
    Route::post('simpan-barang', [BarangController::class, 'simpanbarang'])->name('simpan-barang');
    Route::get('edit-barang/{kode}', [BarangController::class, 'editbarang'])->name('edit-barang');
    Route::post('update-barang/{kode}', [BarangController::class, 'updatebarang'])->name('update-barang');
    Route::get('delete-barang/{kode}', [BarangController::class, 'deletebarang'])->name('delete-barang');
});
