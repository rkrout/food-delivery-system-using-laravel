@include('base')

@foreach ($sliders as $slider)
    <div>
        <img src="{{ $slider->image_url }}" alt="">
    </div>
@endforeach

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

