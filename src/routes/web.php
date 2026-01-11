<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

//--- 投稿 ---------------------------------------------
Route::middleware(['auth'])->group(function () {
    // ルート
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    // 投稿一覧追加取得
    Route::get('/posts/load', [PostController::class, 'load'])
        ->name('posts.load');

    Route::resource('posts', PostController::class)->except(['index']);
});

//--- タグ ---------------------------------------------------
// タグ毎投稿一覧
Route::get('/tags/{tag}', [TagController::class, 'show'])
    ->name('tags.show');

// タグ毎投稿一覧追加取得
Route::get('/tags/{tag}/posts/load', [TagController::class, 'load'])
    ->name('tags.posts.load');

//--- コメント ---------------------------------------------------
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

//--- ユーザー ---------------------------------------------------
Route::resource('users', UserController::class)->only(['show']);
