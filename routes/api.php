<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

Route::post('admin/auth/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::post('/auth/admin/logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
});
Route::resource('/list-anggota', \App\Http\Controllers\Api\UnivController::class);


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

//Admin method reoursce
Route::controller(\App\Http\Controllers\Api\Admin\StrController::class)->group(function () {
    Route::get('/admin/str/', 'index');
    Route::get('/admin/str/show/{id}', 'strShow');
    Route::post('/admin/str/update/{id}', 'strUpdate');
    Route::get('/admin/str/verif', 'strVerif');
    Route::get('/admin/str/reject', 'strReject');
    Route::delete('/admin/str/destroy/{id}', 'strDestroy');
});


Route::resource('/admin/ad-art', \App\Http\Controllers\Api\AdArtController::class);
Route::get('/user/ad-art', [App\Http\Controllers\Api\AdArtController::class, 'userIndex']);
Route::resource('/admin/kurikulum', \App\Http\Controllers\Api\KurikulumController::class)->only('index', 'update');
Route::resource('/admin/laporan', \App\Http\Controllers\Api\LaporanController::class);
Route::resource('/admin/event', \App\Http\Controllers\Api\EventController::class);
Route::resource('/admin/event/categories/evx', \App\Http\Controllers\Api\EventCategoryController::class);

//users method get
Route::get('/dokumen/{category_id}', [Api\User\DocumentController::class, 'getByCategory']);
Route::get('/laporan', [Api\User\LaporanController::class, 'laporan']);
Route::get('/getRegencies/{id}', [Api\User\IndoregionController::class, 'kabupaten']);
Route::get('/user/event/categories', [\App\Http\Controllers\Api\User\EventCategoryController::class, 'index']);

//users method post
Route::post('/pengajuan-str', [Api\User\StrController::class, 'store']);
Route::post('/upload/file-str', [Api\User\StrController::class, 'uploadStr']);
Route::post('/user/getcategories', [Api\User\CategoryController::class, 'index']);

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

Route::post('/admin/send/email', [\App\Http\Controllers\Api\EmailController::class, 'index']);
