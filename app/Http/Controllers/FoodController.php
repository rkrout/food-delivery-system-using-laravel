<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index(Request  $request)
    {
        return response()->json(Food::all());
    }
}
