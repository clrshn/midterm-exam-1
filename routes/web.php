<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

// Redirect root to products index
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Product CRUD
Route::resource('products', ProductController::class);

// Sale CRUD - only the methods we need for saving and listing
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
Route::get('sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
Route::get('sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::put('sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
Route::delete('sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
