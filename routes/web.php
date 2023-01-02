<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DeliveryAgentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');

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












Route::prefix('admin/categories')->group(function(){

    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::view('/create', 'admin.create-category')->name('admin.categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::post('/{category}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::post('/{category}/delete', [CategoryController::class, 'remove'])->name('admin.categories.delete');


});

Route::prefix('admin/foods')->group(function(){

Route::get('/', [FoodController::class, 'index'])->name('admin.foods');
Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('admin.foods.edit');
Route::get('/create', [FoodController::class, 'create'])->name('admin.foods.create');
Route::post('/store', [FoodController::class, 'store'])->name('admin.foods.store');
Route::post('/{food}/update', [FoodController::class, 'update'])->name('admin.foods.update');
Route::post('/{food}/delete', [FoodController::class, 'remove'])->name('admin.foods.delete');

});
Route::prefix('admin/sliders')->group(function(){

Route::get('/', [SliderController::class, 'index'])->name('admin.sliders');
Route::view('/create', 'admin.create-slider')->name('admin.sliders.create');
Route::post('/store', [SliderController::class, 'store'])->name('admin.sliders.store');
Route::post('/{slider}/delete', [SliderController::class, 'remove'])->name('admin.sliders.delete');

});
Route::prefix('admin/delivery-agents')->group(function(){

Route::get('/', [DeliveryAgentController::class, 'index'])->name('admin.delivery-agents');
Route::view('/create', 'admin.create-delivery-agent')->name('admin.delivery-agents.create');
Route::post('/store', [DeliveryAgentController::class, 'store'])->name('admin.delivery-agents.store');
Route::post('/{user}/delete', [DeliveryAgentController::class, 'remove'])->name('admin.delivery-agents.delete');

});

Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/{order}/view', [OrderController::class, 'show'])->name('admin.orders.view');
Route::post('/admin/{order}/update', [OrderController::class, 'update'])->name('admin.orders.update');



Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
Route::get('/admin/settings/show', [SettingController::class, 'show'])->name('admin.settings.show');
