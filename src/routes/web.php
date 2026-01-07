<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// posts
Route::middleware(['auth'])->group(function () {
    // ルート
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    // 投稿一覧追加取得
    Route::get('/posts/load', [PostController::class, 'load'])
        ->name('posts.load');

    Route::resource('posts', PostController::class)->except(['index']);
});
