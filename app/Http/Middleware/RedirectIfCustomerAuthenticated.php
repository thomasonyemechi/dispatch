<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCustomerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $guard = 'customers'): Response
    {
        if (\Auth::guard($guard)->check()) {
            // If the customer is logged in, redirect them back
            return redirect()->route('customer.view-orders');
        }
        return $next($request);
    }
}
