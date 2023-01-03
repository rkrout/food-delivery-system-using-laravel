<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Setting;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $foods = [];

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $total_price = 0;

        for ($i = 0; $i < count($cart); $i++) { 
            
            $food = Food::where('id', $cart[$i]['id'])->first();

            $food->qty = $cart[$i]['qty'];

            $total_price += ($food->price * $cart[$i]['qty']);

            array_push($foods, $food);
        }

        $setting = Setting::first();

        return view('cart', ['foods' => $foods, 'pricing' => [
            'total_price' => $total_price,
            'delivery_fee' => $setting->delivery_fee,
            'gst_percentage' => $setting->gst_percentage,
            'gst' => $total_price * ($setting->gst_percentage / 100),
            'total_payable' => $setting->delivery_fee + $total_price + ($total_price * ($setting->gst_percentage / 100))
        ]]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:foods,id'
        ]);

        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $found  = false;

        for ($i = 0; $i < count($cart); $i++) { 

            if($cart[$i]['id'] == $request->id) {

                $cart[$i]['qty'] = $request->qty;

                $found = true;
            }
        }

        if($found){

            $request->session()->put('cart', $cart);

            return response()->json(['message' => 'Food updated']);
        }

        array_push($cart, ['id' => $request->id, 'qty' => $request->qty]);

        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Food added to cart'], 201);
    }

    public function delete(Request $request)
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

        return response()->json(['message' => 'Food deleted from cart']);
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $total_price = 0;

        for ($i = 0; $i < count($cart); $i++) { 

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
}
