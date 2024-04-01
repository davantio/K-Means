<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/produksi',[ProduksiController::class, 'index']);
    Route::get('/produksi/tambah', [ProduksiController::class, 'tambah']);
    Route::post('/produksi/tambah', [ProduksiController::class, 'tambahProses']);
    Route::get('/produksi/edit/{id}', [ProduksiController::class, 'edit']);
    Route::put('/produksi/update/{id}', [ProduksiController::class, 'editProses']);
    Route::get('/produksi/delete/{id}', [ProduksiController::class, 'hapus']);

    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/tambah', [AdminController::class, 'tambah']);
    Route::post('/admin/tambah', [AdminController::class, 'tambahProses']);
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::put('/admin/edit/{id}', [AdminController::class, 'editProses']);
    Route::get('/admin/delete/{id}', [AdminController::class, 'hapus']);

    Route::get('/pemetaan', function () {
        return view('error');
    });
    Route::get('/clustering', function () {
        return view('error');
    });
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);


// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/produksi',[ProduksiController::class, 'index']);
// Route::get('/produksi/tambah', [ProduksiController::class, 'tambah']);
// Route::post('/produksi/tambah', [ProduksiController::class, 'tambahProses']);
// Route::get('/produksi/edit/{id}', [ProduksiController::class, 'edit']);
// Route::put('/produksi/update/{id}', [ProduksiController::class, 'editProses']);
// Route::get('/produksi/delete/{id}', [ProduksiController::class, 'hapus']);

// Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/admin/tambah', [AdminController::class, 'tambah']);
// Route::post('/admin/tambah', [AdminController::class, 'tambahProses']);
// Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
// Route::put('/admin/edit/{id}', [AdminController::class, 'editProses']);
// Route::get('/admin/delete/{id}', [AdminController::class, 'hapus']);
