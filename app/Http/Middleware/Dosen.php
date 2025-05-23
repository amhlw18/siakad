<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/');
        }

//        if (Auth::user()->role == 1 || Auth::user()->role == 3 ||  Auth::user()->role == 5 || Auth::user()->role == 6 ) {
//            return $next($request);
//        }else{
//            return redirect('/dashboard');
//        };

        if (Auth::user()->role == 3 ) {
            return $next($request);
        }else{
            return redirect('/dashboard');
        };
    }
}
