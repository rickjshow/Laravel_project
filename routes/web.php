<?php

use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [productController::class, 'index'])->name('product.index');
Route::get('/product/create', [productController::class, 'create'])->name('product.create');
Route::get('/product/byid', [productController::class], 'byid')->name('product.byid');
Route::post('/product/store', [productController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [productController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [productController::class, 'update'])->name('product.update');
Route::delete('product/{id}', [productController::class, 'delete'])->name('product.delete');
