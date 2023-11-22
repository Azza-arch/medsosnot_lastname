<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FollowerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/user/{id}', [UserController::class, 'show']);

// News routes
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'showNews'])->name('news');
    Route::get('/lo', [NewsController::class, 'showmy'])->name('newsmy');
    Route::post('/store', [NewsController::class, 'storenews'])->name('storenews');
    Route::delete('/delete/{id}', [NewsController::class, 'deletenews'])->name('delete');
    Route::get('/{news_id}/comment', [CommentController::class, 'show'])->name('comment');
});

// Comment routes
Route::post('/storecomment', [CommentController::class, 'storecomment'])->name('storecomment');

// Follower routes
Route::get('/showspro', [FollowerController::class, 'shows'])->name('showspro');
Route::post('/storefollow', [FollowerController::class, 'storefollow'])->name('storefollow');
Route::delete('/unfollow/{id}', [FollowerController::class, 'destroy'])->name('unfollow');


// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
