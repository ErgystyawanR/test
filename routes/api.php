<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CariController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/users', [AuthController::class, 'index']); 
    Route::get('/users/{id}', [AuthController::class, 'show']);
    Route::put('/users/{id}', [AuthController::class, 'update']); 
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);

    Route::get('/cari-nama', [CariController::class, 'cariNama']);
    Route::get('/cari-nim', [CariController::class, 'cariNim']);
    Route::get('/cari-ymd', [CariController::class, 'cariYmd']);
});

