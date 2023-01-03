@include('base')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('orders.store') }}" method="post" id="form">
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
        <input type="text" name="street" value="{{ old('street') }}">
        @error('street')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="instruction">instruction</label>
        <input type="text" name="instruction" value="{{ old('instruction') }}">
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
