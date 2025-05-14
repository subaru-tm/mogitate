<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'products']);
Route::post('/products', [ProductController::class, 'products']);
Route::get('/products/search', [productController::class, 'search']);

Route::get('/products/register', [ProductController::class, 'register']);
Route::post('/products/register', [ProductController::class, 'store']);
Route::get('/products/{productid}',[ProductController::class, 'detail']);
Route::patch('/products/{productid}/update',[ProductController::class, 'update']);
Route::delete('/products/{productid}/delete', [ProductController::class, 'destroy']);