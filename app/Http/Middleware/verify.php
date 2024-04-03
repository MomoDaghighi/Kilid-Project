<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verify
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
        $user = auth()->user();
        if(auth()->check()) {
            if ($user->phone_verified_at != null) {
                return $next($request);
            } else {
                return redirect('/verify');
            }
            
            // if($user->phone_verified_at != null)
            //     return $next($request);
        }
        // return $next($request);
    }
}
