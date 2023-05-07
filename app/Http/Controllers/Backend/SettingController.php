<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function profile()
    {
        return view('backend.user.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $credentials = $request->validate([
            'name'          => 'required',
            'email'         => 'required',
            'image'         => 'image|file|max:2048',
        ]);

        if ($request->file('image') == '') {
            User::where('id', $id)->update([
                'name'  => $request->name,
                'email' => $request->email,
                'image' => $request->file('image') ? $request->file('image') : $user->image
            ]);
            return redirect('admin/profile')->with('msg', "Profil berhasil diperbaharui");
        } else {
            $image = $request->file('image');
            $image->storeAs('public/user', $image->hashName());

            User::where('id', $id)->update([
                'name'  => $request->name,
                'email' => $request->email,
                'image' => $image->hashName()
            ]);

            return redirect('admin/profile')->with('msg', "Profil berhasil diperbaharui");
        }
    }

    public function password(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $credentials = $request->validate(['password' => 'required|min:6']);
        $request->validate(['currentPassword' => 'required']);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect('/admin/profile')->with('warning', 'Password tidak sesuai !');
        }

        $credentials['password'] = Hash::make($request->password);
        User::where('id', $id)->update($credentials);
        return redirect('/admin/profile')->with('success', 'Password berhasil diperbaharui');
    }

    public function settings()
    {
        $data['settings'] = Setting::first();
        return view('backend.setting.index', $data);
    }
}
