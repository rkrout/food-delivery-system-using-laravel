<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::prefix('auth')->group(function(){

    Route::middleware('guest')->group(function(){

        Route::view('sign-up', 'auth.sign-up')->name('auth.sign-up-view');

        Route::view('login', 'auth.login')->name('auth.login-view'); 

        Route::post('sign-up', [AuthController::class, 'signUp'])->name('auth.sign-up');

        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    });

    Route::middleware('auth')->group(function(){

        Route::view('change-password', 'auth.change-password')->name('auth.change-password-view');

        Route::view('edit-account', 'auth.edit-account')->name('auth.edit-account-view'); 

        Route::post('change-password', [AuthController::class, 'changePassword'])->name('auth.change-password');

        Route::post('edit-account', [AuthController::class, 'editAccount'])->name('auth.edit-account');
        
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::middleware('auth')->group(function(){

    Route::get('/checkout', [CartController::class, 'details'])->name('checkout');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/seed', [HomeController::class, 'seed']);
Route::post('/orders/place', [CartController::class, 'place'])->name('orders.place');
Route::get('/orders/show', [CartController::class, 'show'])->name('orders.show');
Route::get('/orders/show/{order}', [CartController::class, 'orderdetails'])->name('orders.orderdetails');
