<?php

namespace App\Http\Middleware;

use Closure;

class Check_Cart_Exist
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
        if (count(session('cart')) > 0) {
            return $next($request);
        } else {
            return redirect(route('web.cart'));
        }
    }
}
