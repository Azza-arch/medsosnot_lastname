<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/user/{id}', [UserController::class, 'show']);

// News routes
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'showNews'])->name('news');
    Route::get('/newsmy', [NewsController::class, 'showmy'])->name('newsmy');
    Route::post('/store', [NewsController::class, 'storenews'])->name('storenews');
    Route::delete('/delete/{id}', [NewsController::class, 'deletenews'])->name('delete');
});

// Comment routes
Route::get('/{news_id}/comment', [CommentController::class, 'show'])->name('comment');
Route::post('/storecomment', [CommentController::class, 'storecomment'])->name('storecomment');

// Follower routes
Route::post('/storefollow', [FollowerController::class, 'storefollow'])->name('storefollow');
Route::delete('/unfollow/{id}', [FollowerController::class, 'destroy'])->name('unfollow');

// Like routes
Route::post('/like', [LikeController::class, 'like'])->name('like');
Route::delete('/unlike/{id}', [LikeController::class, 'unlike'])->name('unlike');


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
