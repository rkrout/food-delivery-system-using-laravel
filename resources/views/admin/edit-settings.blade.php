
@include('admin.base')
<form action="{{ route('admin.settings.update') }}" method="post">
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="delivery_fee">delivery_fee</label>
        <input type="number" name="delivery_fee" value="{{ old('delivery_fee', $setting->delivery_fee) }}">
        @error('delivery_fee')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="gst_percentage">gst_percentage</label>
        <input type="number" name="gst_percentage" value="{{ old('gst_percentage', $setting->gst_percentage) }}">
        @error('gst_percentage')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">update</button>
</form>