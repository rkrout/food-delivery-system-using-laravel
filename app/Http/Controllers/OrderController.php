<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\Setting;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders =  $request->user()->orders()
            ->join('order_statuses', 'order_statuses.id', 'orders.order_status_id')
            ->select([
                'order_statuses.name as status',
                'orders.*',
            ])
            ->get();

        return view('orders', ['orders' => $orders]);
    }

    public function show(Request $request, Order $order)
    {
        return view('order_details', [
            'order' => $order,
            'details' => $order->details()->get(),
            'address' => $order->deliveryAdress()->first()
        ]);
    }

    public function store(Request $request)
    {
        $address = $request->validate([
            'name' => 'required|min:2|max:30',
            'mobile' => 'required|max:10',
            'street' => 'required|min:2|max:30',
            'instruction' => 'required|min:2|max:50',
        ]);

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $total_price = 0;

        for ($i = 0; $i < count($cart); $i++) { 
            
            $food = Food::where('id', $cart[$i]['id'])->first();

            $total_price += ($food->price * $cart[$i]['qty']);
        }

        $setting = Setting::first();

        $order = $request->user()->orders()->create([
            'total_price' => $total_price,
            'delivery_fee' => $setting->delivery_fee,
            'gst_percentage' => $setting->gst_percentage,
            'order_status_id' => 1,
        ]);

        $order->deliveryAdress()->create($address);

        for ($i = 0; $i < count($cart); $i++) { 

            $food = Food::where('id', $cart[$i]['id'])->first();

            $order->details()->create([
                'food' => $food->name,
                'qty' => $cart[$i]['qty'],
                'price' => $food->price
            ]);
        }

        $request->session()->put('cart', []);

        return redirect()->route('home')->with(['success' => 'Order placed successfully']);
    }
}
