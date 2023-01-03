@extends('base')

@section('content')
<form action="{{ route('search') }}" method="get" class="mx-auto max-w-2xl border-2 border-gray-300 rounded-md shadow p-4 mt-8 mb-4 flex ">
    <input type="search" class="flex-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
    w-full focus:border-orange-600 focus:ring-1 focus:ring-orange-600 rounded-r-none" name="search" value="{{ old('search') }}"
    placeholder="Search here...">
    <button type="submit" class="bg-gray-200 px-3 flex justify-center hover:bg-gray-300 transition-all duration-300 items-center border-l-0 border-2 border-gray-300">
        <span class="material-symbols-outlined">search</span>
    </button>
</form>
<h2 class="text-2xl font-bold text-orange-600 mt-8 mb-5 max-w-5xl mx-4 md:mx-auto">123 Food Found</h2>
<div class="grid grid-cols-3 gap-4 max-w-5xl mx-auto mb-8">
@foreach ($foods as $food)
    <x-food :food="$food"/>
@endforeach
</div>

<script>
    document.querySelectorAll('.food').forEach(foodEl => {
        const cartBtnEl = foodEl.querySelector('.add_to_cart')

        cartBtnEl.onclick = e => {
            const priceEl = foodEl.querySelector('.food-price')
            const price = priceEl.innerHTML
            const idEl = foodEl.querySelector('.food-id')
            const qtyCountEl = foodEl.querySelector('.qty-count')
            const id = idEl.innerHTML
            const qty = qtyCountEl.innerHTML
            e.target.disabled = true 

            fetch('{{ route('cart.create') }}', {
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
            .then(async (response) => {
                console.log(await response.json());
            })
            .catch((error) => {
                console.log('error');
            })
            .finally(() => {
                e.target.disabled = false
                qtyCountEl.innerHTML = 1
            })
        }
    });

    document.querySelectorAll('.qty').forEach(qtyEl => {
        const qtyPlusEl = qtyEl.querySelector('.qty-plus')
        const qtyMinusEl = qtyEl.querySelector('.qty-minus')

        qtyPlusEl.onclick = e => {
            const qtyCountEl = qtyEl.querySelector('.qty-count')
            const qtyCount = qtyCountEl.innerHTML
            qtyCountEl.innerHTML = Number(qtyCount) + 1
        }

        qtyMinusEl.onclick = e => {
            const qtyCountEl = qtyEl.querySelector('.qty-count')
            const qtyCount = qtyCountEl.innerHTML
            if(qtyCount == 1) return
            qtyCountEl.innerHTML = Number(qtyCount) - 1
        }
    })

</script>


@endsection