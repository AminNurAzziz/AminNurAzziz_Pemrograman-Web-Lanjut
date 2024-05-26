<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, '__invoke'])->name('register');
Route::post('/login', [LoginController::class, '__invoke'])->name('login');
Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');

Route::get('/levels', [LevelController::class, 'index']);
Route::get('/levels/{id}', [LevelController::class, 'show']);
Route::post('/levels', [LevelController::class, 'store']);
Route::put('/levels/{id}', [LevelController::class, 'update']);
Route::delete('/levels/{id}', [LevelController::class, 'destroy']);


Route::apiResource('users', UserController::class);
Route::apiResource('kategori', KategoriController::class);
Route::apiResource('barang', BarangController::class);
