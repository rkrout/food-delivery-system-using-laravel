
@extends('base')

@section('content')
<form class="max-w-2xl border p-5 mx-auto my-8 shadow-lg rounded-md" action="{{ route('auth.change-password') }}" method="post">
    <h2 class="text-2xl text-orange-600 font-bold text-center mb-5">Change Password</h2>
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div>
        <label for="old_password" class="font-semibold inline-block mb-1">Old Password</label>
        <input type="password" name="old_password" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        mb-5 w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600" value="{{ old('old_password') }}">
        @error('old_password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password" class="font-semibold inline-block mb-1">New Password</label>
        <input type="password" name="new_password" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        mb-5 w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600" value="{{ old('new_password') }}">
        @error('new_password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password_confirmation" class="font-semibold inline-block mb-1">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        mb-5 w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600" value="{{ old('new_password_confirmation') }}">
        @error('new_password_confirmation')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full px-4 py-2 bg-orange-600 rounded-md text-white font-semibold text-lg">Change Password</button>
</form>
@endsection