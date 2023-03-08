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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

  
Route::middleware(['auth', 'user-access:petugas'])->group(function () {
    Route::get('/petugas-index', [App\Http\Controllers\Petugas\PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/data-pembayaran', [App\Http\Controllers\Petugas\PembayaranController::class, 'index'])->name('petugas.index.pembayaran');
    Route::post('/petugas/data-pembayaran/store', [App\Http\Controllers\Petugas\PembayaranController::class, 'store'])->name('petugas.store.pembayaran');
    Route::get('pembayaran/getdata/{nisn}/{berapa}', [App\Http\Controllers\Petugas\PembayaranController::class, 'getData'])->name('petugas.getData.pembayaran');
    Route::get('/history-pembayaran', [App\Http\Controllers\LogController::class, 'index'])->name('petugas.history.pembayaran');
    Route::get('laporan/excel/petugas' , [App\Http\Controllers\LogController::class , 'excel'])->name('petugas.excel.pembayaran');


});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin-index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

    //Siswa
    Route::get('data-siswa' , [App\Http\Controllers\Admin\SiswaController::class , 'index'])->name('admin.index.siswa');
    Route::get('data-siswa/create' , [App\Http\Controllers\Admin\SiswaController::class , 'create'])->name('admin.create.siswa');
    Route::post('data-siswa/store' , [App\Http\Controllers\Admin\SiswaController::class , 'store'])->name('admin.store.siswa');
    Route::get('data-siswa/edit/{nisn}' , [App\Http\Controllers\Admin\SiswaController::class , 'edit'])->name('admin.edit.siswa');
    Route::put('data-siswa/update/{nisn}' , [App\Http\Controllers\Admin\SiswaController::class , 'update'])->name('admin.update.siswa');
    Route::delete('data-siswa/destroy/{nisn}' , [App\Http\Controllers\Admin\SiswaController::class , 'destroy'])->name('admin.destroy.siswa');
 
    // Route::get('data-siswa' , [App\Http\Controllers\Admin\SiswaController::class , 'index'])->name('admin.index.siswa');

    //Kelas
    Route::get('data-kelas' , [App\Http\Controllers\Admin\KelasController::class , 'index'])->name('admin.index.kelas');
    Route::get('data-kelas/create' , [App\Http\Controllers\Admin\KelasController::class , 'create'])->name('admin.create.kelas');
    Route::post('data-kelas/store' , [App\Http\Controllers\Admin\KelasController::class , 'store'])->name('admin.store.kelas');
    Route::get('data-kelas/edit/{nisn}' , [App\Http\Controllers\Admin\KelasController::class , 'edit'])->name('admin.edit.kelas');
    Route::put('data-kelas/update/{nisn}' , [App\Http\Controllers\Admin\KelasController::class , 'update'])->name('admin.update.kelas');
    Route::delete('data-kelas/destroy/{nisn}' , [App\Http\Controllers\Admin\KelasController::class , 'destroy'])->name('admin.destroy.kelas');

    //Spp
    Route::get('data-spp' , [App\Http\Controllers\Admin\SppController::class , 'index'])->name('admin.index.spp');
    Route::get('data-spp/create' , [App\Http\Controllers\Admin\SppController::class , 'create'])->name('admin.create.spp');
    Route::post('data-spp/store' , [App\Http\Controllers\Admin\SppController::class , 'store'])->name('admin.store.spp');
    Route::get('data-spp/edit/{id}' , [App\Http\Controllers\Admin\SppController::class , 'edit'])->name('admin.edit.spp');
    Route::put('data-spp/update/{id}' , [App\Http\Controllers\Admin\SppController::class , 'update'])->name('admin.update.spp');
    // Route::delete('data-spp/destroy/{id}' , [App\Http\Controllers\Admin\SppController::class , 'destroy'])->name('admin.destroy.spp');
    Route::delete('data-spp/destroy/{id}' , [App\Http\Controllers\Admin\SppController::class , 'destroy'])->name('admin.destroys.spp');


    //Petugas
    Route::get('data-petugas' , [App\Http\Controllers\Admin\PetugasController::class , 'index'])->name('admin.index.petugas');
    Route::get('data-petugas/create' , [App\Http\Controllers\Admin\PetugasController::class , 'create'])->name('admin.create.petugas');
    Route::post('data-petugas/store' , [App\Http\Controllers\Admin\PetugasController::class , 'store'])->name('admin.store.petugas');
    Route::get('data-petugas/edit/{id}' , [App\Http\Controllers\Admin\PetugasController::class , 'edit'])->name('admin.edit.petugas');
    Route::put('data-petugas/update/{id}' , [App\Http\Controllers\Admin\PetugasController::class , 'update'])->name('admin.update.petugas');
    Route::delete('data-petugas/destroy/{id}' , [App\Http\Controllers\Admin\PetugasController::class , 'destroy'])->name('admin.destroy.petugas');

    //Pembayaran
    Route::get('data-pembayaran' , [App\Http\Controllers\Admin\PembayaranController::class , 'index'])->name('admin.index.pembayaran');
    Route::get('data-pembayaran/create' , [App\Http\Controllers\Admin\PembayaranController::class , 'create'])->name('admin.create.pembayaran');
    Route::post('data-pembayaran/store' , [App\Http\Controllers\Admin\PembayaranController::class , 'store'])->name('admin.store.pembayaran');
    Route::get('data-pembayaran/edit/{id}' , [App\Http\Controllers\Admin\PembayaranController::class , 'edit'])->name('admin.edit.pembayaran');
    Route::put('data-pembayaran/update/{id}' , [App\Http\Controllers\Admin\PembayaranController::class , 'update'])->name('admin.update.pembayaran');
    Route::delete('data-pembayaran/destroy/{id}' , [App\Http\Controllers\Admin\PembayaranController::class , 'destroy'])->name('admin.destroy.pembayaran');
    Route::get('data-pembayaran/get-data/{nisn}/{berapa}' , [App\Http\Controllers\Admin\PembayaranController::class , 'getData'])->name('admin.getData.pembayaran');

    //History
    Route::get('history' , [App\Http\Controllers\HistoryController::class , 'index'])->name('admin.index.history');
    Route::get('laporan/excel' , [App\Http\Controllers\HistoryController::class , 'excel'])->name('admin.excel.history');


});
  
  
Route::middleware(['auth', 'user-access:siswa'])->group(function () {
    Route::get('/siswa-index', [App\Http\Controllers\Siswa\SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa-log', [App\Http\Controllers\Siswa\SiswaController::class, 'log'])->name('siswa.index.log');

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
