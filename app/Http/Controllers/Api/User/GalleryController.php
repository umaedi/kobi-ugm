<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $photos = Gallery::latest()->limit(6)->get();
        $result['photos'] = $photos;
        return $this->sendResponseOk($result);
        // $galeri = Gallery::paginate(12);

        // if ($request->q) {
        //     $galeri->where('title', 'like', '%' . $request->q . '%');
        // };
        // $result['photos'] = $galeri;
        // return $this->sendResponseOk($result);
    }
}
