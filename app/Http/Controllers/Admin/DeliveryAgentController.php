<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeliveryAgentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.delivery-agent', [
            'delivery_agents' => User::where('is_delivery_agent', true)
                ->select([
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.created_at',
                    'users.updated_at',
                    DB::raw('(select count(orders.id) from orders where orders.delivery_agent_id = users.id) as total_delivery'),
                ])
                ->paginate(2)
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $user->is_delivery_agent = true;

        $user->save();

        return redirect()->route('admin.delivery-agents');
    }
    public function remove(Request $request, User $user)
    {
        $user->is_delivery_agent = false;

        $user->save();

        return back();
    }
}
