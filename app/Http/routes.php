<?php

Route::get("tokens", "UserController@getToken");

Route::group(['middleware' => ['App\Http\Middleware\Authentication']], function () {
    Route::resource("events", "EventController",
        ['only' => ['show', 'index', 'store', 'update', 'destroy']]);

    Route::resource("events.tasks", "EventTaskController",
        ['only' => ['store', 'update']]);

    Route::resource("events.invitees", "EventInviteeController",
        ['only' => ['store']]);

    Route::resource("eventTemplates", "EventTemplateController",
        ['only' => ['index', 'store']]);
});