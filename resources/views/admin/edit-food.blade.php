

<form action="{{ route('admin.foods.update', ['food' => $food->id]) }}" method="post" enctype="multipart/form-data">
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $food->name) }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price">price</label>
        <input type="number" name="price" value="{{ old('price', $food->price) }}">
        @error('price')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="is_featured">is_featured</label>
        <input type="checkbox" name="is_featured" @if (old('is_featured', $food->is_featured)) checked @endif value="1">
    </div>

    <div>
        <label for="is_vegan">is_vegan</label>
        <input type="checkbox" name="is_vegan" @if (old('is_vegan', $food->is_vegan)) checked @endif value="1">
    </div>

    <div>
        <label for="category_id">category</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option @if ($category->id == $food->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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

    <button type="submit">update</button>
</form>