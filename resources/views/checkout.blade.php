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

<form action="{{ route('orders.place') }}" method="post">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="mobile">Mobile</label>
        <input type="number" name="mobile" value="{{ old('mobile') }}">
        @error('mobile')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="street">street</label>
        <input type="text" name="street">
        @error('street')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="instruction">instruction</label>
        <input type="text" name="instruction">
        @error('instruction')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">place</button>
</form>

{{ $total_price }} Total Price  <br>
{{ $delivery_fee }} Delivery Fee  <br>
{{ $gst_percentage }} Gst Percentage  <br>
{{ $gst }} Gst  <br>
{{ $total_payable }} total_payable <br>