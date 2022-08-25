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
        return view('frontend.index', [
            'title' => 'Konsorsium Biologi Indonesia'
        ]);
    }

    public function register()
    {
        return view('frontend.users.register', [
            'provinces' => Province::all(),
            'title' => 'Pendaftaran Anggota Lama'

        ]);
    }

    public function newMember()
    {
        return view('frontend.users.anggotabaru', [
            'provinces' => Province::all(),
            'title' => 'Pendaftaran Anggota Baru'
        ]);
    }

    public function anggota()
    {
        return view('frontend.users.index', [
            'title' => 'Daftar Anggota Aktif'
        ]);
    }

    public function posts()
    {
        return view('frontend.posts.index', [
            'title' => 'Semua berita'
        ]);
    }

    public function listPost()
    {
        $posts = Post::latest();

        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('frontend.posts.list-post', [
            'title' => 'Semua Berita',
            'posts' => $posts->paginate(2),
            'categories'    => Category::latest()->get()
        ]);
    }

    public function postCategories(Category $category)
    {
        return view('frontend.posts.categories', [
            'title' => 'Kategori Berita',
            'posts' => $category->post,

        ]);
    }

    public function show(Post $post)
    {
        return view('frontend.posts.show', [
            'title' => 'Publikasi',
            'post'  => $post,
        ]);
    }

    public function str()
    {
        return view('frontend.str.index', [
            'title' => 'STR'
        ]);
    }

    public function uploadStr()
    {
        return view('frontend.str.upload', [
            'title' => 'Upload'
        ]);
    }

    public function about()
    {
        return view('frontend.pages.about', [
            'title' => 'Sejarah'
        ]);
    }

    public function visiMisi()
    {
        return view('frontend.pages.visi-misi', [
            'title' => 'Visi Misi dan Tujuan'
        ]);
    }

    public function strukturOrgnanisasi()
    {
        return view('frontend.pages.struktur', [
            'title' => 'Struktur Organisasi'
        ]);
    }

    public function publikasi()
    {
        return view('frontend.pages.publikasi', [
            'title' => 'Publikasi'
        ]);
    }

    public function naskah()
    {
        return view('frontend.pages.naskah', [
            'title' => 'Naskah Akademik'
        ]);
    }

    public function laporan()
    {
        return view('frontend.pages.laporan', [
            'title' => 'Laporan'
        ]);
    }

    public function event()
    {
        return view('frontend.event.kongres', [
            'title' => 'Kegiatan'
        ]);
    }

    public function showEvent(Event $event)
    {
        return view('frontend.event.show', [
            'title' => 'Kegiatan',
            'post'  => $event,
            'posts' => Event::latest()->limit(6)->get(),
        ]);
    }

    public function eventList()
    {
        return view('frontend.event.event-list', [
            'title' => 'Kegiatan',
            'posts' => Event::latest()->paginate(),
            'categories'    => EventCategory::latest()->get()
        ]);
    }

    public function eventCategories(EventCategory $eventCategory)
    {
        return view('frontend.event.categories', [
            'title' => 'Kategori Kegiatan',
            'posts' => $eventCategory->event,
        ]);
    }

    public function kurikulum()
    {
        return view('frontend.pages.kurikulum', [
            'title' => 'Kurikulum'
        ]);
    }
}
