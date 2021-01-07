<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAge
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
//        if(!isset(Auth::user()->id)) {
//            return  redirect()->route('login');
//        }
//       $age =  Auth::user()->age;
//        if($age < 18) {
//            return  redirect()->route('home');
//        }
        return $next($request);
    }
}
