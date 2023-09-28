<?php

use App\Http\Controllers\CartController;
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


//
//Route::get('/cart', 'CartController@viewCart')->name('view.cart');
//Route::get('/cart/add/{productId}', 'CartController@addToCart')->name('add.to.cart');
Route::get('/', [CartController::class,'viewCart'])->name('view.store');
Route::get('/cart/add/{productId}', [CartController::class,'addToCart'])->name('add.to.cart');
Route::get('/invoice', [CartController::class,'generateInvoice'])->name('generate.invoice');
