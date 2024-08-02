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
use App\Http\Controllers\PasienCtrl;
use App\Http\Controllers\KapusCtrl;
use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\TesCtrl;






Route::get('/', [AdminCtrl::class,'index']);
// Route::get('/', [TesCtrl::class,'index']);


// Login
Route::get('/login', [LoginCtrl::class,'index']);
Route::post('/login/cek', [LoginCtrl::class,'cek_login']);

Route::get('/logout', [LoginCtrl::class,'logout']);





// daftar pasien
Route::get('/daftar/pasien', [AdminCtrl::class,'pasien']);
Route::post('/daftar/pasien/act', [AdminCtrl::class,'pasien_act']);

Route::get('/dashboard/pasien/data', [AdminCtrl::class,'pasien_data']);
Route::get('/dashboard/pasien/edit/{id}', [AdminCtrl::class,'pasien_edit']);
Route::post('/dashboard/pasien/update', [AdminCtrl::class,'pasien_update']);
Route::get('/dashboard/pasien/delete/{id}', [AdminCtrl::class,'pasien_delete']);


// data pegawai
Route::get('/dashboard/pegawai/data', [AdminCtrl::class,'pegawai']);
Route::get('/dashboard/pegawai/add', [AdminCtrl::class,'pegawai_add']);
Route::post('/dashboard/pegawai/act', [AdminCtrl::class,'pegawai_act']);

Route::get('/dashboard/pegawai/edit/{id}', [AdminCtrl::class,'pegawai_edit']);
Route::post('/dashboard/pegawai/update', [AdminCtrl::class,'pegawai_update']);
Route::get('/dashboard/pegawai/delete/{id}', [AdminCtrl::class,'pegawai_delete']);



// data dokter
Route::get('/dashboard/dokter/data', [AdminCtrl::class,'dokter']);
Route::get('/dashboard/dokter/add', [AdminCtrl::class,'dokter_add']);
Route::post('/dashboard/dokter/act', [AdminCtrl::class,'dokter_act']);

Route::get('/dashboard/dokter/edit/{id}', [AdminCtrl::class,'dokter_edit']);
Route::post('/dashboard/dokter/update', [AdminCtrl::class,'dokter_update']);
Route::get('/dashboard/dokter/delete/{id}', [AdminCtrl::class,'dokter_delete']);


// Data poli
Route::get('/dashboard/poli/data', [AdminCtrl::class,'poli']);
Route::post('/dashboard/poli/act', [AdminCtrl::class,'poli_act']);
Route::get('/dashboard/poli/edit/{id}', [AdminCtrl::class,'poli_edit']);
Route::post('/dashboard/poli/update', [AdminCtrl::class,'poli_update']);
Route::get('/dashboard/poli/delete/{id}', [AdminCtrl::class,'poli_delete']);


// data rekam medis
Route::get('/dashboard/rekam/data', [AdminCtrl::class,'rekam']);
Route::get('/dashboard/rekam/add', [AdminCtrl::class,'rekam_add']);
Route::post('/dashboard/rekam/act', [AdminCtrl::class,'rekam_act']);
Route::get('/dashboard/rekam/edit/{id}', [AdminCtrl::class,'rekam_edit']);
Route::post('/dashboard/rekam/update', [AdminCtrl::class,'rekam_update']);
Route::get('/dashboard/rekam/delete/{id}', [AdminCtrl::class,'rekam_delete']);


//data rujukan
Route::get('/dashboard/rujukan/data', [AdminCtrl::class,'rujukan']);
Route::get('/dashboard/cetak/rujukan', [AdminCtrl::class,'cetak_rujukan_data']);


// kunjungan pasien
Route::get('/dashboard/kunjungan/data', [AdminCtrl::class,'kunjungan']);
Route::get('/dashboard/cetak/kunjungan', [AdminCtrl::class,'cetak_kunjungan']);



// cetak rekam kwitansi
Route::get('/dashboard/rekam/kwitansi/{id}', [AdminCtrl::class,'cetak_kwitansi']);

// cetak surat rujuk
Route::get('/dashboard/rekam/surat/{id}', [AdminCtrl::class,'cetak_rujukan']);


// cek rujukan ajax
Route::post('/ajax/cek_rujuk', [AdminCtrl::class,'cek_rujuk']);


// bagian kapus
// cetak pasien
Route::get('/dashboard/kapus', [KapusCtrl::class,'index']);
Route::get('/kapus/pasien', [KapusCtrl::class,'pasien']);
Route::get('/kapus/cetak/pasien', [KapusCtrl::class,'cetak_pasien']);

// pegwai
Route::get('/kapus/pegawai', [KapusCtrl::class,'pegawai']);
Route::get('/kapus/cetak/pegawai', [KapusCtrl::class,'cetak_pegawai']);

// Dokter
Route::get('/kapus/dokter', [KapusCtrl::class,'dokter']);
Route::get('/kapus/cetak/dokter', [KapusCtrl::class,'cetak_dokter']);

// kunjungan pasien
Route::get('/kapus/kunjungan', [KapusCtrl::class,'kunjungan']);
Route::get('/kapus/cetak/kunjungan', [KapusCtrl::class,'cetak_kunjungan']);


// poli
Route::get('/kapus/poli', [KapusCtrl::class,'poli']);

// rujukan
Route::get('/kapus/rujukan', [KapusCtrl::class,'rujukan']);
Route::get('/kapus/cetak/rujukan', [KapusCtrl::class,'cetak_rujukan']);

// profile
Route::get('/dashboard/profile', [AdminCtrl::class,'profile']);
Route::get('/dashboard/pelayanan', [AdminCtrl::class,'pelayanan']);
Route::get('/dashboard/visi-misi', [AdminCtrl::class,'visimisi']);

Route::get('/dashboard/struktur', [AdminCtrl::class,'struktur']);
Route::get('/dashboard/galeri', [AdminCtrl::class,'galeri']);




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


