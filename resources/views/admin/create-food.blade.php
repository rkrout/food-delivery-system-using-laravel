

<form action="{{ route('admin.foods.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price">price</label>
        <input type="number" name="price" value="{{ old('price') }}">
        @error('price')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="is_featured">is_featured</label>
        <input type="checkbox" name="is_featured" @if (old('is_featured')) checked @endif value="1">
    </div>

    <div>
        <label for="is_vegan">is_vegan</label>
        <input type="checkbox" name="is_vegan" @if (old('is_vegan')) checked @endif value="1">
    </div>
    
    <div>
        <label for="category_id">category</label>
        <select name="category_id" id="category_id">
            <option value=""></option>
            @foreach ($categories as $category)
                <option @if ($category->id == old('category_id')) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
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

    <button type="submit">save</button>
</form>