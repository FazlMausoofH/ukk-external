<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index']);
Route::post('login/user', [AuthController::class, 'login'])->name('login');

Route::middleware(['web', 'CheckLogin'])->group(function () {
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('menu/create', [MenuController::class, 'create'])->name('create-menu');
    Route::put('menu/edit/{id}', [MenuController::class, 'edit'])->name('edit-menu');
    Route::delete('menu/delete/{id}', [MenuController::class, 'delete'])->name('delete-menu');

    Route::get('pemesanan', [PemesananController::class, 'index']);
    Route::post('pemesanan/create', [PemesananController::class, 'create'])->name('create-pemesanan');
    
    Route::get('pembayaran', [PembayaranController::class, 'index']);;
    Route::put('pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('update-pembayaran');
    Route::delete('pembayaran/delete/{id}', [PembayaranController::class, 'delete'])->name('delete-pembayaran');
    
    Route::get('laporan', [laporanController::class, 'index']);;
    Route::delete('laporan/delete/{id}', [laporanController::class, 'delete'])->name('delete-laporan');
    
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});    

