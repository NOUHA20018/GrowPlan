<?php

namespace App\Http\Middleware;

use App\Http\Requests\UserTypes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class FormateurMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 2){
            return $next($request);
        }

        return redirect('/')->with('error', "Accès refusé !");
    }
}
