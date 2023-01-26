<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $foods = Food::join('categories', 'categories.id', 'foods.category_id')
            ->select([
                'categories.name as category',
                'foods.*'
            ])
            ->get();

        return response()->json($foods);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'name' => 'required|min:2|max:30|unique:foods,name',
            'price' => 'required|integer',
            'is_featured' => 'nullable|boolean',
            'is_vegan' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image'
        ]);

        $food = Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'is_featured' => $request->is_featured ? 1 : 0,
            'is_vegan' => $request->is_vegan ? 1 : 0,
            'category_id' => $request->category_id,
            'image_url' => url('/storage') . '/' . $request->image->store('images/foods', 'public')
        ]);

        return response()->json($food);
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required|min:2|max:30|unique:foods,name,' . $food->id,
            'price' => 'required|integer',
            'is_featured' => 'nullable|boolean',
            'is_vegan' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        $food->name = $request->name;
        $food->price = $request->price;
        $food->is_featured = $request->is_featured ? 1 : 0;
        $food->is_vegan = $request->is_vegan ? 1 : 0;
        $food->category_id = $request->category_id;

        if($request->image) {
            $food->image_url = url('/storage') . '/' . $request->image->store('images/foods', 'public');
        }

        $food->save();

        return response()->json($food);
    }

    public function delete(Request $request, Food $food)
    {
        $image_url = str_replace(url('/storage'), '', $food->image_url);

        Storage::disk('public')->delete($image_url);

        $food->delete();

        return response()->json($food);
    }
}
