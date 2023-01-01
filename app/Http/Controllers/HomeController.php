<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request  $request)
    {
        $food = Food::get();
        $sliders = Slider::get();

        return view('index', [
            'foods' => $food,
            'sliders' => $sliders
        ]);
    }
    public function search(Request  $request)
    {
        $foods = Food::where('name', 'like', '%' . $request->search . '%')->get();

        session()->flashInput($request->input());

        return view('search', [
            'foods' => $foods
        ]);
    }
    public function seed(Request  $request)
    {
        $setting = new Setting;

        $setting->delivery_fee = 50;
        $setting->gst_percentage = 10;

        $setting->save();
        DB::table('order_statuses')->insert(['name' => 'Placed']);
        DB::table('order_statuses')->insert(['name' => 'Pending']);
        DB::table('order_statuses')->insert(['name' => 'Prepared']);
        DB::table('order_statuses')->insert(['name' => 'Delivered']);

        $setting->delivery_fee = 50;
        $setting->gst_percentage = 10;

        $setting->save();

        return 'f';
    }
}
