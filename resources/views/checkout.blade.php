@extends('base')


@section('content')
    <div class="grid grid-cols-12 gap-8 max-w-5xl mx-auto my-8 px-2">
        <div class="col-span-12 md:col-span-7 lg:col-span-8">
            <form class="border-2 border-gray-300 rounded-md" action="{{ route('orders.store') }}" method="post" id="form">
                <h2 class="text-orange-600 font-bold text-lg px-4 py-3 border-b-2 border-gray-300">Delivery Address</h2>
                @csrf
            
                <div class="p-4">
                    <div class="mb-5">
                        <label for="name" class="font-semibold inline-block mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600">
                        @error('name')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-5">
                        <label for="mobile" class="font-semibold inline-block mb-1">Mobile</label>
                        <input type="number" name="mobile" value="{{ old('mobile') }}" class="border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600">
                        @error('mobile')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-5">
                        <label for="street" class="font-semibold inline-block mb-1">street</label>
                        <input type="text" name="street" value="{{ old('street') }}" class="border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600">
                        @error('street')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-5">
                        <label for="instruction" class="font-semibold inline-block mb-1">instruction</label>
                        <input type="text" name="instruction" value="{{ old('instruction') }}" class="border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600">
                        @error('instruction')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="" id="" class="h-4 w-4">
                        <label for="instruction" class="font-semibold inline-block mb-1">Save for next time</label>
                        @error('instruction')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                
                    {{-- <button type="submit" class="w-full px-4 py-2 bg-orange-600 rounded-md text-white hover:bg-orange-800
                    disabled:bg-orange-400 disabled:cursor-not-allowed transition-all duration-300">place</button> --}}
                </div>
            </form>
        </div>
        <div class="col-span-12 md:col-span-5 lg:col-span-4">
            <div class="border-2 border-gray-300 rounded-md">
                <h2 class="text-orange-600 text-lg font-bold px-4 py-3 border-b-2 border-gray-300">Pricing Details</h2>
                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <p>Total Price</p>
                        <p id="totalPrice">Rs. {{ $total_price }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Delivery Fee</p>
                        <p id="deliveryFee">Rs. {{ $delivery_fee }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Gst <span id="gstPercentage">{{ $gst_percentage }}%</span></p>
                        <p id="gst">Rs. {{ $gst }}</p>
                    </div>
                    <div class="flex justify-between items-center border-t-2 border-gray-300 pt-2">
                        <p>Total Payable</p>
                        <p id="totalPayable">Rs. {{ $total_payable }}</p>
                    </div>
                </div>
                <div class="px-4 py-3 border-t-2 border-gray-300">
                    <a href="{{ route('cart.checkout') }}" class="w-full block text-center px-4 py-2 bg-orange-600 rounded-md text-white hover:bg-orange-800
                disabled:bg-orange-400 disabled:cursor-not-allowed transition-all duration-300">Place Order</a>
                </div>
            </div>
        </div>
    </div>

@endsection