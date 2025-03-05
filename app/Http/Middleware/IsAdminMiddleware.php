<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('inside the middleware');
        
        if (session()->has('email')) {

            if (session()->get('role') == 1) {

                return $next($request);
            }
            return redirect('/Admindashboard');
        }
        return redirect('/login');

    }
}
