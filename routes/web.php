<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Homepage::class);

Route::get('/product/{key}', \App\Http\Controllers\Product::class)->name('product');
Route::get('/category/{key}', \App\Http\Controllers\Category::class)->name('category');

Route::get('/checkout', \App\Http\Controllers\Checkout::class)->name('checkout');
Route::get('/checkout/success', \App\Http\Controllers\Success::class)->name('success');
