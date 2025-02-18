<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\PdfController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\PenjualanController;



Route::get('/', function () {return view('welcome');});
Route::get('/dashboard',[\App\Http\Controllers\AuthController::class,'dashboard']);
Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate-pdf');
Route::get('/pdf/laporanpenjualan', [PdfController::class, 'generateLaporanPenjualanPdf'])->name('generate-laporan-penjualan');
Route::post('/update-status/{id}', [PenjualanController::class, 'updateStatus'])->name('updateStatus');


Route::resource('/pelanggans', \App\Http\Controllers\PelangganController::class);
Route::resource('/penjualans', \App\Http\Controllers\PenjualanController::class);
Route::resource('/detailpenjualans', \App\Http\Controllers\DetailpenjualanController::class);
Route::resource('/produks', \App\Http\Controllers\ProdukController::class);

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class,'login'])->name('login');
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');Route::post('logout', [AuthController::class, 'logout'])->name('logout');