<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentDetails;
use App\Models\Slider;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_foods' => Food::count(),
            'total_categories' => Category::count(),
            'total_sliders' => Slider::count(),
            'total_orders' => Order::count(),
            'total_placed_orders' => Order::where('status', 'Placed')->count(),
            'total_preparing_orders' => Order::where('status', 'Preparing')->count(),
            'total_customers' => User::count(),
            'total_delivered_orders' => Order::where('status', 'Delivered')->count(),
            'total_prepared_orders' => Order::where('status', 'Prepared')->count(),
            'total_earned' => PaymentDetails::sum(DB::raw('ROUND(food_price + delivery_fee + (food_price * (gst_percentage / 100)))'))
       ]);
    }
}
