<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Gallery;
use App\Models\Kurikulum;
use App\Models\Post;
use App\Models\Province;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'title' => 'Konsorsium Biologi Indonesia',
            'events'    => EventCategory::all()
        ]);
    }

    public function register()
    {
        return view('frontend.users.register', [
            'provinces' => Province::all(),
            'title' => 'Pendaftaran Anggota Lama',
            'events'    => EventCategory::latest()->get()

        ]);
    }

    public function newMember()
    {
        return view('frontend.users.anggotabaru', [
            'provinces' => Province::all(),
            'title' => 'Pendaftaran Anggota Baru',
            'events'    => EventCategory::latest()->get(),
        ]);
    }

    public function anggota()
    {
        return view('frontend.users.index', [
            'title' => 'Daftar Anggota Aktif',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function persyaratan()
    {
        return view('frontend.pages.persyaratan', [
            'title' => 'Pendaftaran Anggota Baru',
            'events'    => EventCategory::latest()->get(),
        ]);
    }

    public function posts()
    {
        return view('frontend.posts.index', [
            'title' => 'Semua berita',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function listPost()
    {
        $posts = Post::orderBy('publish_at', 'DESC');

        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('frontend.posts.list-post', [
            'title' => 'Semua Berita',
            'posts' => $posts->paginate(6),
            'categories'    => Category::latest()->get(),
            'events'    => EventCategory::latest()->get(),
        ]);
    }

    public function postCategories(Category $category)
    {
        return view('frontend.posts.categories', [
            'title' => 'Kategori Berita',
            'posts' => $category->post,
            'events'    => EventCategory::latest()->get(),

        ]);
    }

    public function show(Post $post)
    {
        return view('frontend.posts.show', [
            'title' => 'Publikasi',
            'post'  => $post,
            'events'    => EventCategory::latest()->get(),
        ]);
    }

    public function str()
    {
        return view('frontend.str.index', [
            'title' => 'STR',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function uploadStr()
    {
        return view('frontend.str.upload', [
            'title' => 'Upload',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function about()
    {
        return view('frontend.pages.about', [
            'title'     => 'Sejarah',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function visiMisi()
    {
        return view('frontend.pages.visi-misi', [
            'title'     => 'Visi Misi dan Tujuan',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function strukturOrgnanisasi()
    {
        return view('frontend.pages.struktur', [
            'title' => 'Struktur Organisasi',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function publikasi()
    {
        return view('frontend.pages.publikasi', [
            'title' => 'Publikasi',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function naskah()
    {
        return view('frontend.pages.naskah', [
            'title' => 'Naskah Akademik',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function laporan()
    {
        return view('frontend.pages.laporan', [
            'title' => 'Laporan',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function event()
    {
        return view('frontend.event.kongres', [
            'title' => 'Kegiatan',
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function showEvent(Event $event)
    {
        return view('frontend.event.show', [
            'title' => 'Kegiatan',
            'post'  => $event,
            'posts' => Event::latest()->limit(6)->get(),
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function eventList()
    {
        return view('frontend.event.event-list', [
            'title' => 'Kegiatan',
            'posts' => Event::latest()->paginate(),
            'categories'    => EventCategory::latest()->get(),
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function eventCategories(EventCategory $eventCategory)
    {
        return view('frontend.event.categories', [
            'title' => 'Kategori Kegiatan',
            'posts' => $eventCategory->event,
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function kurikulum()
    {
        return view('frontend.pages.kurikulum', [
            'title' => 'Kurikulum',
            'kurikulum' => Kurikulum::where('status', 1)->latest()->first(),
            'events'    => EventCategory::latest()->get()
        ]);
    }

    public function galeri()
    {
        $gallery = Gallery::latest();
        if (request('search')) {
            $gallery->where('title', 'like', '%' . request('search') . '%');
        }
        return view('frontend.pages.galeri', [
            'title'     => 'Galeri',
            'events'    => EventCategory::latest()->get(),
            'galleries' => $gallery->paginate(12)
        ]);
    }

    public function notifikasi()
    {
        return view('frontend.pages.notifikasi', [
            'title'     => 'Notifikasi',
            'events'    => EventCategory::latest()->get(),
        ]);
    }
}
