<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\About;
use App\Models\Founder;
use App\Models\Pendiri;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sejarah(Request $request)
    {
        if ($request->ajax()) {
            $about = About::select('title', 'body')->where('status', 1)->get()->first();
            $result['about'] = $about;
            return $this->sendResponseOk($result);
        }
    }

    public function founder(Request $request)
    {
        if ($request->ajax()) {
            $fo = Founder::select('name', 'photo', 'position')->latest()->get();
            $result['founder'] = $fo;
            return $this->sendResponseOk($result);
        }
    }

    public function visionMision()
    {
        $visi = VisiMisi::select('title', 'body')->latest()->first();
        $result['vision'] = $visi;
        return $this->sendResponseOk($result);
    }
}
