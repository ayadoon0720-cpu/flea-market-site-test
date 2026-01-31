<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'index']);

Route::get('/products/register', [ProductController::class, 'create']);
Route::post('/products/register', [ProductController::class, 'store']);

Route::get('/products/{productId}', [ProductController::class, 'show']);
Route::get('/products/{productId}/update', [ProductController::class, 'edit']);
Route::post('/products/{productId}/update', [ProductController::class, 'update']);
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);

Route::post('/products', [ProductController::class, 'store']);