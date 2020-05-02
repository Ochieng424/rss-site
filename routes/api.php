<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/register', 'API\AuthController@register');
    Route::post('auth/login', 'API\AuthController@login');

    Route::group(['middleware' => 'jwt.refresh'], function(){
        Route::get('auth/refresh', 'API\AuthController@refresh');
    });

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::get('auth/user', 'API\AuthController@user');
        Route::post('auth/logout', 'API\AuthController@logout');
    });
});
