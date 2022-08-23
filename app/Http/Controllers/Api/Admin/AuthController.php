<?php

namespace App\Http\Controllers\Api\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $minutes = 60;

        return response()->json([
            'access_token'  => $token,
            'tokenType'     => 'Bearer',
        ], 200)->cookie('akses_tokenku', $token, $minutes);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
        // Auth::logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/admin/login');
    }
}
