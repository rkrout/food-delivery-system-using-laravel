<form action="{{ route('auth.sign-up') }}" method="post">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

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

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation">
        @error('password_confirmation')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Sign Up</button>

    <a href="{{ route('auth.login-view') }}">login</a>
</form>