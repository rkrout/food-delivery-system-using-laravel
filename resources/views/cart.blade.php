@extends('base')

@section('content')
<h2 class="text-2xl font-bold text-orange-600 mt-8 max-w-5xl px-2 md:mx-auto">My Cart</h2>

<div class="max-w-5xl mx-auto my-8 grid grid-cols-12 gap-4 lg:gap-8 px-2">
<div class="col-span-12 md:col-span-7 lg:col-span-8 space-y-4">

    @foreach ($foods as $food)
    <div class="food flex gap-4  rounded-md p-3 border-2 border-gray-300 bg-white">
        <img src="{{ $food->image_url }}" alt="" class="h-24 w-24 rounded-md object-cover">

        <div class="flex-1">
            <p class="food-id hidden">{{ $food->id }}</p>

            <p class="food-name font-semibold">{{ $food->name }}</p>

            <p class="food-price food-price text-lg text-orange-600 font-bold my-2">Rs. {{ $food->price }}</p>

            <div class="flex justify-between">
                <div class="qty flex border-2 rounded-md border-gray-300 h-8">   
                    <button class="qty-minus bg-gray-200 w-9 h-full flex justify-center items-center text-gray-600">
                        <span class="material-symbols-outlined">remove</span>
                    </button>
    
                    <p class="qty-count w-8 h-full flex justify-center items-center border-x-2 border-gray-300">1</p>
    
                    <button class="qty-plus bg-gray-200 w-8 h-full flex justify-center items-center text-gray-600">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                </div>
                
                <button class="btn-remove-cart bg-orange-600 rounded-md px-3 py-1 h-min text-white hover:bg-orange-800
                disabled:bg-orange-400 transition-all duration-300 disabled:cursor-not-allowed">Remove</button>
            </div>
        </div>
    </div>
@endforeach
</div>

<div class="col-span-12 md:col-span-5 lg:col-span-4">
    <div class="border-2 border-gray-300 rounded-md">
        <h2 class="text-orange-600 text-lg font-bold px-4 py-3 border-b-2 border-gray-300">Pricing Details</h2>
        <div class="p-4 space-y-3">
            <div class="flex justify-between items-center">
                <p>Total Price</p>
                <p id="totalPrice">Rs. {{ $pricing['total_price'] }}</p>
            </div>
            <div class="flex justify-between items-center">
                <p>Delivery Fee</p>
                <p id="deliveryFee">Rs. {{ $pricing['delivery_fee'] }}</p>
            </div>
            <div class="flex justify-between items-center">
                <p>Gst <span id="gstPercentage">{{ $pricing['gst_percentage'] }}%</span></p>
                <p id="gst">Rs. {{ $pricing['gst'] }}</p>
            </div>
            <div class="flex justify-between items-center border-t-2 border-gray-300 pt-2">
                <p>Total Payable</p>
                <p id="totalPayable">Rs. {{ $pricing['total_payable'] }}</p>
            </div>
        </div>
        <div class="px-4 py-3 border-t-2 border-gray-300">
            <a href="{{ route('cart.checkout') }}" class="w-full block text-center px-4 py-2 bg-orange-600 rounded-md text-white hover:bg-orange-800
        disabled:bg-orange-400 disabled:cursor-not-allowed transition-all duration-300">Checkout</a>
        </div>
    </div>
</div>

</div>
<script>

    document.querySelectorAll('.food').forEach(foodEl => {

        foodEl.querySelector('.qty-minus').onclick = async event => {
            // access required elements
            const idEl = foodEl.querySelector('.food-id')
            const priceEl = foodEl.querySelector('.food-price')
            const qtyEl = foodEl.querySelector('.qty-count')
            const totalPriceEl = document.querySelector('#totalPrice')
            const gstPercentageEl = document.querySelector('#gstPercentage')
            const gstEl = document.querySelector('#gst')
            const deliveryFeeEl = document.querySelector('#deliveryFee')
            const totalPayableEl = document.querySelector('#totalPayable')

            // retrive required data
            let id = Number(idEl.innerHTML)
            let price = Number(priceEl.innerHTML)
            let qty = Number(qtyEl.innerHTML)
            let totalPrice = Number(totalPriceEl.innerHTML)
            let gst = Number(gstEl.innerHTML)
            let gstPercentage = Number(gstPercentageEl.innerHTML)
            let deliveryFee = Number(deliveryFeeEl.innerHTML)

            // perform validation on data
            if(qty == 1) return

            // make api call
            await fetch('{{ route('cart.create') }}', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id,
                    qty: qty - 1
                })
            })

            // update data 
            qty = qty - 1
            totalPrice = totalPrice - price 
            gst = Math.round(totalPrice * (gstPercentage / 100))
            totalPayable = totalPrice + gst + deliveryFee

            // update view with new data
            totalPriceEl.innerHTML = totalPrice
            gstEl.innerHTML = gst 
            qtyEl.innerHTML = qty
            totalPayableEl.innerHTML= totalPayable
        }  

        foodEl.querySelector('.qty-plus').onclick = async event => {

            // access required elements
            const idEl = foodEl.querySelector('.food-id')
            const priceEl = foodEl.querySelector('.food-price')
            const qtyEl = foodEl.querySelector('.qty-count')
            const totalPriceEl = document.querySelector('#totalPrice')
            const gstPercentageEl = document.querySelector('#gstPercentage')
            const gstEl = document.querySelector('#gst')
            const deliveryFeeEl = document.querySelector('#deliveryFee')
            const totalPayableEl = document.querySelector('#totalPayable')

            // retrive required data
            let id = Number(idEl.innerHTML)
            let price = Number(priceEl.innerHTML)
            let qty = Number(qtyEl.innerHTML)
            let totalPrice = Number(totalPriceEl.innerHTML)
            let gst = Number(gstEl.innerHTML)
            let gstPercentage = Number(gstPercentageEl.innerHTML)
            let deliveryFee = Number(deliveryFeeEl.innerHTML)

            // make api call
            await fetch('{{ route('cart.create') }}', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id,
                    qty: qty + 1
                })
            })

            // update data 
            qty = qty + 1
            totalPrice = totalPrice + price 
            gst = Math.round(totalPrice * (gstPercentage / 100))
            totalPayable = totalPrice + gst + deliveryFee

            // update view with new data
            totalPriceEl.innerHTML = totalPrice
            gstEl.innerHTML = gst 
            qtyEl.innerHTML = qty
            totalPayableEl.innerHTML= totalPayable
        } 

        foodEl.querySelector('.btn-remove-cart').onclick = async event => {

            // access required elements
            const idEl = foodEl.querySelector('.food-id')
            const priceEl = foodEl.querySelector('.food-price')
            const qtyEl = foodEl.querySelector('.qty-count')
            const totalPriceEl = document.querySelector('#totalPrice')
            const gstPercentageEl = document.querySelector('#gstPercentage')
            const gstEl = document.querySelector('#gst')
            const deliveryFeeEl = document.querySelector('#deliveryFee')
            const totalPayableEl = document.querySelector('#totalPayable')

            // retrive required data
            let id = Number(idEl.innerHTML)
            let price = Number(priceEl.innerHTML)
            let qty = Number(qtyEl.innerHTML)
            let totalPrice = Number(totalPriceEl.innerHTML)
            let gst = Number(gstEl.innerHTML)
            let gstPercentage = Number(gstPercentageEl.innerHTML)
            let deliveryFee = Number(deliveryFeeEl.innerHTML)

            // make api call
            await fetch('{{ route('cart.delete') }}', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id
                })
            })

            // update data 
            totalPrice = totalPrice - (qty * price) 
            gst = Math.round(totalPrice * (gstPercentage / 100))
            totalPayable = totalPrice + gst + deliveryFee

            // update view with new data
            foodEl.remove()
            totalPriceEl.innerHTML = totalPrice
            gstEl.innerHTML = gst 
            totalPayableEl.innerHTML= totalPayable
        }  
    })

</script>


@endsection