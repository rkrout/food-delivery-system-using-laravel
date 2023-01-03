<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderStatus;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::join('order_statuses', 'order_statuses.id', 'orders.order_status_id')
            ->select([
                'orders.*',
                'order_statuses.name as status'
            ])
            ->selectRaw('(total_price + delivery_fee + (total_price * (gst_percentage / 100))) as total_amount')
            ->addSelect([
                'total_items' => OrderDetails::whereColumn('order_id', 'orders.id')->selectRaw('count(order_details.id)')
            ])
            ->paginate(2);

        return view('admin.orders', ['orders' => $orders]);
    }

    public function show(Request $request, Order $order)
    {
        return view('admin.order-details', [
            'order' => $order,
            'details' => $order->details()->get(),
            'address' => $order->deliveryAdress()->first(),
            'delivery_agents' => User::where('is_delivery_agent', true)->get(),
            'statuses' => OrderStatus::all(),
       ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'delivery_agent_id' => 'required|exists:users,id',
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        if(!User::where('is_delivery_agent', true)->where('id', $request->delivery_agent_id)->exists()){
            return back()->withValidationError([
                'delivery_agent_id' => 'Invalid delivery agent'
            ]);
        }

        $order->delivery_agent_id = $request->delivery_agent_id;
        $order->order_status_id = $request->order_status_id;

        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully');
    }
}
