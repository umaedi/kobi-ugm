<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {

        $galeri = Gallery::latest()->paginate(6);
        return $this->sendResponseOk($galeri);
    }

    public function galeri(Request $request)
    {
        $galeri = Gallery::latest()->paginate(12);

        if ($request->search) {
            $galeri = Gallery::where('title', 'like', '%' . $request->search . '%')->paginate();
        };

        return $this->sendResponseOk($galeri);
    }
}
