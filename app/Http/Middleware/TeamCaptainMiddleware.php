<?php

namespace App\Http\Middleware;

use Closure;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeamCaptainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if(CheckIds::checkRoleId() === 2) {
                return $next($request);
            } else {
                return redirect('/')->with('error', 'Az belépés megtagadva');
            }
        } else {
            return redirect('/login')->with('error', 'A menüponthoz be kell lépnie');
        }

        return $next($request);
    }
}
