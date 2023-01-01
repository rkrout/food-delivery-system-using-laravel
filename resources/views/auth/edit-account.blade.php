<form action="{{ route('auth.edit-account') }}" method="post">
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="{{ old('email', Auth::user()->email) }}">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Update</button>
</form>

<script>
    document.querySelectorAll('form').forEach(formEl => {
        formEl.onsubmit = e => {
            e.preventDefault()
            formEl.querySelector('button[type=submit]').disabled = true
            e.target.submit()
        }
    })
</script>