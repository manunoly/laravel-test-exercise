<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateWithBasicAuth extends Middleware
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
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $serverAuthUser = $_SERVER['PHP_AUTH_USER'] ?? '';
        $serverAuthPw = $_SERVER['PHP_AUTH_PW'] ?? '';
        if ($serverAuthUser == 'welove@code.com' && Hash::check($serverAuthPw, env('DUMMY_PASS', ''))) {
            return $next($request);
        }
        header('HTTP/1.1 401 Authorization Required');
        header('WWW-Authenticate: Basic realm="Access denied"');
        exit;
    }
}
