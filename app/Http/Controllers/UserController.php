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
     * @api {get} /tokens Request user token
     * @apiDescription Returns the user token. If the user doesn't exist, it creates the user and returns data anyway.
     * @apiName GetToken
     * @apiGroup User
     *
     * @apiHeader {String} X-Auth-Facebook-ID
     * @apiHeader {String} X-Auth-Facebook-Token
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
        $userid = $request->header('X-Auth-Facebook-ID');
        $token = $request->header('X-Auth-Facebook-Token');

        if (!$userid)
            return response()->api_invalid(["facebook_id" => ["El campo facebook_id es obligatorio."]]);

        if (!$token)
            return response()->api_invalid(["facebook_token" => ["El campo facebook_token es obligatorio."]]);

        $user = User::whereFacebookId($userid)->first();
        if (!$user) {
            $user = new User();
            $user->facebook_id = $userid;
            $user->facebook_token = $token;
            $user->save();
        }

        if (!$user->checkFacebookToken($token))
            return response()->api_forbidden();

        $user->generateToken();

        return response()->api_ok([
            "user_id" => $user->id,
            "token" => $user->token
        ]);
    }
}
