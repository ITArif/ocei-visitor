<?php

namespace App\Http\Middleware;

use Closure;

class VisitorCheck
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
         $loggedData=session('role');
        if ($loggedData != null && $loggedData == 'visitor') {
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
