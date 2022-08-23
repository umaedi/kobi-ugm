<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Post;
use App\Models\Province;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function register()
    {
        return view('frontend.users.register', [
            'provinces' => Province::all(),

        ]);
    }

    public function newMember()
    {
        return view('frontend.users.anggotabaru', [
            'provinces' => Province::all(),
        ]);
    }

    public function anggota()
    {
        return view('frontend.users.index');
    }

    public function posts()
    {
        return view('frontend.posts.index');
    }

    public function listPost()
    {
        return view('frontend.posts.list-post');
    }

    public function postCategories(Category $category)
    {
        return view('frontend.posts.categories', [
            'posts' => $category->post,

        ]);
    }

    public function show(Post $post)
    {
        return view('frontend.posts.show', [
            'post'  => $post,
        ]);
    }

    public function str()
    {
        return view('frontend.str.index');
    }

    public function uploadStr()
    {
        return view('frontend.str.upload');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function visiMisi()
    {
        return view('frontend.pages.visi-misi');
    }

    public function strukturOrgnanisasi()
    {
        return view('frontend.pages.struktur');
    }

    public function publikasi()
    {
        return view('frontend.pages.publikasi');
    }

    public function naskah()
    {
        return view('frontend.pages.naskah');
    }

    public function laporan()
    {
        return view('frontend.pages.laporan');
    }

    public function event()
    {
        return view('frontend.event.kongres');
    }

    public function showEvent(Event $event)
    {
        return view('frontend.event.show', [
            'post'  => $event,
            'posts' => Event::latest()->limit(6)->get(),
        ]);
    }

    public function eventList()
    {
        return view('frontend.event.event-list');
    }

    public function eventCategories(EventCategory $eventCategory)
    {
        return view('frontend.event.categories', [
            'posts' => $eventCategory->event,
        ]);
    }

    public function kurikulum()
    {
        return view('frontend.pages.kurikulum');
    }
}
