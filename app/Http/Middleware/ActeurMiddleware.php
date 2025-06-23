<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActeurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Vérifier si l'utilisateur est un acteur touristique
        if (!auth()->user()->isActeurTouristique()) {
            return redirect()->route('login')->with('error', 'Accès non autorisé. Seuls les acteurs touristiques peuvent accéder à cette section.');
        }

        // Vérifier si le compte est actif
        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Votre compte a été désactivé. Contactez un administrateur.');
        }

        return $next($request);
    }
}