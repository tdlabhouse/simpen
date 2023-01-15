<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FpbController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TtbController;
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

    // Bagian
    Route::get('bagian', [BagianController::class, 'index'])->name('bagian');
    Route::get('add-bagian', [BagianController::class, 'addbagian'])->name('add-bagian');
    Route::post('simpan-bagian', [BagianController::class, 'simpanbagian'])->name('simpan-bagian');
    Route::get('edit-bagian/{kode}', [BagianController::class, 'editbagian'])->name('edit-bagian');
    Route::post('update-bagian/{kode}', [BagianController::class, 'updatebagian'])->name('update-bagian');
    Route::get('delete-bagian/{kode}', [BagianController::class, 'deletebagian'])->name('delete-bagian');

    // Supplier
    Route::get('supplier', [SuplierController::class, 'index'])->name('supplier');
    Route::get('add-supplier', [SuplierController::class, 'addsupplier'])->name('add-supplier');
    Route::post('simpan-supplier', [SuplierController::class, 'simpansupplier'])->name('simpan-supplier');
    Route::get('edit-supplier/{kode}', [SuplierController::class, 'editsupplier'])->name('edit-supplier');
    Route::post('update-supplier/{kode}', [SuplierController::class, 'updatesupplier'])->name('update-supplier');
    Route::get('delete-supplier/{kode}', [SuplierController::class, 'deletesupplier'])->name('delete-supplier');

    // FPB
    Route::get('fpb', [FpbController::class, 'index'])->name('fpb');
    Route::get('add-fpb', [FpbController::class, 'addfpb'])->name('add-fpb');
    Route::post('simpan-fpb', [FpbController::class, 'simpanfpb'])->name('simpan-fpb');

    // PO
    Route::get('po', [PoController::class, 'index'])->name('po');
    Route::get('add-po/{kode}', [PoController::class, 'addpo'])->name('add-po');
    Route::post('simpan-po', [PoController::class, 'simpanpo'])->name('simpan-po');
    Route::post('simpan-bayar', [PoController::class, 'simpanbayar'])->name('simpan-bayar');
    Route::get('cetak-po/{kode}', [PoController::class, 'cetakpo'])->name('cetak-po');
    Route::get('bayar-po/{kode}', [PoController::class, 'bayarpo'])->name('bayar-po');

    // TTB
    Route::get('ttb', [TtbController::class, 'index'])->name('ttb');
    Route::get('add-ttb', [TtbController::class, 'addttb'])->name('add-ttb');
    Route::post('simpan-ttb', [TtbController::class, 'simpanttb'])->name('simpan-ttb');
    Route::get('detail-ttb/{kode}', [TtbController::class, 'detailttb'])->name('detail-ttb');
});
