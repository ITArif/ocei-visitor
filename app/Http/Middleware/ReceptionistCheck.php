<?php

namespace App\Http\Middleware;

use Closure;

class ReceptionistCheck
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
        if ($loggedData != null && $loggedData == 'receptionist') {
            return $next($request);
        }else{
            return redirect('/receptionists-dashboard');
        }
    }
}
