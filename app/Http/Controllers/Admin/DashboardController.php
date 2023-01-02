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
        return view('admin.index', [
            'total_foods' => Food::count(),
            'total_categories' => Category::count(),
            'total_sliders' => Slider::count(),
            'total_orders' => Order::count(),
            'total_pending_orders' => Order::where('order_status_id', 2)->count(),
            'total_delivered_orders' => Order::where('order_status_id', 3)->count(),
            'total_prepared_orders' => Order::where('order_status_id', 1)->count(),
            'total_earned' => Order::sum(DB::raw('total_price + delivery_fee + (total_price * (gst_percentage / 100))'))
       ]);
    }
}
