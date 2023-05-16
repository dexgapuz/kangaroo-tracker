<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get(RouteServiceProvider::HOME, 'index');
        Route::get('/', 'index');
    });
});
