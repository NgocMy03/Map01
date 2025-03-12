<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('product/index', [ProductController::class, 'indexProduct'])->name('product.index');
Route::get('product/create', [ProductController::class, 'createProduct'])->name('product.create');
Route::get('product/{id}/edit', [ProductController::class, 'editProduct'])->where(['id' => '[0-9]+'])->name('product.edit');
Route::get('product/{id}/delete', [ProductController::class, 'deleteProduct'])->where(['id' => '[0-9]+'])->name('product.delete');
Route::post('product/storeProduct', [ProductController::class, 'storeProduct'])->name('product.storeProduct');
Route::post('product/{id}/update', [ProductController::class, 'updateProduct'])->where(['id' => '[0-9]+'])->name('product.update');
Route::post('product/{id}/destroy', [ProductController::class, 'destroyProduct'])->where(['id' => '[0-9]+'])->name('product.destroy');

<<<<<<< HEAD
Route::get('schedule/index', [ScheduleController::class, 'indexSchedule'])->name('schedule.index');
Route::get('schedule/create', [ScheduleController::class, 'createSchedule'])->name('schedule.create');
Route::get('schedule/{id}/edit', [ScheduleController::class, 'editSchedule'])->where(['id' => '[0-9]+'])->name('schedule.edit');
Route::get('schedule/{id}/delete', [ScheduleController::class, 'deleteSchedule'])->where(['id' => '[0-9]+'])->name('schedule.delete');
Route::post('schedule/store', [ScheduleController::class, 'storeSchedule'])->name('schedule.storeSchedule');
Route::post('schedule/{id}/update', [ScheduleController::class, 'updateSchedule'])->where(['id' => '[0-9]+'])->name('schedule.update');
Route::post('schedule/{id}/destroy', [ScheduleController::class, 'destroySchedule'])->where(['id' => '[0-9]+'])->name('schedule.destroy');
=======
Route::post('/rate-store', [RateController::class, 'store'])->name('rate.store');
>>>>>>> e086e18dc674a8c999a166eb149b33ad61c12985
