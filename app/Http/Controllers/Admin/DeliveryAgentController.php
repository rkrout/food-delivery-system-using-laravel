<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class DeliveryAgentController extends Controller
{
    public function index(Request $request)
    {
        $delivery_agents = User::where('is_delivery_agent', true)
            ->select([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ])
            ->addSelect([
                'total_delivery' => Order::whereColumn('delivery_agent_id', 'users.id')->selectRaw('count(orders.id)')
            ])
            ->get();

        return response()->json($delivery_agents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $user->is_delivery_agent = true;

        $user->save();

        return response()->json($user);
    }

    public function delete(Request $request, User $user)
    {
        $user->is_delivery_agent = false;

        $user->save();

        return response()->json($user);
    }
}
