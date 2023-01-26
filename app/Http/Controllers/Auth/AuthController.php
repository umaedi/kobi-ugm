<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($request->remember) {
            $remember = $request->remember;
        } else {
            $remember = "";
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return redirect()->intended('/admin/dashboard?token=' . $token);
        }
        return back()->with('msg', 'Login gagal !');
    }

    public function destroy(Request $request)
    {
        // $user = User::findOrfail(auth()->user()->id);
        // $user->tokens()->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
