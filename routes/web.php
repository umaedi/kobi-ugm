<?php

use App\Http\Controllers\UserExporController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//user
Route::controller(\App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/p/sejarah-kobi', 'about')->name('about');
    Route::get('visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/struktur-orgnanisasi', 'strukturOrgnanisasi')->name('struktur-orgnanisasi');
    Route::get('/publikasi', 'publikasi')->name('publikasi');
    Route::get('/naskah-akademik', 'naskah')->name('naskah-akademik');
    Route::get('/laporan-kegiatan', 'laporan')->name('laporan');
    Route::get('/persyaratan', 'persyaratan')->name('persyaratan');
    Route::get('/pendaftaran/anggota-lama', 'register')->name('pendaftaran');
    Route::get('/pendaftaran/anggota-baru', 'newMember')->name('pendaftaran-anggota-baru');
    Route::get('/list-anggota', 'anggota')->name('list-anggota');
    Route::get('/berita', 'posts')->name('posts');
    Route::get('/{post:slug}', 'show')->name('show');
    Route::get('/posts/category/{category:slug}', 'postCategories');
    Route::get('/posts/list', 'listPost')->name('posts.list');
    Route::get('/permohonan/pengajuan-str', 'str')->name('str');
    Route::get('/permohonan/upload-str', 'uploadStr')->name('upload.str');
    Route::get('/event/{eventCategory:slug}', 'event')->name('event');
    Route::get('/event/category/{eventCategory:slug}', 'eventCategories')->name('event');
    Route::get('/event/list/allcategories', 'eventList')->name('user.event.list');
    Route::get('/event/show/{event:slug}', 'showEvent');
    Route::get('/kurikulum/kobi', 'kurikulum')->name('kurikulum');
    Route::get('/ad-art', 'adArt')->name('ad-art')->name('adart');
    Route::get('/galeri/foto', 'galeri')->name('galeri');
    Route::get('/notifikasi/{slug}', 'notifikasi')->name('notifikasi');
});

Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::get('/admin/login', 'login')->middleware('guest');
    Route::post('/auth/admin/login', 'authenticate')->name('admin.login');
});



Route::controller(\App\Http\Controllers\Auth\UserController::class)->group(function () {
    Route::get('/user/register', 'register')->name('user.register');
    Route::get('/user/login', 'login')->name('login');
    Route::post('/user/store', 'store')->name('user.store');
    Route::post('/user/authenticate', 'authenticate')->name('authenticate');
    Route::get('/user/logout', 'destroy')->name('user.logout');
});

Route::controller(\App\Http\Controllers\Auth\SocialiteController::class)->group(function () {
    Route::get('/auth/redirect/{provider}', 'redirectToProvider');
    Route::get('/auth/redirect/{provider}/callback-url', 'hadleProviderCallback');
});

Route::post('/images', [\App\Http\Controllers\Backend\ImageController::class, 'store'])->name('admin.image')->middleware('auth');

//laravel manager
