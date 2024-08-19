<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\DataBaruController;
use App\Http\Controllers\DatapemilihController;
use App\Http\Controllers\TampungDataBaruController;
use App\Http\Controllers\TampungDataUbahController;
use \App\Http\Controllers\LihatDataController;
use App\Http\Controllers\TampungDataTmsController;
use App\Models\datapemilih;
use App\Models\TampungDataUbah;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
})
    ->name('wellcome');

Route::get('tes', function () {
    return view('ubahData');
});

Route::post('insertData', [DatapemilihController::class, 'store']);
Route::get('lihatData', [LihatDataController::class, 'index']);

Route::post('cekdata', [DatapemilihController::class, 'cekdata']);
Route::get('databaru', [TampungDataBaruController::class, 'index']);
Route::post('databaru', [TampungDataBaruController::class, 'store'])->name('postDataBaru');

Route::get('ubahdata/{dataPemilih}/{nik}/{nama}', [TampungDataUbahController::class, 'show'])->name('ubahData');
Route::post('ubahdata', [TampungDataUbahController::class, 'store'])->name('postDataUbah');

Route::get('tmsdata/{dataPemilih}/{nik}/{nama}', [TampungDataTmsController::class, 'show'])->name('tmsData');
Route::post('tmsdata', [TampungDataTmsController::class, 'store'])->name('postDataTms');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('admin/periksaDataBaru/{tampungDataBaru}', [AdminPageController::class, 'periksaDataBaru'])->name('admin.periksaDataBaru');
    Route::get('admin/dataBaru', [AdminPageController::class, 'dataBaru'])->name('admin.dataBaru');
    Route::post('admin/hapusDataBaru/{tampungDataBaru}', [AdminPageController::class, 'hapusDataBaru'])->name('admin.hapusDataBaru');
    Route::post('admin/terimaDataBaru/{tampungDataBaru}', [AdminPageController::class, 'terimaDataBaru'])->name('admin.terimaDataBaru');

    Route::get('admin/periksaDataUbah/{tampungDataUbah}', [AdminPageController::class, 'periksaDataUbah'])->name('admin.periksaDataUbah');
    Route::get('admin/dataUbah', [AdminPageController::class, 'dataUbah'])->name('admin.dataUbah');
    Route::post('admin/hapusDataUbah/{tampungDataUbah}', [AdminPageController::class, 'hapusDataUbah'])->name('admin.hapusDataUbah');
    Route::post('admin/terimaDataUbah/{tampungDataUbah}', [AdminPageController::class, 'terimaDataUbah'])->name('admin.terimaDataUbah');

    Route::get('admin/periksaDataTms/{tampungDataTms}', [AdminPageController::class, 'periksaDataTms'])->name('admin.periksaDataTms');
    Route::get('admin/dataTms', [AdminPageController::class, 'dataTms'])->name('admin.dataTms');
    Route::post('admin/hapusDataTms/{tampungDataTms}', [AdminPageController::class, 'hapusDataTms'])->name('admin.hapusDataTms');
    Route::post('admin/terimaDataTms/{tampungDataTms}', [AdminPageController::class, 'terimaDataTms'])->name('admin.terimaDataTms');

    Route::get('admin/manajemen', [AdminPageController::class, 'manajemenData'])->name('admin.manajemen');

    Route::post('admin/hapusSemua', [AdminPageController::class, 'hapusData'])->name('admin.hapusData');
    Route::post('admin/import', [AdminPageController::class, 'importData'])->name('admin.importData');
    Route::get('admin/export', [AdminPageController::class, 'exportData'])->name('admin.exportData');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
