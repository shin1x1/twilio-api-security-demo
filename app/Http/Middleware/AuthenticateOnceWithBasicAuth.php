<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Factory;

class AuthenticateOnceWithBasicAuth
{
    /**
     * @var Factory|AuthManager|SessionGuard
     */
    private $auth;

    /**
     * AuthenticateOnceWithBasicAuth constructor.
     * @param Factory $auth
     */
    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->auth->onceBasic() ?: $next($request);
    }

}