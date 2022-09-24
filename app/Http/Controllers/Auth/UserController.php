<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;
use App\Models\Universitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.user.register', [
            'title' => 'Daftar',
            'events'    => EventCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan'  => 'required|string|max:255',
            'no_anggota'    => 'required|string|max:255|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string|confirmed|min:6'
        ]);

        $no_anggota = Universitas::where('no_anggota', $request->no_anggota)->first();
        if ($no_anggota == null || $no_anggota->status != 1) {
            return back()->with('msg', 'No anggota tidak ditemukan atau belum aktif');
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect('/user/login')->with('success', 'Selamat akun Anda berhasil dibuat. Silahkan login');
    }

    public function login()
    {
        return view('auth.user.login', [
            'title' =>  'Masuk',
            'events'    => EventCategory::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'no_anggota'     => 'required',
            'password'  => 'required',
        ]);

        $active = Universitas::where('no_anggota', $request->no_anggota)->first();
        if ($active == null || $active->status != 1) {
            return back()->with('active', 'Anda belum terdaftar sebagai anggota aktif !');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('active', 'No anggota atau password Anda salah !');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
