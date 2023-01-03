@extends('base')

@section('content')
    <h2 class="text-2xl font-bold text-orange-600 mt-8 mb-5 max-w-3xl mx-4 md:mx-auto">My Orders</h2>

    @foreach ($orders as $order)
        <div class="border-2 shadow-ld max-w-3xl my-4 mx-4 md:mx-auto border-gray-300 flex flex-col gap-2 p-5 rounded-md">
            <p>
                <span class="font-semibold text-gray-700">Tracking ID : </span>
                {{ $order->id }}
            </p>

            <p>
                <span class="font-semibold text-gray-700">Delivery Fee : </span>
                Rs. {{ $order->delivery_fee }}
            </p>

            <p>
                <span class="font-semibold text-gray-700">Gst : </span>
                {{ $order->gst_percentage }}
            </p>

            <p>
                <span class="font-semibold text-gray-700">Amount Paid : </span>
                Rs. {{ $order->total_price }}
            </p>

            <p>
                <span class="font-semibold text-gray-700">Status : </span>
                <span class="text-green-600">{{ $order->status }}</span>
            </p>

            <p>
                <a  class="text-orange-600 underline" href="{{ route('orders.show', ['order' => $order->id ]) }}">View Details</a>
            </p>
        </div>
    @endforeach
@endsection

