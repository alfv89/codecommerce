<?php

namespace CodeCommerce\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyRole
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->auth->user()->is_admin){
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
