<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// root
Route::get('/', function () {
    return view('index');
});

// posts
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});
