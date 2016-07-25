<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * @apiVersion 0.0.1
     *
     * @api {get} /token Request user token
     * @apiDescription Returns the user token. If the user doesn't exist, it creates the user and returns data anyway.
     * @apiName GetToken
     * @apiGroup User
     *
     * @apiParam {String} facebook_id
     * @apiParam {String} facebook_token
     *
     * @apiSuccess {Int} user_id
     * @apiSuccess {String} token
     * @apiSuccessExample {json} Success response
     * {
     *  "data": {"user_id": 1, "token": "sdsjakldasjdaldkj"},
     *  "errors": []
     * }
     */
    public function getToken(Request $request) {
        if (!$request->input("facebook_id"))
            return response()->api_invalid(["facebook_id" => ["El campo facebook_id es obligatorio."]]);

        if (!$request->input("facebook_token"))
            return response()->api_invalid(["facebook_token" => ["El campo facebook_token es obligatorio."]]);

        $user = User::whereFacebookId($request->input("facebook_id"))->first();
        if (!$user)
            return response()->api_not_found(["facebook_id"]);

        if (!$user->checkFacebookToken($request->input("facebook_token")))
            return response()->api_forbidden();

        $user->generateToken();

        return response()->api_ok([
            "user_id" => $user->id,
            "token" => $user->token
        ]);
    }
}
