@include('base')

<form action="{{ route('search') }}" method="get">
    <input type="search" name="search" value="{{ old('search') }}">
    <button type="submit">submit</button>
</form>

@foreach ($foods as $food)
    <div class="food">
        <p class="food-id" style="display: none">{{ $food->id }}</p>
        <div class="qty">
            <button class="qty-minus">-</button>
            <p class="qty-count">1</p>
            <button class="qty-plus">+</button>
        </div>
        <img src="{{ $food->image_url }}" alt="">
        <p class="food-name">{{ $food->name }}</p>
        <p class="food-price">{{ $food->price }}</p>
        <button class="add_to_cart">Add To Cart</button>
    </div>
@endforeach

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

