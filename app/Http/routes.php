<?php

Route::get("token", "UserController@getToken");

Route::group(['middleware' => ['App\Http\Middleware\Authentication']], function () {
    
});