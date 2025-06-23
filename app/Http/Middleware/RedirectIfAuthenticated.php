<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            \Log::info('=== GUEST MIDDLEWARE TRIGGERED ===');
            \Log::info('User is authenticated, redirecting from guest route');
            
            $user = Auth::guard($guard)->user();
            \Log::info('User type: ' . $user->type);
            
            // ✅ Redirection selon le type d'utilisateur
            if ($user->type === 'admin') {
                \Log::info('Redirecting to admin dashboard from guest middleware');
                return redirect('/admin/dashboard');
            } else {
                \Log::info('Redirecting to acteur dashboard from guest middleware');
                return redirect('/acteur/dashboard');
            }
        }
    }

    return $next($request);
}
}
