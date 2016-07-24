<?php namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider {

    /**
     * Register response helpers for the API.
     * An error response should always return an empty data object.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api_ok', function($data)
        {
            return Response::make(
                array("data" => $data, "errors" => array()),
                200,
                array("Content-Type" => "application/json"));
        });
        Response::macro('api_error', function($errors = array())
        {
            return Response::make(
                array("data" => (object) array(), "errors" => $errors),
                500,
                array("Content-Type" => "application/json"));
        });
        Response::macro('api_not_found', function($errors = array())
        {
            return Response::make(
                array("data" => (object) array(), "errors" => $errors),
                404,
                array("Content-Type" => "application/json"));
        });
        Response::macro('api_forbidden', function($errors = array())
        {
            return Response::make(
                array("data" => (object) array(), "errors" => $errors),
                403,
                array("Content-Type" => "application/json"));
        });
        Response::macro('api_unauthorized', function($errors = array())
        {
            return Response::make(
                array("data" => (object) array(), "errors" => array("El usuario y token no corresponden a un usuario.")),
                401,
                array("Content-Type" => "application/json"));
        });
        Response::macro('api_invalid', function($errors = array())
        {
            return Response::make(
                array("data" => (object) array(), "errors" => $errors),
                422,
                array("Content-Type" => "application/json"));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}