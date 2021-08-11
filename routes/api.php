<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('register/check', [App\Http\Controllers\Auth\RegisterController::class, 'check'])->name('api-register-check');
Route::get('provinces', [App\Http\Controllers\API\LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [App\Http\Controllers\API\LocationController::class, 'regencies'])->name('api-regencies');
// Route::get('districts/{regencies_id}', [App\Http\Controllers\Auth\LocationController::class, 'districts'])->name('api-districts');
// Route::GET('/city/{province_id}', [App\Http\Controllers\API\LocationController::class, 'City'])->name('api-city');
Route::get('/regencies_id/{regencies_id}', [App\Http\Controllers\API\LocationController::class, 'regencies_id'])->name('api-regencies_id');
Route::post('/rajaongkir/checkOngkir', [App\Http\Controllers\API\LocationController::class, 'checkOngkir'])->name('api-checkOngkir');