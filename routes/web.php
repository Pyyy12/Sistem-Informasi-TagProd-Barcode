<?php

use App\Http\Controllers\ProductionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grouping Route untuk Produksi
Route::controller(ProductionController::class)->group(function () {
    // Menampilkan semua list data produksi
    Route::get('/productions', 'index')->name('productions.index');
    
    // Form untuk tambah data produksi baru
    Route::get('/productions/create', 'create')->name('productions.create');
    
    // Proses simpan data
    Route::post('/productions', 'store')->name('productions.store');
    
    // Proses generate dan download PDF Barcode
    Route::get('/productions/{id}/pdf', 'downloadTag')->name('productions.pdf');
});