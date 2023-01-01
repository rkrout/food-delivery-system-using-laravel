<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Setting;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:foods,id'
        ]);

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $found  = false;

        for ($i=0; $i < count($cart); $i++) { 
            if($cart[$i]['id'] == $request->id) {
                $cart[$i]['qty'] = $request->qty;
                $found = true;
            }
        }

        if($found){
            $request->session()->put('cart', $cart);
            return response()->json(['message' => 'added'], 200);
        }

        array_push($cart, ['id' => $request->id, 'qty' => $request->qty]);
        $request->session()->put('cart', $cart);
        return response()->json(['message' => 'added'], 201);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:foods,id'
        ]);

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $new_cart  = [];

        for ($i=0; $i < count($cart); $i++) { 
            if($cart[$i]['id'] != $request->id) {
                array_push($new_cart, $cart[$i]);
            }
        }

        $request->session()->put('cart', $new_cart);

        return response()->json(['message' => 'deleted']);
    }

    public function index(Request $request)
    {
        $foods = [];

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        for ($i=0; $i < count($cart); $i++) { 
            $food = Food::where('id', $cart[$i]['id'])->first();
            $food->qty = $cart[$i]['qty'];
            array_push($foods, $food);
        }

        // dd($foods);

        return view('cart', ['foods' => $foods]);
    }
    public function details(Request $request)
    {
        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $total_price = 0;

        for ($i=0; $i < count($cart); $i++) { 
            $food = Food::where('id', $cart[$i]['id'])->first();
            $total_price += ($food->price * $cart[$i]['qty']);
        }

        $setting = Setting::first();

        return view('checkout', [
            'total_price' => $total_price,
            'delivery_fee' => $setting->delivery_fee,
            'gst_percentage' => $setting->gst_percentage,
            'gst' => $total_price * ($setting->gst_percentage / 100),
            'total_payable' => $setting->delivery_fee + $total_price + ($total_price * ($setting->gst_percentage / 100)),
        ]);
    }
    public function place(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2|max:30',
            'mobile' => 'required|max:10',
            'street' => 'required|min:2|max:30',
            'instruction' => 'required|min:2|max:50',
        ]);

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $total_price = 0;

        for ($i=0; $i < count($cart); $i++) { 
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

        $order->deliveryAdress()->create($data);

        for ($i=0; $i < count($cart); $i++) { 
            $food = Food::where('id', $cart[$i]['id'])->first();

            $order->details()->create([
                'food' => $food->name,
                'qty' => $cart[$i]['qty'],
                'price' => $food->price
            ]);
        }

        $request->session()->put('cart', []);

        return redirect()->route('home');
    }
    public function show(Request $request)
    {
        // dd(Order::all());
        // dd(OrderDetails::all());
        return view('orders', ['orders' => $request->user()->orders()
            ->join('order_statuses', 'order_statuses.id', 'orders.order_status_id')
            ->select([
                'order_statuses.name as status',
                'orders.*',
            ])
            ->get()]);
    }
    public function orderdetails(Request $request, Order $order)
    {
        // dd(Order::all());
        // dd(OrderDetails::all());
        return view('order_details', [
            'order' => $order,
            'details' => $order->details()->get(),
            'address' => $order->deliveryAdress()->first()
        ]);
    }
}
