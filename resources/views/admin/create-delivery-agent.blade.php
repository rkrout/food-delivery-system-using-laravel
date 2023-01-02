
@include('admin.base')
<form action="{{ route('admin.delivery-agents.store') }}" method="post" enctype="multipart/form-data">
    @csrf


    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="email">email</label>
        <input type="text" name="email" value="{{ old('email') }}">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>


    <button type="submit">save</button>
</form>