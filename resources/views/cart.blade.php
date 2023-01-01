<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>


    </head>
    <body class="antialiased">

        <ul>
            <li>
                <a href="{{ route('auth.change-password-view') }}">Change Password</a>
            </li>
            <li>
                <a href="{{ route('search') }}">search</a>
            </li>
            <li>
                <a href="{{ route('home') }}">home</a>
            </li>
            <li>
                <a href="{{ route('auth.edit-account-view') }}">Edit Account</a>
            </li>
            <li>
                <a href="{{ route('checkout') }}">checkout</a>
            </li>
            <li>
                <a href="{{ route('cart') }}">cart</a>
            </li>
            <li>
                <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>

        <h1>cart page</h1>
        @foreach ($foods as $food)
            <div class="food">
                <p class="food-id" style="display: none">{{ $food->id }}</p>
                <div class="qty">
                    <button class="qty-minus">-</button>
                    <p class="qty-count">{{ $food->qty }}</p>
                    <button class="qty-plus">+</button>
                </div>
                <img src="{{ $food->image_url }}" alt="">
                <p class="food-name">{{ $food->name }}</p>
                <p class="food-price">{{ $food->price }}</p>
                <button class="remove_to_cart">Remove from Cart</button>
            </div>
        @endforeach
    </body>

    <script>
        document.querySelectorAll('.food').forEach(foodEl => {
            const qtyPlusEl = foodEl.querySelector('.qty-plus')
            const qtyMinusEl = foodEl.querySelector('.qty-minus')
            const btnRemoveEl = foodEl.querySelector('.remove_to_cart')

            btnRemoveEl.onclick = e => {
                const idEl = foodEl.querySelector('.food-id')
                const id = idEl.innerHTML

                fetch('{{ route('cart.remove') }}', {
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
                .then(async (response) => {
                    foodEl.remove()
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    e.target.disabled = false
                })
            }

            qtyPlusEl.onclick = e => {
                const qtyCountEl = foodEl.querySelector('.qty-count')
                const idEl = foodEl.querySelector('.food-id')
                const qtyCount = qtyCountEl.innerHTML
                const id = idEl.innerHTML

                const newQty = Number(qtyCount) + 1

                fetch('{{ route('cart.add') }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id,
                        qty: newQty
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
                    qtyCountEl.innerHTML = newQty
                })
            }

            qtyMinusEl.onclick = e => {
                const qtyCountEl = foodEl.querySelector('.qty-count')
                const idEl = foodEl.querySelector('.food-id')
                const qtyCount = qtyCountEl.innerHTML
                const id = idEl.innerHTML
                if(qtyCount == 1) return

                const newQty = Number(qtyCount) - 1

                fetch('{{ route('cart.add') }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id,
                        qty: newQty
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
                    qtyCountEl.innerHTML = newQty
                })
            }
        })
        document.querySelectorAll('.food').forEach(foodEl => {
            const qtyPlusEl = foodEl.querySelector('.qty-plus')
            const qtyMinusEl = foodEl.querySelector('.qty-minus')

            qtyPlusEl.onclick = e => {
                const qtyCountEl = foodEl.querySelector('.qty-count')
                const idEl = foodEl.querySelector('.food-id')
                const qtyCount = qtyCountEl.innerHTML
                const id = idEl.innerHTML

                const newQty = Number(qtyCount) + 1

                fetch('{{ route('cart.add') }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id,
                        qty: newQty
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
                    qtyCountEl.innerHTML = newQty
                })
            }

            qtyMinusEl.onclick = e => {
                const qtyCountEl = foodEl.querySelector('.qty-count')
                const idEl = foodEl.querySelector('.food-id')
                const qtyCount = qtyCountEl.innerHTML
                const id = idEl.innerHTML
                if(qtyCount == 1) return

                const newQty = Number(qtyCount) - 1

                fetch('{{ route('cart.add') }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        id,
                        qty: newQty
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
                    qtyCountEl.innerHTML = newQty
                })
            }
        })


    </script>
</html>
