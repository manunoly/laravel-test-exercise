<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateWithBearerToken extends Middleware
{

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null  $guard
     * @param  string|null  $field
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function handle($request, Closure $next, $guard = null, $field = null)
    {
        $token = $request->bearerToken();
        if ($token === env('DUMMY_TOKEN', '')) {
            return $next($request);
        }
        return response()->json([
            'message' => 'Forbidden'
        ], 403);
    }
}
