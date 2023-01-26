<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedFood;
use App\Models\OrderStatus;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::join('payment_details', 'payment_details.order_id', 'orders.id')
            ->select([
                'orders.id',
                'orders.status',
                'orders.created_at',
                'orders.updated_at',
            ])
            ->selectRaw('ROUND(food_price + delivery_fee + (food_price * (gst_percentage / 100))) AS total_amount')
            ->addSelect([
                'total_items' => OrderedFood::whereColumn('order_id', 'orders.id')->selectRaw('count(*)')
            ])
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, Order $order)
    {
        return response()->json([
            'order' => $order,
            'foods' => $order->foods()->get(),
            'deliveryAddress' => $order->deliveryAddress()->first()
       ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'delivery_agent_id' => 'required|exists:users,id',
            'status' => 'required',
        ]);

        if(!User::where('is_delivery_agent', true)->where('id', $request->delivery_agent_id)->exists()){
            abort(403);
        }

        $order->delivery_agent_id = $request->delivery_agent_id;
        $order->status = $request->status;

        $order->save();

        return response()->json($order);
    }
}
