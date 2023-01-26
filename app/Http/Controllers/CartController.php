<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->user()
            ->cart()
            ->join('foods', 'foods.id', 'cart.food_id')
            ->select(
                'cart.id',
                'foods.name',
                'foods.price',
                'foods.image_url',
                'cart.qty'
            )
            ->get();

        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'qty' => 'required|integer'
        ]);

        $cartItem = $request->user()->cart()->where('food_id', $request->food_id)->first();

        if($cartItem) {

            $cartItem->qty = $request->qty;

            $cartItem->save();

            return response()->json($cartItem);

        } else {

            $cartItem = $request->user()->cart()->create([
                'food_id' => $request->food_id,
                'qty' => $request->qty
            ]);

            return response()->json($cartItem);
        }
    }

    public function delete(Request $request, Cart $cart)
    {
        if($cart->user_id != $request->user()->id) {
            abort(403);
        }

        $cart->delete();

        return response()->json($cart);
    }

    public function pricing(Request $request)
    {
        $cart = $request->user()
            ->cart()
            ->join('foods', 'foods.id', 'cart.food_id')
            ->get();

        $foodPrice = 0;

        foreach ($cart as $cartItem) {
            
            $foodPrice += $cartItem->price * $cartItem->qty;
        }

        $setting = Setting::first();

        $gstAmount = round($foodPrice * ($setting->gst_percentage / 100));

        $totalAmount = $foodPrice + $gstAmount + $setting->deliveryFee;

        return response()->json([
            'food_price' => $foodPrice,
            'delivery_fee' => $setting->delivery_fee,
            'gst_percentage' => $setting->gst_percentage,
            'gst_amount' => $gstAmount,
            'total_amount' => $totalAmount
        ]);
    }
}
