<?php

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

// controller admin route
use App\Http\Controllers\AdminCtrl;
use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\TesCtrl;






Route::get('/', [AdminCtrl::class,'index']);
// Route::get('/', [TesCtrl::class,'index']);


// Login
Route::get('/login', [LoginCtrl::class,'index']);
Route::post('/login/cek', [LoginCtrl::class,'cek_login']);

Route::get('/logout', [LoginCtrl::class,'logout']);



//barang
Route::get('/dashboard/barang/data', [AdminCtrl::class,'barang']);
Route::get('/dashboard/barang/add', [AdminCtrl::class,'barang_add']);
Route::post('/dashboard/barang/act', [AdminCtrl::class,'barang_act']);

Route::get('/dashboard/barang/detail/{id}', [AdminCtrl::class,'barang_detail']);
Route::get('/dashboard/barang/edit/{id}', [AdminCtrl::class,'barang_edit']);

Route::post('/dashboard/barang/update', [AdminCtrl::class,'barang_update']);
Route::get('/dashboard/barang/delete/{id}', [AdminCtrl::class,'barang_delete']);

Route::post('/dashboard/barang/import_excel', [AdminCtrl::class,'barang_import_excell']);

//barang masuk
Route::get('/dashboard/barang_masuk/data', [AdminCtrl::class,'barang_masuk']);
Route::get('/dashboard/barang_masuk/add', [AdminCtrl::class,'barang_masuk_add']);
Route::post('/dashboard/barang_masuk/act', [AdminCtrl::class,'barang_masuk_act']);

Route::get('/dashboard/barang_masuk/edit/{id}', [AdminCtrl::class,'barang_masuk_edit']);
Route::post('/dashboard/barang_masuk/update', [AdminCtrl::class,'barang_masuk_update']);
Route::get('/dashboard/barang_masuk/delete/{id}', [AdminCtrl::class,'barang_masuk_delete']);

// barang keluar
Route::get('/dashboard/barang_keluar/data', [AdminCtrl::class,'barang_keluar']);
Route::get('/dashboard/barang_keluar/add', [AdminCtrl::class,'barang_keluar_add']);
Route::post('/dashboard/barang_keluar/act', [AdminCtrl::class,'barang_keluar_act']);

Route::get('/dashboard/barang_keluar/edit/{id}', [AdminCtrl::class,'barang_keluar_edit']);
Route::post('/dashboard/barang_keluar/update', [AdminCtrl::class,'barang_keluar_update']);
Route::get('/dashboard/barang_keluar/delete/{id}', [AdminCtrl::class,'barang_keluar_delete']);

// transaksi barang
Route::get('/dashboard/transaksi/data', [AdminCtrl::class,'transaksi']);
Route::get('/dashboard/transaksi/detail/{id}', [AdminCtrl::class,'transaksi_detail']);
Route::get('/dashboard/transaksi/delete/{id}', [AdminCtrl::class,'transaksi_delete']);

// lokasi barang
Route::get('/dashboard/lokasi/data', [AdminCtrl::class,'lokasi']);
Route::post('/dashboard/lokasi/act', [AdminCtrl::class,'lokasi_act']);
Route::get('/dashboard/lokasi/edit/{id}', [AdminCtrl::class,'lokasi_edit']);
Route::post('/dashboard/lokasi/update', [AdminCtrl::class,'lokasi_update']);
Route::get('/dashboard/lokasi/delete/{id}', [AdminCtrl::class,'lokasi_delete']);


// cek ajax barang
Route::post('/ajax/kode-masuk',[AdminCtrl::class,'ajax_kode']);

// cetak barcode
Route::post('/dashboard/barang_detail/cetak_barcode_item', [AdminCtrl::class,'cetak_barcode_peritem']);

// cetak laporan
Route::post('/dashboard/barang/cetak', [AdminCtrl::class,'cetak_barang']);
Route::post('/dashboard/barang_masuk/cetak', [AdminCtrl::class,'cetak_barang_masuk']);
Route::post('/dashboard/barang_keluar/cetak', [AdminCtrl::class,'cetak_barang_keluar']);
Route::post('/dashboard/transaksi/cetak', [AdminCtrl::class,'cetak_transaksi']);



Route::get('/dashboard/uji/data', [AdminCtrl::class,'uji_data']);



// role 
Route::get('/dashboard/role/data', [AdminCtrl::class,'role']);
Route::post('/dashboard/role/act', [AdminCtrl::class,'role_act']);

Route::get('/dashboard/role/edit/{id}', [AdminCtrl::class,'role_edit']);
Route::post('/dashboard/role/update', [AdminCtrl::class,'role_update']);
Route::get('/dashboard/role/delete/{id}', [AdminCtrl::class,'role_delete']);

// profile ubah password
Route::get('/dashboard/pengaturan/data', [AdminCtrl::class,'pengaturan']);
Route::post('/dashboard/pengaturan/update', [AdminCtrl::class,'pengaturan_update']);


Route::get('/kapus/pengaturan/data', [KapusCtrl::class,'pengaturan']);
Route::post('/kapus/pengaturan/update', [KapusCtrl::class,'pengaturan_update']);


