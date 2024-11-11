<?php

use App\Http\Controllers\Pokoje;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\PokojeController;
use App\Http\Controllers\MagazynController;
use App\Http\Controllers\PersonelController;

Route::get('/', [LoginController::class, 'selectUser'])->name('loginRoute');
Route::post('/', [LoginController::class, 'store'])->name('loginStore');

Route::get('/home', [HomeController::class, 'select'])->name('homeRoute');

Route::get('/pokoje', [PokojeController::class, 'select'])->name('pokojeRoute');
Route::post('/pokojePost', [PokojeController::class, 'store'])->name('pokojePost');
Route::post('/pokojePostDeactivate', [PokojeController::class, 'deactivate'])->name('pokojePostDeactivate');
Route::post('/pokojePostDelete', [PokojeController::class, 'delete'])->name('pokojePostDelete');

Route::get('/personel', [PersonelController::class, 'select'])->name('personelRoute');
Route::post('/personel', [PersonelController::class, 'update'])->name('personelPost');
Route::post('/personelDelete', [PersonelController::class, 'delete'])->name('personelPostDelete');


Route::get('/personel/{login}/{month}/{year}', [GrafikController::class, 'select'])->name('personelParameterRoute');
Route::post('/personel/{login}/{month}/{year}', [GrafikController::class, 'store'])->name('grafikStore');

Route::get('/magazyn', [MagazynController::class, 'select'])->name('magazynRoute');