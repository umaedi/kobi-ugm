<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::controller(\App\Http\Controllers\Backend\DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index');
            Route::get('/users', 'users')->name('admin.users');
            Route::get('/users/active', 'usersActive')->name('admin.users-active');
            Route::get('/categories', 'categories')->name('categories');
            Route::get('/publikasi', 'publikasi')->name('admin.publikasi');
            Route::get('/naskah-akademik', 'naskah')->name('admin.naskah');
            Route::get('/ad-art', 'adArt')->name('admin.ad-art');
            Route::get('/kurikulum', 'kurikulum')->name('admin.kurikulum');
            Route::get('/laporan', 'laporan')->name('admin.laporan');
            Route::get('/event', 'event')->name('admin.event');
            Route::get('/event/kategori', 'eventKategori')->name('admin.event.kategori');
            Route::get('/event/create', 'createEvenet')->name('admin.event.create');
        });

        //STR
        Route::controller(\App\Http\Controllers\Backend\StrController::class)->group(function () {
            Route::get('/str', 'index');
            Route::get('/str/show/{id}', 'strShow');
            Route::get('/str/verif', 'strVerif')->name('strVerif');
            Route::get('/str/reject', 'strReject')->name('strReject');
            Route::get('/str/destroy', 'strDestroy');
        });

        Route::resource('/post', \App\Http\Controllers\Backend\PostController::class);
        Route::get('/posts/draft/', [\App\Http\Controllers\Backend\PostController::class, 'postDraft'])->name('admin.post.draft');

        Route::post('/auth/admin/destroy', [\App\Http\Controllers\Auth\AuthController::class, 'destroy'])->name('logout');

        Route::controller(\App\Http\Controllers\Backend\SettingController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::post('/profile/{id}', 'updateProfile');
            Route::post('/password/{id}', 'password');
            Route::get('/web/settings', 'settings')->name('settings');
        });

        Route::get('/gallery', [\App\Http\Controllers\Backend\GaleryController::class, 'index'])->name('admin.gallery');
    });
});
