<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserExporController;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::controller(\App\Http\Controllers\Backend\DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index');
            Route::get('/anggota/baru', 'users')->name('admin.users');
            Route::get('/anggota/baru/detail/{id}', 'newUserDetail')->name('admin.user.detail');
            Route::get('/anggota/lama', 'anggotaLama')->name('anggota.lama');
            Route::get('/anggota/aktif/detail/{id}', 'userEdit');
            Route::get('/anggota/aktif', 'usersActive')->name('admin.users-active');
            Route::get('/anggota/nonaktif', 'nonAktif')->name('admin.users-non-active');
            Route::get('/anggota/ditolak', 'usersNonActive')->name('admin.users-reject');
            Route::get('/anggota/ditolak/detail/{id}', 'usersNonActiveEdit')->name('admin.users-reject.edit');
            Route::get('/categories', 'categories')->name('categories');
            Route::get('/publikasi', 'publikasi')->name('admin.publikasi');
            Route::get('/naskah-akademik', 'naskah')->name('admin.naskah');
            Route::get('/ad-art', 'adArt')->name('admin.ad-art');
            Route::get('/kurikulum', 'kurikulum')->name('admin.kurikulum');
            Route::get('/kurikulum/{id}', 'editKurikulum');
            Route::get('/laporan', 'laporan')->name('admin.laporan');
            Route::get('/kegiatan', 'event')->name('admin.event');
            Route::get('/event/kategori', 'eventKategori')->name('admin.event.kategori');
            Route::get('/event/create', 'createEvenet')->name('admin.event.create');
            Route::get('/event/edit/{id}', 'eventEdit');
            Route::get('/sejarah', 'sejarah')->name('admin.sejarah');
            Route::get('/visi-misi', 'VisiMisi')->name('admin.visiMisi');
            Route::get('/galeri/foto', 'galeri')->name('admin.galeri');
            Route::get('/struktur-organisasi', 'struktur')->name('admin.struktur');
        });
        Route::controller(\App\Http\Controllers\UserExporController::class)->group(function () {
            Route::post('/export/data/user/', 'exportUser')->name('export.excel');
            Route::post('/export/data/str', 'dataStr')->name('export.str');
        });

        Route::controller(\App\Http\Controllers\Backend\StrukturController::class)->group(function () {
            Route::get('/organisasi/surat-keputusan', 'suratKeputusan')->name('admin.surat');
            Route::get('/organisasi/dewan-penasihat', 'dewanPenasiaht')->name('admin.penasihat');
            Route::get('/organisasi/ketua-wakil', 'ketuaWakil')->name('admin.ketua');
            Route::get('/organisasi/sekretaris', 'sekretaris')->name('admin.sekretaris');
            Route::get('/organisasi/bendahara', 'bendahara')->name('admin.bendahara');
            Route::get('/organisasi/koordinator-wilayah', 'koorWlayah')->name('admin.wilayah');
            Route::get('/organisasi/koordinator-bidang-kurikulum', 'koorKurikulum')->name('admin.bid-kurikulum');
            Route::get('/organisasi/humas', 'humas')->name('admin.humas');
        });

        //STR
        Route::controller(\App\Http\Controllers\Backend\StrController::class)->group(function () {
            Route::get('/str', 'index');
            Route::get('/str/show/{id}', 'strShow');
            Route::get('/str/ditolak/show/{id}', 'strDitolak');
            Route::get('/str/verif', 'strVerif')->name('strVerif');
            Route::get('/str/reject', 'strReject')->name('strReject');
            Route::get('/str/destroy', 'strDestroy');
            Route::get('/str/bukti-pembayaran', 'struk')->name('admin.struk');
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

        Route::get('/pengunjung', [App\Http\Controllers\Backend\PengunjungController::class, 'index'])->name('admin.pengunjung');
    });
});
