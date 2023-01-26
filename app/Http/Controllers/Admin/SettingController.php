<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Setting::first());
    }

    public function update(Request $request)
    {
        $request->validate([
            'delivery_fee' => 'required|integer',
            'gst_percentage' => 'required|integer',
        ]);

        $setting = Setting::first();

        $setting->delivery_fee = $request->delivery_fee;
        $setting->gst_percentage = $request->gst_percentage;

        $setting->save();

        return response()->json($setting);
    }
}
