<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('product/index', [ProductController::class, 'indexProduct'])->name('product.index');
Route::get('product/create', [ProductController::class, 'createProduct'])->name('product.create');
Route::get('product/{id}/edit', [ProductController::class, 'editProduct'])->where(['id' => '[0-9]+'])->name('product.edit');
Route::post('product/storeProduct', [ProductController::class, 'storeProduct'])->name('product.storeProduct');
Route::post('product/{id}/update', [ProductController::class, 'updateProduct'])->where(['id' => '[0-9]+'])->name('product.update');
Route::delete('product/{id}/delete', [ProductController::class, 'deleteProduct'])->name('product.delete');

Route::get('schedule/index', [ScheduleController::class, 'indexSchedule'])->name('schedule.index');
Route::get('schedule/create', [ScheduleController::class, 'createSchedule'])->name('schedule.create');
Route::get('schedule/{id}/edit', [ScheduleController::class, 'editSchedule'])->where(['id' => '[0-9]+'])->name('schedule.edit');
Route::post('schedule/store', [ScheduleController::class, 'storeSchedule'])->name('schedule.storeSchedule');
Route::post('schedule/{id}/update', [ScheduleController::class, 'updateSchedule'])->where(['id' => '[0-9]+'])->name('schedule.update');
Route::delete('schedule/{id}/delete', [ScheduleController::class, 'deleteSchedule'])->name('schedule.delete');

Route::post('/rate-store', [RateController::class, 'store'])->name('rate.store');

 Route::get('discount/index', [DiscountController::class, 'indexDiscount'])->name('discount.index');
 Route::get('discount/create', [DiscountController::class, 'createDiscount'])->name('discount.create');
 Route::get('discount/{id}/edit', [DiscountController::class, 'editDiscount'])->where(['id' => '[0-9]+'])->name('discount.edit');
 Route::post('discount/store', [DiscountController::class, 'storeDiscount'])->name('discount.storeDiscount');
 Route::post('discount/{id}/update', [DiscountController::class, 'updateDiscount'])->where(['id' => '[0-9]+'])->name('discount.update');
 Route::delete('discount/{id}/delete', [DiscountController::class, 'deleteDiscount'])->name('discount.delete');
