<?php

Route::get("tokens", "UserController@getToken");

Route::group(['middleware' => ['App\Http\Middleware\Authentication']], function () {
    Route::resource("events", "EventController",
        ['only' => ['show', 'index']]);
});