<?php

Route::get("token", "UserController@getToken");

Route::group(['middleware' => ['App\Http\Middleware\Authentication']], function () {
    Route::resource("events", "EventController",
        ['only' => ['index']]);
});