<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClusteringController;
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
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/kecamatan',[KecamatanController::class, 'index']);
    Route::get('/kecamatan/tambah', [KecamatanController::class, 'tambah']);
    Route::post('/kecamatan/tambah', [KecamatanController::class, 'tambahProses']);
    Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit']);
    Route::put('/kecamatan/update/{id}', [KecamatanController::class, 'editProses']);
    Route::get('/kecamatan/delete/{id}', [KecamatanController::class, 'hapus']);
    
    Route::get('/clustering',[ClusteringController::class, 'index']);
    Route::post('/clustering/tambah', [ClusteringController::class, 'kMeansClustering']);
    Route::post('/clustering/delete', [ClusteringController::class, 'hapus']);

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

    Route::get('/pemetaan',[ClusteringController::class, 'showMap']);
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('main.index');
});
