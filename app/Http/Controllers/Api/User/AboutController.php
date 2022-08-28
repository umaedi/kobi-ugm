<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\About;
use App\Models\Founder;
use App\Models\Pendiri;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sejarah(Request $request)
    {
        if ($request->ajax()) {
            $about = About::where('status', 1)->get()->first();
            $result['about'] = $about;
            return $this->sendResponseOk($result);
        }
    }

    public function founder(Request $request)
    {
        if ($request->ajax()) {
            $fo = Founder::latest()->get();
            $result['founder'] = $fo;
            return $this->sendResponseOk($result);
        }
    }
}
