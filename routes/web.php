<?php

use App\Http\Controllers\StocksController;
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

Route::get('/stocks/{page?}', [StocksController::class, 'stocks']);
Route::get('/stock/{symbol}', [StocksController::class, 'stock']);
Route::get('/price/{symbol}/{from}/{to}', [StocksController::class, 'price']);
Route::get('/test', [StocksController::class, 'test']);


