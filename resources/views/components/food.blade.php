<div class="food shadow border rounded-md p-2">
    <p class="food-id hidden">{{ $food->id }}</p>

    <img src="{{ $food->image_url }}" class="rounded-md object-cover">

    <p class="food-name mt-2 font-semibold">{{ $food->name }}</p>

    <p class="food-price text-lg text-orange-600 font-bold my-2">Rs {{ $food->price }}</p>

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
    
        <button class="add_to_cart bg-orange-600 rounded-md px-3 py-1 h-min text-white hover:bg-orange-800
        disabled:bg-orange-400 transition-all duration-300 disabled:cursor-not-allowed">Add To Cart</button>
    </div>
</div>