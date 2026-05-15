<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role == 'superadmin') {
                return redirect('admin/dashboard');
            }

            if ($role == 'librarian') {
                return redirect('librarian/dashboard');
            }

            if ($role == 'patron') {
                return redirect('patron/dashboard');
            }
        }

        return $next($request);
    }
}
