<?php

namespace App\Http\Middleware;

use Closure;

class Check_Admin_Login
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
        if (session('admin')) {
            return $next($request);
        } else {
            return redirect(route('admin.index'));
        }
    }
}
