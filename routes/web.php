<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DeliveryAgentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::prefix('cart')->group(function(){

    Route::get('/', [CartController::class, 'index'])->name('cart');

    Route::post('/', [CartController::class, 'create'])->name('cart.create');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/delete', [CartController::class, 'delete'])->name('cart.delete');
});

Route::prefix('auth')->group(function(){

    Route::middleware('guest')->group(function(){

        Route::view('sign-up', 'auth.sign-up')->name('auth.sign-up-view');

        Route::post('sign-up', [AuthController::class, 'signUp'])->name('auth.sign-up');

        Route::view('login', 'auth.login')->name('auth.login-view'); 

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

    Route::prefix('orders')->group(function(){

        Route::get('/', [OrderController::class, 'index'])->name('orders');

        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');

        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});


/* Admin Area */

Route::prefix('admin')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::prefix('admin/sliders')->group(function(){

        Route::get('/', [SliderController::class, 'index'])->name('admin.sliders');

        Route::view('/create', 'admin.create-slider')->name('admin.sliders.create');

        Route::post('/store', [SliderController::class, 'store'])->name('admin.sliders.store');

        Route::post('/{slider}/delete', [SliderController::class, 'delete'])->name('admin.sliders.delete');
    });

    Route::prefix('categories')->group(function(){

        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');

        Route::view('/create', 'admin.create-category')->name('admin.categories.create');

        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');

        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        Route::post('/{category}/update', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::post('/{category}/delete', [CategoryController::class, 'delete'])->name('admin.categories.delete'); 
    });

    Route::prefix('foods')->group(function(){

        Route::get('/', [FoodController::class, 'index'])->name('admin.foods');

        Route::get('/create', [FoodController::class, 'create'])->name('admin.foods.create');

        Route::post('/store', [FoodController::class, 'store'])->name('admin.foods.store');

        Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('admin.foods.edit');

        Route::post('/{food}/update', [FoodController::class, 'update'])->name('admin.foods.update');

        Route::post('/{food}/delete', [FoodController::class, 'delete'])->name('admin.foods.delete');
    });

    Route::prefix('delivery-agents')->group(function(){

        Route::get('/', [DeliveryAgentController::class, 'index'])->name('admin.delivery-agents');

        Route::view('/create', 'admin.create-delivery-agent')->name('admin.delivery-agents.create');

        Route::post('/store', [DeliveryAgentController::class, 'store'])->name('admin.delivery-agents.store');
        
        Route::post('/{user}/delete', [DeliveryAgentController::class, 'delete'])->name('admin.delivery-agents.delete');
    }); 
    
    Route::prefix('orders')->group(function(){

        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders');

        Route::get('/{order}/show', [AdminOrderController::class, 'show'])->name('admin.orders.show');

        Route::post('{order}/update', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    });

    Route::prefix('settings')->group(function(){

        Route::get('/', [SettingController::class, 'index'])->name('admin.settings');

        Route::get('/edit', [SettingController::class, 'edit'])->name('admin.settings.edit');

        Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');
    });
});






