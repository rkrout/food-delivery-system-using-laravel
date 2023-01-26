<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\Setting;
use App\Models\DeliveryAddress;
use App\Models\OrderedFood;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders =  $request->user()
            ->orders()
            ->join('payment_details', 'payment_details.order_id', 'orders.id')
            ->select([
                'orders.id',
                'orders.status',
                'orders.created_at',
                'orders.updated_at',
            ])
            ->selectRaw('ROUND(food_price + delivery_fee + (food_price * gst_percentage / 100)) AS total_amount')
            ->addSelect([
                'total_foods' => OrderedFood::whereColumn('order_id', 'orders.id')->selectRaw('count(*)')
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

    public function store(Request $request)
    {
        $deliveryAddress = $request->validate([
            'name' => 'required|min:2|max:30',
            'mobile' => 'required|max:10',
            'street' => 'required|min:2|max:30',
            'instruction' => 'required|min:2|max:50'
        ]);

        if(!$request->user()->cart()->exists()) {
            abort(403);
        }

        $cart = $request->user()
            ->cart()
            ->join('foods', 'foods.id', 'cart.food_id')
            ->get();

        $foodPrice = 0;

        foreach ($cart as $cartItem) {
            
            $foodPrice += $cartItem->price * $cartItem->qty;
        }

        $setting = Setting::first();

        $order = $request->user()->orders()->create(['status' => 'Placed']);

        $order->deliveryAddress()->create($deliveryAddress);

        foreach ($cart as $cartItem) {

            $order->foods()->create([
                'name' => $cartItem->name,
                'qty' => $cartItem->qty,
                'price' => $cartItem->price
            ]);
        }

        $order->paymentDetails()->create([
            'food_price' => $foodPrice,
            'gst_percentage' => $setting->gst_percentage,
            'delivery_fee' => $setting->delivery_fee
        ]);

        $request->user()->cart()->delete();

        return response()->json($order);
    }
}
