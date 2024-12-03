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
    return view('welcome');
});

Route::get('/barangs', [App\Http\Controllers\Api\BarangController::class, 'index']);
Route::get('/karyawans', [App\Http\Controllers\Api\KaryawanController::class, 'index']);
Route::get('/supliers', [App\Http\Controllers\Api\SupplierController::class, 'index']);
Route::get('/konsumens', [App\Http\Controllers\Api\KonsumenController::class, 'index']);
Route::get('/juals', [App\Http\Controllers\Api\JualController::class, 'index']);
Route::get('/pesans', [App\Http\Controllers\Api\PesanController::class, 'index']);