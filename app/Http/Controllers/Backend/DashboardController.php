<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function users()
    {
        return view('backend.users.index');
    }

    public function usersActive()
    {
        return view('backend.users.active');
    }

    public function media()
    {
        $data['nav'] = 'Posts';
        return view('backend.media.index', compact('data'));
    }

    public function strShow($id)
    {
        return view('backend.str.show');
    }

    public function categories()
    {
        return view('backend.categories.index');
    }

    public function naskah()
    {
        return view('backend.naskah.index');
    }

    public function publikasi()
    {
        return view('backend.publikasi.index');
    }

    public function adArt()
    {
        return view('backend.ad-art.index');
    }

    public function kurikulum()
    {
        return view('backend.kurikulum.index');
    }

    public function laporan()
    {
        return view('backend.laporan.index');
    }

    public function event()
    {
        return view('backend.event.index');
    }

    public function createEvenet()
    {
        return view('backend.event.create');
    }

    public function eventKategori()
    {
        return view('backend.event-category.index');
    }

    public function galeri()
    {
        return view('backend.galeri.index', [
            'galleries' => Gallery::latest()->paginate(12)
        ]);
    }
}
