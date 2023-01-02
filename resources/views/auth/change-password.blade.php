@include('base')

<form action="{{ route('auth.change-password') }}" method="post">
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="old_password">Old Password</label>
        <input type="password" name="old_password" value="{{ old('old_password') }}">
        @error('old_password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" value="{{ old('new_password') }}">
        @error('new_password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password_confirmation">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
        @error('new_password_confirmation')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Change Password</button>
</form>