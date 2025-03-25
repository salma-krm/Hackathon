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

        if (!$user || $user->role !== 'organisateur') {
            return redirect('/hackathoncreate')->with('error', 'Vous devez être un organisateur pour accéder à cette page.');
        }

        return $next($request);
    }
}


