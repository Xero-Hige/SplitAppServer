<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * @api {get} /token Request user token
     *
     * @apiParam {String} facebook_id
     * @apiParam {String} facebook_token
     *
     * @apiSuccess {Int} user_id
     * @apiSuccess {String} token
     */
    public function getToken(Request $request) {
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
