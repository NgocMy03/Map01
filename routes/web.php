<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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
Route::get('/', [HomeController::class, 'home'])->name('Home');
Route::get('/map-real-life', [StoreController::class, 'MapRealLife'])->name('MapRealLife');
Route::get('/map-animation', [StoreController::class, 'MapAnimation'])->name('MapAnimation');

Route::get('product/index', [ProductController::class, 'indexProduct'])->name('product.index');
Route::get('product/create', [ProductController::class, 'createProduct'])->name('product.create');
Route::get('product/{id}/edit', [ProductController::class, 'editProduct'])->where(['id' => '[0-9]+'])->name('product.edit');
Route::get('product/{id}/delete', [ProductController::class, 'deleteProduct'])->where(['id' => '[0-9]+'])->name('product.delete');
Route::post('product/storeProduct', [ProductController::class, 'storeProduct'])->name('product.storeProduct');
Route::post('product/{id}/update', [ProductController::class, 'updateProduct'])->where(['id' => '[0-9]+'])->name('product.update');
Route::post('product/{id}/destroy', [ProductController::class, 'destroyProduct'])->where(['id' => '[0-9]+'])->name('product.destroy');
