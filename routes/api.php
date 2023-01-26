<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeliveryAgentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/foods', [FoodController::class, 'index']);

Route::get('/sliders', [SliderController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware('auth:api')->group(function(){

    Route::prefix('cart')->group(function(){

        Route::get('/', [CartController::class, 'index']);
    
        Route::post('/', [CartController::class, 'store']);
    
        Route::get('/pricing', [CartController::class, 'pricing']);
    
        Route::delete('/{cart}', [CartController::class, 'delete']);
    });
});

Route::prefix('auth')->group(function(){

    Route::middleware('guest')->group(function(){

        Route::post('register', [AuthController::class, 'register']);

        Route::post('login', [AuthController::class, 'login']);
    });

    Route::get('/', [AuthController::class, 'index']);

    Route::middleware('auth:api')->group(function(){


        Route::patch('change-password', [AuthController::class, 'changePassword']);

        Route::patch('edit-account', [AuthController::class, 'editAccount']);
        
        Route::delete('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:api')->group(function(){

    Route::prefix('orders')->group(function(){

        Route::get('/', [OrderController::class, 'index']);

        Route::post('/', [OrderController::class, 'store']);

        Route::get('/{order}', [OrderController::class, 'show']);
    });
});

/* Admin Routes */

Route::prefix('admin')->middleware(['auth:api', 'admin'])->group(function(){

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/customers', [CustomerController::class, 'index']);

    Route::prefix('sliders')->group(function(){

        Route::get('/', [AdminSliderController::class, 'index'])->name('admin.sliders');

        Route::post('/', [AdminSliderController::class, 'store']);

        Route::delete('/{slider}', [AdminSliderController::class, 'delete']);
    });

    Route::prefix('categories')->group(function(){

        Route::get('/', [AdminCategoryController::class, 'index']);

        Route::post('/', [AdminCategoryController::class, 'store']);

        Route::get('/{category}', [AdminCategoryController::class, 'show']);

        Route::patch('/{category}', [AdminCategoryController::class, 'update']);

        Route::delete('/{category}', [AdminCategoryController::class, 'delete']); 
    });

    Route::prefix('foods')->group(function(){

        Route::get('/', [AdminFoodController::class, 'index']);

        Route::post('/', [AdminFoodController::class, 'store']);

        Route::patch('/{food}', [AdminFoodController::class, 'update']);

        Route::delete('/{food}', [AdminFoodController::class, 'delete']);
    });

    Route::prefix('delivery-agents')->group(function(){

        Route::get('/', [DeliveryAgentController::class, 'index']);

        Route::post('/', [DeliveryAgentController::class, 'store']);
        
        Route::delete('/{user}', [DeliveryAgentController::class, 'delete']);
    }); 
    
    Route::prefix('orders')->group(function(){

        Route::get('/', [AdminOrderController::class, 'index']);

        Route::get('/{order}', [AdminOrderController::class, 'show']);

        Route::patch('{order}', [AdminOrderController::class, 'update']);
    });

    Route::prefix('settings')->group(function(){

        Route::get('/', [SettingController::class, 'index']);

        Route::patch('/', [SettingController::class, 'update']);
    });
});


