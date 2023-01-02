

<form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
    @csrf


    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image">Image</label>
        <input type="file" name="image" >
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">update</button>
</form>