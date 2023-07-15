<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnssureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->roles()->where('name', $role)->exists()) {
            return $next($request);
        }
        
        // Return a response indicating the user is not authorized to access the resource
        $message = 'You are not authorized to access this resource.';
        return redirect()->back()->with('alert', $message);
    }
    
}
