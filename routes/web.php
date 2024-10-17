<?php

use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Manga resource routes
Route::prefix('manga')->group(function () {
    Route::get('/', [MangaController::class, 'index'])->name('manga.index');
    Route::get('/create', [MangaController::class, 'create'])->name('manga.create');
    Route::post('/store', [MangaController::class, 'store'])->name('manga.store');
    Route::get('/{manga}', [MangaController::class, 'show'])->name('manga.show');
    Route::get('/edit/{manga}', [MangaController::class, 'edit'])->name('manga.edit');
    Route::patch('/update/{manga}', [MangaController::class, 'update'])->name('manga.update');
    Route::delete('/destroy/{manga}', [MangaController::class, 'destroy'])->name('manga.destroy');
});
Route::get('/kelola-akun', [KelolaAkunController::class, 'index'])->name('kelola.akun.index');
Route::prefix('/kelola-akun')->name('kelola.akun.')->group(function(){
    Route::get('/kelola-akun/create', [KelolaAkunController::class, 'create'])->name('kelola.akun.create');
    Route::post('/store', [KelolaAkunController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [KelolaAkunController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [KelolaAkunController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [KelolaAkunController::class, 'destroy'])->name('delete');
    Route::get('/create', [KelolaAkunController::class, 'create'])->name('create');
});

