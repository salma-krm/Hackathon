<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth; 

class User
{
    public function handle(Request $request, Closure $next)

    {
        $user = JWTAuth::user();
        if (auth()->check() && $user->role === 'organisateur') {
         
            return $next($request);
        }
        return back();
    }        
      
}


