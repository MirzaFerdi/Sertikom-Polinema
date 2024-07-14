<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriSuratController;
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

// Route::get('/', function () {return view('arsip.index');});

Route::get('/about', function () {return view('layouts.about');})->name('about');

Route::get('/', [ArsipController::class, 'index'])->name('arsip.index');
Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');
Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
Route::get('/arsip/search', [ArsipController::class, 'search'])->name('arsip.search');
Route::get('/arsip/show/{id}', [ArsipController::class, 'show'])->name('arsip.show');
Route::get('/arsip/download/{id}', [ArsipController::class, 'download'])->name('arsip.download');
Route::get('/arsip/edit/{id}', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::put('/arsip/update/{id}', [ArsipController::class, 'update'])->name('arsip.update');
Route::delete('/arsip/delete/{id}', [ArsipController::class, 'destroy'])->name('arsip.delete');

Route::get('/kategori', [KategoriSuratController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriSuratController::class, 'create'])->name('kategori.create');
Route::post('/kategori/store', [KategoriSuratController::class, 'store'])->name('kategori.store');
Route::get('/kategori/search', [KategoriSuratController::class, 'search'])->name('kategori.search');
Route::get('/kategori/edit/{id}', [KategoriSuratController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/update/{id}', [KategoriSuratController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/delete/{id}', [KategoriSuratController::class, 'destroy'])->name('kategori.delete');

