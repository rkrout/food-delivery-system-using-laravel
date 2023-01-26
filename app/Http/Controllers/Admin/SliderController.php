<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Slider::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $slider = Slider::create([
            'image_url' => url('/uploads') . '/' . $request->image->store('images/sliders', 'public')
        ]);

        return response()->json($slider);
    }

    public function delete(Request $request, Slider $slider)
    {
        $slider->delete();

        return response()->json($slider);
    }
}
