<?php

namespace App\Http\Middleware;

use App\Http\Helper\JsendHelper;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $jsend = new JsendHelper();
        if ($this->auth->guard($guard)->guest() || empty($request->bearerToken())) {
            
            return $jsend->jsend_error('Unauthorized', null, null, 401);
        }

        return $next($request);
    }
}
