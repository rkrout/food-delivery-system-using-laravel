<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Slider::all());
    }
}
