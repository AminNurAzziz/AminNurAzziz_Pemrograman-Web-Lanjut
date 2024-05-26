<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Capsule\Manager;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);

// Group routes under '/kategori' prefix
Route::prefix('kategori')->middleware('auth')->group(function () {
    // Define resourceful routes for categories
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('/{id}/edit', [KategoriController::class, 'updateForm'])->name('kategori.edit');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
});

// Route::get('/user', [UserController::class, 'index']);

// Route::get('/user/tambah', [UserController::class, 'tambah']);

// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::delete('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::resource('m_user', POSController::class);

Route::get('/', [WelcomeController::class, 'index'])->middleware('auth');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index'); //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list'])->name('user.list'); //ambil data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create'])->name('user.create'); //menampilkan halaman form tambah
    Route::post('/', [UserController::class, 'store'])->name('user.store'); //menyimpan data user
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show'); //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); //menampilkan halaman form edit
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update'); //mengupdate data user
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy'); //menghapus data user
    Route::get('/export', [UserController::class, 'export'])->name('user.excel'); //export data user ke excel
});


Route::resource('barang', BarangController::class)->middleware('auth');

Route::resource('stok', StokController::class)->middleware('auth');

Route::resource('penjualan', PenjualanController::class)->middleware('auth');

Route::resource('penjualan_detail', PenjualanDetailController::class)->middleware('auth');

Route::resource('level', LevelController::class)->middleware('auth');

// Login
// Route::get('login', [AuthController::class, 'login'])->name('login');
// Route::post('login', [AuthController::class, 'authenticate']);
// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register', [AuthController::class, 'store']);
// Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'ceklogin:1'], function () {
        Route::get('admin', [WelcomeController::class, 'index']);
    });

    Route::group(['middleware' => 'ceklogin:2'], function () {
        Route::get('manager', [ManagerController::class, 'index']);
    });
});
