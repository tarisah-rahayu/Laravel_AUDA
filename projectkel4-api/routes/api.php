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

Route::apiResource('/konsumens', Api\KonsumenController::class);
Route::apiResource('/barangs', Api\BarangController::class);
Route::apiResource('/suppliers', Api\SupplierController::class);
Route::apiResource('/belis', Api\BeliController::class);
Route::apiResource('/admins', Api\AdminController::class);
Route::apiResource('/pesans', Api\PesanController::class);