<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user());
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|email|max:30|unique:users,email',
            'password' => 'required|min:6|max:20'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Token::create([
            'user_id' => $user->id,
            'token' => bin2hex(random_bytes(32))
        ]);

        return response()->json($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user && Hash::check($request->password, $user->password)) {

            $token = Token::create([
                'user_id' => $user->id,
                'token' => bin2hex(random_bytes(32))
            ]);
    
            return response()->json($token);
        }

        return response()->json(['error' => 'Invalid email or password'], 422);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:6|max:20'
        ]);
 
        $request->user()->password = Hash::make($request->new_password);

        $request->user()->save();

        return response()->json(['success' => 'Password changed successfully']);
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

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        Token::where('token', $request->header('authorization'))->delete();
 
        return response()->json(['success' => 'Logout successfully']);
    }
}
