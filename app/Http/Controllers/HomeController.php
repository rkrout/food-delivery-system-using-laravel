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
        return view('index', [
            'foods' => Food::all(),
            'sliders' => Slider::all()
        ]);
    }

    public function search(Request  $request)
    {
        $foods = Food::where('name', 'like', '%' . $request->search . '%')->get();

        $categories = Food::where('name', 'like', '%' . $request->search . '%')->get();

        session()->flashInput($request->input());

        return view('search', ['foods' => $foods]);
    }
}
