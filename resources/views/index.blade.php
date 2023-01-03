@extends('base')
@section('content')
    
@foreach ($sliders as $slider)
<div class="max-w-5xl mx-auto">
    <img src="{{ $slider->image_url }}" alt="">
</div>
@endforeach

<div class="grid grid-cols-3 gap-4 max-w-5xl mx-auto">
@foreach ($foods as $food)
<div class="food shadow border rounded-md p-2">
    <p class="food-id hidden">{{ $food->id }}</p>

    <img src="{{ $food->image_url }}" class="rounded-md object-cover">

    <p class="food-name mt-2 font-semibold">{{ $food->name }}</p>

    <p class="food-price text-lg text-orange-600 font-bold my-2">Rs {{ $food->price }}</p>

    <div class="flex justify-between">
        <div class="qty flex border-2 rounded-md border-gray-300 h-9">
            <button class="qty-minus bg-gray-200 w-9 h-full flex justify-center items-center text-gray-600">
                <span class="material-symbols-outlined">remove</span>
            </button>

            <p class="qty-count w-9 h-full flex justify-center items-center border-x-2 border-gray-300">1</p>

            <button class="qty-plus bg-gray-200 w-9 h-full flex justify-center items-center text-gray-600">
                <span class="material-symbols-outlined">add</span>
            </button>
        </div>
    
        <button class="add_to_cart bg-orange-600 rounded-md px-3 py-1 h-min text-white hover:bg-orange-800
        disabled:bg-orange-400 transition-all duration-300 disabled:cursor-not-allowed">Add To Cart</button>
    </div>
</div>
@endforeach
</div>


<script>
document.querySelectorAll('.food').forEach(foodEl => {

    foodEl.querySelector('.add_to_cart').onclick = async event => {

        // access elements
        const idEl = foodEl.querySelector('.food-id')
        const priceEl = foodEl.querySelector('.food-price')
        const qtyEl = foodEl.querySelector('.qty-count')

        // access data
        let price = Number(priceEl.innerHTML)
        let id = Number(idEl.innerHTML)
        let qty = Number(qtyEl.innerHTML)

        // make ajax call
        event.target.disabled = true 

        await fetch('{{ route('cart.create') }}', {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                id,
                qty
            })
        })

        // update data
        qty = 1

        // update view with new data
        event.target.disabled = false
        qtyEl.innerHTML = qty
    }
});

document.querySelectorAll('.qty').forEach(qtyEl => {

    qtyEl.querySelector('.qty-plus').onclick = event => {

        // access elements
        const qtyCountEl = qtyEl.querySelector('.qty-count')

        // access data
        let qty = Number(qtyCountEl.innerHTML)

        // modify data
        qty = qty + 1
        
        // update view with new data
        qtyCountEl.innerHTML = qty
    }

    qtyEl.querySelector('.qty-minus').onclick = event => {

        // access elements
        const qtyCountEl = qtyEl.querySelector('.qty-count')

        // access data
        let qty = Number(qtyCountEl.innerHTML)

        // validate data
        if(qty == 1) return

        // modify data
        qty = qty - 1
        
        // update view with new data
        qtyCountEl.innerHTML = qty
    }
})
</script>


@endsection