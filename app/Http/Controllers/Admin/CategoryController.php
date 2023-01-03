<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::addSelect([
                'total_foods' => Food::whereColumn('category_id', 'categories.id')->selectRaw('count(foods.id)')
            ])
            ->paginate(2);

        return view('admin.categories', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30|unique:categories,name',
            'image' => 'required|image'
        ]);

        Category::create([
            'name' => $request->name,
            'image_url' => url('/storage') . '/' . $request->image->store('images/categories', 'public')
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully');
    }

    public function edit(Request $request, Category $category)
    {
        return view('admin.edit-category', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:2|max:30|unique:categories,name,' . $category->id,
            'image' => 'nullable|image'
        ]);

        $category->name = $request->name;

        if($request->image) {
            $category->image_url = url('/storage') . '/' . $request->image->store('images/categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function delete(Request $request, Category $category)
    {
        $image_url = str_replace(url('/storage'), '', $category->image_url);

        Storage::disk('public')->delete($image_url);

        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
