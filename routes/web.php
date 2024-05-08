<?php

use App\Http\Controllers\DatarfidController;
use Illuminate\Support\Facades\Route;


Route::get('/',                               [DatarfidController::class, 'index']);
Route::post('/pencarian-simpkbdb',            [DatarfidController::class, 'pencarian_simpkbdb']);
Route::get('/reload-captcha',                 [DatarfidController::class, 'reloadCaptcha']);
