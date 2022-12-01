<?php

namespace App\Http\Controllers\Api\User;

use App\Models\AdArt;
use App\Http\Controllers\Api as Controller;

class AdArtController extends Controller
{
    public function index()
    {
        $adArt = AdArt::latest()->limit(1)->get();
        $result['adart'] = $adArt;
        return $this->sendResponseOk($result);
    }
}
