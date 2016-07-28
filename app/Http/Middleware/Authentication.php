<?php

namespace App\Http\Middleware;
use App\Http\Requests\Request;
use Log;
use Closure;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class Authentication
{
    use ValidatesRequests;
    
    public function handle($request, Closure $next)
    {
        Log::debug("[".$request->method()."] ".$request->url().PHP_EOL.print_r($request->all(), TRUE).PHP_EOL."X-Auth-Facebook-ID: ".$request->header('X-Auth-Facebook-ID')." X-Auth-Token: ".$request->header('X-Auth-Token').PHP_EOL);

        $userid = $request->header('X-Auth-Facebook-ID');
        $token = $request->header('X-Auth-Token');

        if (!$token)
            return response()->api_invalid(["auth_token" => ["El header X-Auth-Token es obligatorio."]]);
        if (!$userid)
            return response()->api_invalid(["auth_userid" => ["El header X-Auth-Facebook-ID es obligatorio."]]);

        /**
         * @var User $user
         */
        $user = User::whereFacebookId($userid)->get()->first();

        if ($user == NULL)
            return response()->api_unauthorized();

        if ($token == $user->token) {
            auth()->login($user);
            return $next($request);
        } else {
            return response()->api_unauthorized();
        }
    }
}
