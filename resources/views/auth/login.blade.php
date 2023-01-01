<form action="{{ route('auth.login') }}" method="post">
    @csrf

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="{{ old('email') }}">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Login</button>
</form>