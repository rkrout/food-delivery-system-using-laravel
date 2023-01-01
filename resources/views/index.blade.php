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
                <a href="{{ route('home') }}">home</a>
            </li>
            <li>
                <a href="{{ route('checkout') }}">checkout</a>
            </li>
            <li>
                <a href="{{ route('auth.edit-account-view') }}">Edit Account</a>
            </li>
            <li>
                <a href="{{ route('search') }}">search</a>
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

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </body>

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

                fetch('{{ route('cart.add') }}', {
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
</html>
