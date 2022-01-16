<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
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
        $loggedData=session('role_id');
        if ($loggedData != null && $loggedData == 1) {
            return $next($request);
        }elseif($loggedData != null && $loggedData == 9){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
