<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\Slider;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_foods' => Food::count(),
            'total_categories' => Category::count(),
            'total_sliders' => Slider::count(),
            'total_orders' => Order::count(),
            'total_placed_orders' => Order::where('status', 'Placed')->count(),
            'total_delivered_orders' => Order::where('status', 'Delivered')->count(),
            'total_prepared_orders' => Order::where('status', 'Prepared')->count(),
            'total_earned' => Order::sum(DB::raw('total_price + delivery_fee + (total_price * (gst_percentage / 100))'))
       ]);
    }
}
