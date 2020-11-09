<?php

namespace App\Http\Middleware;

use Closure;

class Check_User_Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('user')) {
            return $next($request);
        } else {
            return redirect(route('web.user.login_page'));
        }
    }
}
