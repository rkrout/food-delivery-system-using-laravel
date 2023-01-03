@include('base')

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
        <button class="btn-remove-cart">Remove from Cart</button>
    </div>
@endforeach

<br> <br>
<span id="totalPrice">{{ $pricing['total_price'] }}</span> - Total Price <br>
<span id="deliveryFee">{{ $pricing['delivery_fee'] }}</span> - Delivery Fee  <br>
<span id="gstPercentage">{{ $pricing['gst_percentage'] }}</span> - Gst Percentage  <br>
<span id="gst">{{ $pricing['gst'] }}</span> - Gst  <br>
<span id="totalPayable">{{ $pricing['total_payable'] }}</span> - total_payable  <br>


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

