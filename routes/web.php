<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', [App\Http\Controllers\indexcontroller::class, 'index'])->name('index');

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

Route::get('/', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/where', [App\Http\Controllers\WhereController::class, 'index'])->name('where');

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'index'])->name('product');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::post('/addCategory', [App\Http\Controllers\AdminController::class, 'addCategory'])->name('addCategory');

Route::delete('/dellCategory', [App\Http\Controllers\AdminController::class, 'dellCategory'])->name('dellCategory');

Route::post('/addProduct', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('addProduct');

Route::get('/editProductView/{id}', [App\Http\Controllers\EditProductViewController::class, 'editProductView'])->name('editProductView');

Route::post('/editProduct/{id_product}', [App\Http\Controllers\EditProductViewController::class, 'editProduct'])->name('editProduct');

Route::delete('/dellProduct', [App\Http\Controllers\AdminController::class, 'dellProduct'])->name('dellProduct');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id_product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id_product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id_product}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])
    ->name('checkout')
    ->middleware('auth');

Route::post('/checkout/confirm', [App\Http\Controllers\CheckoutController::class, 'confirm'])
    ->name('checkout.confirm')
    ->middleware('auth');

Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');