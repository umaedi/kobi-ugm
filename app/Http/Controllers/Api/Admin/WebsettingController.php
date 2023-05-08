<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api as Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsettingController extends Controller
{
    public function store(Request $request)
    {
        $setting = Setting::first();
        if ($request->file('logo')) {
            $logo =  Storage::putFile('public/logo', $request->logo);
            Storage::delete($setting->logo);
        } else {
            $logo = $setting->logo;
        }

        if ($request->file('photo_ketua')) {
            $photo_ketua = Storage::putFile('public/photo_ketua', $request->photo_ketua);
            Storage::delete($setting->photo_ketua);
        } else {
            $photo_ketua = $setting->photo_ketua;
        }

        $data = $request->except('_token');
        $data['logo'] = $logo;
        $data['photo_ketua'] = $photo_ketua;


        $setting->update($data);
        return $this->sendResponseUpdate($setting);
    }
}
