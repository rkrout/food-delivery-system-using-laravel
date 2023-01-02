

<form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
    @csrf


    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="image">Image</label>
        <input type="file" name="image" >
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">save</button>
</form>