<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('admin/auth/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::post('/auth/admin/logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
});

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     //Admin method reoursce

// });
Route::controller(\App\Http\Controllers\Api\Admin\StrController::class)->group(function () {
    Route::get('/admin/str/', 'index');
    Route::get('/admin/str/show/{id}', 'strShow');
    Route::post('/admin/str/update/{id}', 'strUpdate');
    Route::get('/admin/str/verif', 'strVerif');
    Route::get('/admin/str/reject', 'strReject');
    Route::delete('/admin/str/destroy/{id}', 'strDestroy');
});

Route::middleware(['auth' => 'apiAdmim'])->group(function () {
    //
});

Route::resource('/admin/media', App\Http\Controllers\Backend\MediaController::class);
Route::resource('/admin/posts', App\Http\Controllers\Api\PostController::class);
Route::resource('/admin/categories', \App\Http\Controllers\Api\CategoryController::class);

//Api Admin
Route::get('/admin/users', [\App\Http\Controllers\Api\Admin\UserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/active', [\App\Http\Controllers\Api\Admin\UserController::class, 'userActive'])->name('admin.userActive');
Route::get('/admin/categories/get', [\App\Http\Controllers\Backend\CategoryController::class, 'index']);
Route::get('/admin/posts/draft/{status}', [\App\Http\Controllers\Api\PostController::class, 'getByStatus']);
Route::resource('/admin/publikasi', \App\Http\Controllers\Api\PublikasiController::class);
Route::resource('/admin/naskah', \App\Http\Controllers\Api\NaskahController::class);
Route::resource('/admin/gallery/photo', \App\Http\Controllers\Api\GalleryController::class)->only('store', 'update', 'destroy');

Route::prefix('admin')->group(function () {
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
});

Route::resource('/list-anggota', \App\Http\Controllers\Api\UnivController::class);
Route::resource('/admin/ad-art', \App\Http\Controllers\Api\AdArtController::class);
Route::get('/user/ad-art', [App\Http\Controllers\Api\AdArtController::class, 'userIndex']);
Route::resource('/admin/kurikulum', \App\Http\Controllers\Api\KurikulumController::class);
Route::resource('/admin/laporan', \App\Http\Controllers\Api\LaporanController::class);
Route::resource('/admin/event', \App\Http\Controllers\Api\EventController::class);
Route::resource('/admin/event/categories/evx', \App\Http\Controllers\Api\EventCategoryController::class);

//users method get
Route::get('/dokumen/{category_id}', [Api\User\DocumentController::class, 'getByCategory']);
Route::get('/laporan', [Api\User\LaporanController::class, 'laporan']);
Route::get('/getRegencies/{id}', [Api\User\IndoregionController::class, 'kabupaten']);
Route::get('/user/event/categories', [\App\Http\Controllers\Api\User\EventCategoryController::class, 'index']);

Route::get('/user/images', [Api\User\GalleryController::class, 'index']);

//users method post
Route::post('/pengajuan-str', [Api\User\StrController::class, 'store']);
Route::post('/upload/file-str', [Api\User\StrController::class, 'uploadStr']);
Route::post('/user/getcategories', [Api\User\CategoryController::class, 'index']);

Route::prefix('user')->group(function () {
    Route::controller(Api\User\AboutController::class)->group(function () {
        Route::get('/history', 'sejarah');
        Route::get('founder', 'founder');
        Route::get('/vision-msion', 'visionMision');
    });
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

Route::controller(Api\User\PostController::class)->group(function () {
    Route::get('/user/post/postindex', 'index');
    Route::get('/user/post/postnewsorevent', 'newsOrArticle');
    Route::get('/user/post/list', 'postList');
    Route::get('/user/last-post', 'lastpost');
});

Route::controller(Api\User\EventController::class)->group(function () {
    Route::get('/user/event/list', 'index');
    Route::get('/user/event/{eventCategory:slug}', 'eventList');
    Route::get('/event/list/allcategories/{eventCategory:slug}', 'eventByCategories');
    Route::get('/user/event/last-event', 'lastEvent');
});

Route::controller(\App\Http\Controllers\Api\Admin\AboutController::class)->group(function () {
    Route::post('/admin/sejarah/{id}', 'update');
});

Route::post('/admin/send/email', [\App\Http\Controllers\Api\EmailController::class, 'index']);
