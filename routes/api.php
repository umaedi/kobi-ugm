<?php

use App\Http\Controllers\Api;
use App\Mail\EmailStr;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        });
        Route::resource('/posts', App\Http\Controllers\Api\PostController::class);
        Route::resource('/categories', \App\Http\Controllers\Api\CategoryController::class);

        Route::controller(\App\Http\Controllers\Api\Admin\UserController::class)->group(function () {
            Route::get('/users', 'index')->name('admin.users');
            Route::post('/users/active', 'userActive')->name('admin.userActive');
            Route::get('/users/reject', 'userReject')->name('admin.userReject');
        });

        Route::get('/categories/get', [\App\Http\Controllers\Backend\CategoryController::class, 'index']);
        Route::get('/posts/draft/{status}', [\App\Http\Controllers\Api\PostController::class, 'getByStatus']);
        Route::resource('/publikasi', \App\Http\Controllers\Api\PublikasiController::class);
        Route::resource('/naskah', \App\Http\Controllers\Api\NaskahController::class);
        Route::resource('/gallery/photo', \App\Http\Controllers\Api\GalleryController::class)->only('store', 'update', 'destroy');

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

        Route::resource('/kurikulum', \App\Http\Controllers\Api\KurikulumController::class);
        Route::resource('/laporan', \App\Http\Controllers\Api\LaporanController::class);
        Route::resource('/event', \App\Http\Controllers\Api\EventController::class);
        Route::resource('/event/categories/evx', \App\Http\Controllers\Api\EventCategoryController::class);

        Route::resource('/ad-art', \App\Http\Controllers\Api\AdArtController::class);

        Route::post('/send/email', [\App\Http\Controllers\Api\EmailController::class, 'index']);

        Route::controller(\App\Http\Controllers\Api\Admin\AboutController::class)->group(function () {
            Route::post('/sejarah/{id}', 'update');
        });
        Route::resource('/admin/media', App\Http\Controllers\Backend\MediaController::class);
    });
});

Route::prefix('user')->group(function () {
    Route::post('/list/active', [Api\User\UnivController::class, 'users']);
    Route::controller(Api\User\GalleryController::class)->group(function () {
        Route::post('/images', 'index');
        Route::post('/galleries', 'galeri');
        Route::get('/ad-art', [App\Http\Controllers\Api\AdArtController::class, 'userIndex']);
    });

    Route::controller(Api\User\PostController::class)->group(function () {
        Route::post('/post/postindex', 'index');
        Route::get('/post/postnewsorevent', 'newsOrArticle');
        Route::get('/post/list', 'postList');
        Route::get('/last-post', 'lastpost');
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
});



Route::resource('/list-anggota', \App\Http\Controllers\Api\UnivController::class);

Route::get('/dokumen/{category_id}', [Api\User\DocumentController::class, 'getByCategory']);
Route::get('/laporan', [Api\User\LaporanController::class, 'laporan']);
Route::get('/getRegencies/{id}', [Api\User\IndoregionController::class, 'kabupaten']);
Route::get('/user/event/categories', [\App\Http\Controllers\Api\User\EventCategoryController::class, 'index']);


//users method post
Route::post('/pengajuan-str', [Api\User\StrController::class, 'store']);
Route::post('/upload/file-str', [Api\User\StrController::class, 'uploadStr']);
Route::post('/user/getcategories', [Api\User\CategoryController::class, 'index']);

Route::prefix('user')->group(function () {

    Route::get('/kurikulum', [Api\User\KurikulumController::class, 'getKurikulum']);

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





Route::post('/user/str/send-mail', function (Request $request) {
    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];
    Mail::to($request->email)->send(new EmailStr($data));
});
