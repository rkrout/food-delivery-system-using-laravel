<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.sliders', ['sliders' => Slider::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        Slider::create([
            'image_url' => url('/storage') . '/' . $request->image->store('images/sliders', 'public')
        ]);

        return redirect()->route('admin.sliders');
    }
    public function remove(Request $request, Slider $slider)
    {
        $slider->delete();
        return back();
    }
}
