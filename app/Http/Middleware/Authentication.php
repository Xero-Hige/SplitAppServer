<?php

namespace App\Http\Middleware;

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
        return $next($request);
    }
}
