<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|email|max:30|unique:users,email',
            'password' => 'required|min:6|max:20|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
 
        if (!Auth::attempt($credentials)) {
            return back()->withInput()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
 
        $request->session()->regenerate();
 
        return redirect()->intended(route('home'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:6|max:20|confirmed'
        ]);

        if(!Hash::check($request->old_password, $request->user()->password)) {
            return back()->with(['error' => 'Invalid old password']);
        }
 
        $request->user()->password = Hash::make($request->new_password);

        $request->user()->save();

        return back()->with(['success' => 'Password changed succesfully']);
    }

    public function editAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|email|max:30|unique:users,email,' . $request->user()->id
        ]);

        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with(['success' => 'Account edited successfully']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('auth.login-view');
    }
}
