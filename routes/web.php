<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [PagesController::class, 'index']);

Route::resource('/product', ProductsController::class);

Route::post('/add_to_cart', [ProductsController::class, 'addToCart']);

Route::post('/orderplace', [ProductsController::class, 'orderPlace']);

Route::get('/cartlist', [ProductsController::class, 'cartList']);

Route::delete('/removecart/{id}', [ProductsController::class, 'removeCart']);

Route::get('/ordernow', [ProductsController::class, 'orderNow']);

Route::get('/orderhistory', [ProductsController::class, 'orderHistory']);

Route::get('/profile', [UsersController::class, 'show']);

Route::get('/profile/edit/{id}', [UsersController::class, 'edit']);

Route::post('/profile/update/{id}', [UsersController::class, 'update']);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [ProductsController::class, 'search']);