<?php

use App\Http\Controllers\Api\LikeController;
use Illuminate\Support\Facades\Route;

// いいねAPI
Route::post('/posts/{post}/likes', [LikeController::class, 'toggle']);
