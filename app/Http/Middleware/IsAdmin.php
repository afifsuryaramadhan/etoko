<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->roles == 'admin')
        {
            return $next($request);
        }
        // else if (Auth::user()->roles == 'TOKO')
        // {
        //     return $next($request);
        // }
        else{
            return redirect('/');
        }

    }
}
