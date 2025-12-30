<?php

use Illuminate\Support\Facades\Route;

// ルート
Route::get('/', function () {
    return view('index');
});
