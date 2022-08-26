<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::latest()->limit(6)->get();
        $result['photos'] = $photos;
        return $this->sendResponseOk($result);
    }
}
