<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

//--- post ---------------------------------------------
Route::middleware(['auth'])->group(function () {
    // ルート
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    // 投稿一覧追加取得
    Route::get('/posts/load', [PostController::class, 'load'])
        ->name('posts.load');

    Route::resource('posts', PostController::class)->except(['index']);
});

//--- tags ---------------------------------------------------
// タグ毎投稿一覧
Route::get('/tags/{tag}', [TagController::class, 'show'])
    ->name('tags.show');

// タグ毎投稿一覧追加取得
Route::get('/tags/{tag}/posts/load', [TagController::class, 'load'])
    ->name('tags.posts.load');
