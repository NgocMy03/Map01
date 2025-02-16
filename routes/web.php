<?php

use App\Http\Controllers\HomeController;
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
