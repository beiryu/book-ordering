<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [FrontEndController::class, 'index']);

Auth::routes();

Route::get('/product/{product}', [FrontEndController::class, 'singleProduct'])->name('product.single');

Route::post('/cart/add', [ShoppingController::class, 'addToCart'])->name('cart.add');

Route::get('/cart', [ShoppingController::class, 'cart'])->name('cart');

Route::get('/cart/delete/{product}', [ShoppingController::class, 'cartDelete'])->name('cart.delete');

Route::get('/cart/incr/{product}/{qty}', [ShoppingController::class, 'incr'])->name('cart.incr');

Route::get('/cart/decr/{product}/{qty}', [ShoppingController::class, 'decr'])->name('cart.decr');

Route::get('/cart/rapid/add/{product}', [ShoppingController::class, 'rapidAdd'])->name('cart.rapid.add');

Route::resource('products', ProductController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
