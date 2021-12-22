<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotMerchant   
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
        if (!Auth::guard('merchant')->check()) {
            return redirect('merchant');
        }
        return $next($request);
    }
}
