<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CustomerAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customers')->check()) {
            // Redirect to the customer login page if the customer is not authenticated
            return redirect()->route('customer-login');
        }
        return $next($request);

    }

}

