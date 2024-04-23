<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoutaController;
use App\Http\Controllers\SatuanController;
use Illuminate\Support\Facades\Route;

// login 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// satuan 
Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::post('/satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
Route::put('/satuan/update/{id}', [SatuanController::class, 'update'])->name('satuan.update');
Route::delete('/satuan/destroy/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
// aktif atau tidak satuan 
Route::put('/satuan/{id}/enable', [SatuanController::class, 'enable'])->name('satuan.enable');
Route::put('/satuan/{id}/disable', [SatuanController::class, 'disable'])->name('satuan.disable');


// kouta 
Route::get('/koutas', [KoutaController::class, 'index'])->name('kouta.index');

Route::get('/koutas/create', [KoutaController::class, 'create'])->name('kouta.create');
Route::post('/koutas', [KoutaController::class, 'store'])->name('kouta.store');


Route::put('/koutas/{id}', [KoutaController::class, 'update'])->name('kouta.update');

Route::delete('/koutas/{id}', [KoutaController::class, 'destroy'])->name('kouta.destroy');
// aktif atau tidak kouta 
Route::put('/kouta/{id}/disable', [KoutaController::class, 'disable'])->name('kouta.disable');
Route::put('/kouta/{id}/enable', [KoutaController::class, 'enable'])->name('kouta.enable');



