<?php

use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\KelurahanController;
use App\Http\Controllers\Api\PemilihController;
use App\Http\Controllers\Api\TpsController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('update_profil', [UserController::class, 'update']);
Route::post('change_password', [UserController::class, 'changePassword']);

Route::post('pemilihs', [PemilihController::class, 'index']);
Route::post('store_pemilih', [PemilihController::class, 'store']);
Route::post('update_pemilih', [PemilihController::class, 'update']);
Route::post('destory_pemilih', [PemilihController::class, 'destroy']);

Route::post('kecamatans', [KecamatanController::class, 'index']);
Route::post('kelurahans', [KelurahanController::class, 'index']);
Route::post('kabupatens', [KabupatenController::class, 'index']);
Route::post('tpss', [TpsController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
