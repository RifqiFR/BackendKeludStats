<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\InfografiController;
use App\Http\Controllers\SubindikatorController;
use App\Http\Controllers\IndikatorSatuanController;
use App\Http\Controllers\NilaiPerTahunController;
use App\Http\Controllers\YearController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['prefix' => 'subindikator'], function () {
    Route::get('indikator/{indikator}', [SubindikatorController::class, 'index']);
    Route::post('/', [SubindikatorController::class, 'store']);
    Route::put('{subindikator}', [SubindikatorController::class, 'update']);
    Route::delete('{subindikator}', [SubindikatorController::class, 'destroy']);
});

Route::apiResource('indikator', IndikatorController::class);
Route::apiResource('infografi', InfografiController::class);

Route::group(['prefix' => 'indikatorsatuan'], function () {
    Route::get('/', [IndikatorSatuanController::class, 'index']);
    Route::post('/', [IndikatorSatuanController::class, 'store']);
    Route::put('{indikatorsatuan}', [IndikatorSatuanController::class, 'update']);
    Route::delete('{subindikator}', [IndikatorSatuanController::class, 'destroy']);
});

Route::group(['prefix' => 'nilaipertahun'], function () {
    // Route::get('/', [NilaiPerTahunController::class, 'index']);
    Route::post('/', [NilaiPerTahunController::class, 'store']);
    Route::put('{tahun}/{indikatorSatuanId}', [NilaiPerTahunController::class, 'update']);
    Route::delete('{tahun}/{indikatorSatuanId}', [NilaiPerTahunController::class, 'destroy']);
});

Route::group(["prefix" => "years"], function() {
    Route::get("/", [YearController::class, "index"]);
    Route::post("/", [YearController::class, "store"]);
    Route::delete("/{tahun}", [YearController::class, "destroy"]);
});
