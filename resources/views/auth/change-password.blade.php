
@extends('base')

@section('header')
    <title>Change Password</title>
@endsection

@section('content')
<form class="max-w-xl p-6 my-8 mx-4 md:mx-auto shadow rounded-md border-2 border-gray-300" action="{{ route('auth.change-password') }}" method="post">
    <h2 class="text-2xl text-orange-600 font-bold text-center mb-6">Change Password</h2>
    @csrf

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="mb-5">
        <label for="old_password" class="font-semibold inline-block mb-1">Old Password</label>
        <input type="password" name="old_password" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600 focus:ring-1 focus:ring-orange-600" value="{{ old('old_password') }}">
        @error('old_password')
            <p class="font-semibold text-red-600 mt-1 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-5">
        <label for="new_password" class="font-semibold inline-block mb-1">New Password</label>
        <input type="password" name="new_password" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600" value="{{ old('new_password') }}">
    </div>

    <div class="mb-5">
        <label for="new_password_confirmation" class="font-semibold inline-block mb-1">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="mt-1 border-2 border-gray-300 rounded-md p-2 outline-none block 
        w-full focus:border-orange-600
        focus:ring-1 focus:ring-orange-600" value="{{ old('new_password_confirmation') }}">
        @error('new_password_confirmation')
            <p class="font-semibold text-red-600 mt-1 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full px-4 py-2 bg-orange-600 rounded-md text-white hover:bg-orange-800
    disabled:bg-orange-400 disabled:cursor-not-allowed transition-all duration-300">Change Password</button>
</form>
@endsection