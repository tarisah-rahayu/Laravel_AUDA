<?php

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

Route::get('/barangs', [App\Http\Controllers\Api\BarangController::class,'index']);
Route::get('/juals', [App\Http\Controllers\Api\JualController::class,'index']);
Route::get('/karyawans', [App\Http\Controllers\Api\KaryawanController::class,'index']);
Route::get('/konsumens', [App\Http\Controllers\Api\KonsumenController::class,'index']);
Route::get('/pesans', [App\Http\Controllers\Api\PesanController::class,'index']);
Route::get('/supliers', [App\Http\Controllers\Api\SupplierController::class,'index']);


Route::apiResource('/barangs', Api\BarangController::class);
Route::apiResource('/konsumens', Api\KonsumenController::class);
Route::apiResource('/karyawans', Api\KaryawanController::class);
Route::apiResource('/supliers', Api\SupplierController::class);
Route::apiResource('/juals', Api\JualController::class);
Route::apiResource('/pesans', Api\PesanController::class);

