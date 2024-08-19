<?php

use App\Http\Controllers\DatapemilihController;
use App\Http\Controllers\TampungDataBaruController;
use App\Http\Controllers\TampungDataTmsController;
use App\Http\Controllers\TampungDataUbahController;
use App\Models\datapemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('baru', [TampungDataBaruController::class, 'index'])->name('apiBaru');

// Route::get('pemilih', [DatapemilihController::class, 'index']);

// Route::middleware('auth:api')->group(function () {
    Route::get('baru', [TampungDataBaruController::class, 'index'])->name('apiBaru');
    Route::get('ubah', [TampungDataUbahController::class, 'index'])->name('apiUbah');
    Route::get('tms', [TampungDataTmsController::class, 'index'])->name('apiTms');
// });
