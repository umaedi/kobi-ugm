<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use App\Mail\Admin\EmailAdminNotofSTR;
use App\Mail\Admin\RegisterMail;
use App\Mail\EmailKonfirmasiAnggota;
use App\Mail\EmailKonfirmasiStr;
use App\Mail\EmailTolakAnggota;
use App\Mail\EmailTolakStr;
use App\Mail\User\EmailNotifSTR;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::post('admin/auth/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::post('/auth/admin/logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(\App\Http\Controllers\Api\Admin\StrController::class)->group(function () {
            Route::get('/str', 'index');
            Route::get('/str/show/{id}', 'strShow');
            Route::post('/str/update/{id}', 'strUpdate');
            Route::get('/str/verif', 'strVerif');
            Route::get('/str/reject', 'strReject');
            Route::delete('/str/destroy/{id}', 'strDestroy');
            Route::get('/struk', 'struk');
            Route::delete('/struk/destroy/{id}', 'strukDestroy');
        });
        Route::resource('/posts', Api\PostController::class);
        Route::controller(Api\CategoryController::class)->group(function () {
            Route::post('/categories', 'index');
            Route::post('/categories/store', 'store');
            Route::post('categories/update', 'update');
        });

        Route::controller(Api\Admin\UserController::class)->group(function () {
            Route::get('/users', 'index')->name('admin.users');
            Route::get('/anggota-lama', 'anggotaLama')->name('anggota.lama');
            Route::post('/users/active', 'userActive')->name('admin.userActive');
            Route::get('/users/reject', 'userReject')->name('admin.userReject');
            Route::get('/users/nonaktif', 'nonAktif')->name('admin.userReject');
        });

        Route::get('/categories/get', [Backend\CategoryController::class, 'index']);
        Route::get('/posts/draft/{status}', [Api\PostController::class, 'getByStatus']);
        Route::resource('/publikasi', Api\PublikasiController::class);
        Route::post('/doc/publication', [Api\Admin\PublikasiController::class, 'index']);
        Route::resource('/naskah', Api\NaskahController::class);
        Route::post('/doc/script', [Api\Admin\NaskahController::class, 'index']);
        Route::resource('/gallery/photo', Api\GalleryController::class)->only('store', 'update', 'destroy');

        Route::resource('/founder', Api\Admin\FounderController::class);
        Route::resource('/structure', Api\Admin\StructureController::class);
        Route::resource('/coordinator', Api\Admin\CoordinatorController::class);
        Route::resource('/advisor', Api\Admin\AdvisorController::class);
        Route::resource('/leader', Api\Admin\LeaderController::class);
        Route::resource('/secretary', Api\Admin\SecretaryController::class);
        Route::resource('/treasurer', Api\Admin\TreasurerController::class);
        Route::resource('/coor-region', Api\Admin\CoorregionController::class);
        Route::resource('/relationship', Api\Admin\RelationController::class);
        Route::resource('/curriculum-coordinator', Api\Admin\CurriculumController::class);
        Route::resource('/declatter', Api\Admin\DecLatterController::class);
        Route::resource('visi-misi', Api\Admin\VisiController::class)->only('update');

        Route::resource('/kurikulum', Api\KurikulumController::class);
        Route::resource('/laporan', Api\LaporanController::class);
        Route::resource('/event', Api\EventController::class);
        Route::controller(Api\EventCategoryController::class)->group(function () {
            Route::post('/event/categories/evx', 'index');
            Route::post('/event/categories/store', 'store');
            Route::post('/event/categories/update', 'update');
        });

        Route::resource('/ad-art', Api\AdArtController::class);

        Route::post('/send/email', [Api\EmailController::class, 'index']);

        Route::controller(Api\Admin\AboutController::class)->group(function () {
            Route::post('/sejarah/{id}', 'update');
        });
        Route::resource('/admin/media', App\Http\Controllers\Backend\MediaController::class);

        //handle sendMail
        Route::post('/sendmail/verif-user', function (Request $request) {
            $data = [
                'no_anggota'   => $request->no_anggota,
                'password'    => $request->password
            ];

            Mail::to($request->email)->send(new EmailKonfirmasiAnggota($data));
        });

        Route::post('/sendmail/recjct-user', function (Request $request) {
            $data = [
                'message'   => $request->message,
            ];

            Mail::to($request->email)->send(new EmailTolakAnggota($data));
        });

        //STR
        Route::post('/sendmail/str/verif', function (Request $request) {
            $data = [
                'name'  => $request->name,
                'message' => $request->message,
            ];
            Mail::to($request->email)->send(new EmailKonfirmasiStr($data));
        });

        Route::post('/sendmail/str/reject', function (Request $request) {
            $data = [
                'name'  => $request->name,
                'message' => $request->message,
            ];
            Mail::to($request->email)->send(new EmailTolakStr($data));
        });

        //konfirmasi anggota
        Route::controller(Api\Admin\KonfirmasiAnggotaController::class)->group(function () {
            Route::post('/konfirmasi/anggota/{id}', 'konfirmasi_anggota');
        });

        Route::get('/visitor', [Api\Admin\VisitorController::class, 'index']);
    });
});

Route::prefix('user')->group(function () {
    Route::post('/list/active', [Api\User\UnivController::class, 'users']);
    Route::controller(Api\User\DocumentController::class)->group(function () {
        Route::post('/doc/publication', 'publication');
        Route::post('/doc/script', 'script');
        Route::post('/laporan', [Api\User\LaporanController::class, 'laporan']);
        Route::post('/kurikulum', [Api\User\KurikulumController::class, 'getKurikulum']);
    });

    Route::controller(Api\User\GalleryController::class)->group(function () {
        Route::post('/images', 'index');
        Route::post('/galleries', 'galeri');
        Route::get('/ad-art', [Api\User\AdArtController::class, 'index']);
    });

    Route::controller(Api\User\PostController::class)->group(function () {
        Route::post('/post/postindex', 'index');
        Route::post('/post/postnewsorevent', 'newsOrArticle');
        Route::get('/post/list', 'postList');
        Route::post('/last-post', 'lastpost');
        Route::post('/populer-post', 'postPopuler');
    });

    Route::controller(Api\User\AboutController::class)->group(function () {
        Route::get('/history', 'sejarah');
        Route::get('founder', 'founder');
        Route::get('/vision-msion', 'visionMision');
    });

    Route::controller(Api\User\EventController::class)->group(function () {
        Route::get('/event/list', 'index');
        Route::get('/event/{eventCategory:slug}', 'eventList');
        Route::get('/event/list/allcategories/{eventCategory:slug}', 'eventByCategories');
        Route::get('/event/last-event', 'lastEvent');
    });

    Route::controller(Api\User\RegisterAnggotaController::class)->group(function () {
        Route::post('/daftar/anggota-baru', 'store');
        Route::post('/daftar/anggota-lama', 'update');
    });

    //handle email user
    //STR
    Route::post('/str/send-mail', function (Request $request) {
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];
        Mail::to($request->email)->send(new EmailNotifSTR($data));
        Mail::to('kobi.biologi@gmail.com')->send(new EmailAdminNotofSTR);
    });

    Route::post('/anggota-baru/send-mail', function (Request $request) {
        Mail::to('kobi.biologi@gmail.com')->send(new RegisterMail);
    });
});



Route::resource('/list-anggota', Api\UnivController::class);

Route::get('/dokumen/{category_id}', [Api\User\DocumentController::class, 'getByCategory']);

Route::get('/getRegencies/{id}', [Api\User\IndoregionController::class, 'kabupaten']);
Route::get('/user/event/categories', [Api\User\EventCategoryController::class, 'index']);


//users method post
Route::post('/pengajuan-str', [Api\User\StrController::class, 'store']);
Route::post('/upload/file-str', [Api\User\StrController::class, 'uploadStr']);
Route::post('/user/getcategories', [Api\User\CategoryController::class, 'index']);

Route::prefix('user')->group(function () {



    Route::controller(Api\User\StructureController::class)->group(function () {
        Route::get('/decision-latter', 'decisionLatter');
        Route::get('/advisor/getadvisor', 'getAdvisor')->name('user.leader');
        Route::get('/chairman', 'getChairman');
        Route::get('/secretaries', 'getSecretaries');
        Route::get('/treasurer', 'getTeasurer');
        Route::get('/coorregion', 'getCoorregion');
        Route::get('/curriculum', 'getCurriculum');
        Route::get('/relationship', 'getRelationship');
    });
});
