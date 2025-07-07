<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\ActeurTouristique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function showLoginForm()
{
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('acteur.dashboard');
        }
    }

    return view('auth.login');
}

    public function login(Request $request)
{
    // ... validation existante ...

    $user = Utilisateur::where('email', $request->email)
                      ->where('is_active', true)
                      ->first();

    if ($user && Hash::check($request->password, $user->motDePasse)) {
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();
        
        // ✅ DEBUG COMPLET
        Log::info('=== CONNEXION DEBUG ===');
        Log::info('User found: ' . $user->email);
        Log::info('User type: ' . $user->type);
        Log::info('User class: ' . get_class($user));
        
        // Vérifier auth() après login
        $authUser = auth()->user();
        Log::info('Auth user class: ' . get_class($authUser));
        Log::info('Auth user email: ' . $authUser->email);
        Log::info('Auth user type: ' . $authUser->type);
        Log::info('Has isAdmin method: ' . (method_exists($authUser, 'isAdmin') ? 'YES' : 'NO'));

        
        
        if (method_exists($authUser, 'isAdmin')) {
            Log::info('isAdmin() result: ' . ($authUser->isAdmin() ? 'TRUE' : 'FALSE'));
        }
        
        // Test redirection
        if ($authUser->type === 'admin') {
            Log::info('Redirecting to admin dashboard');
            return redirect()->route('admin.dashboard');
        } else {
            Log::info('Redirecting to acteur dashboard');
            return redirect()->route('acteur.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis sont incorrects.',
    ])->withInput();
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',

            // Champs pour la table acteurs_touristiques
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string|max:255',
            'site_web' => 'nullable|url|max:255',
            'ville' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Création du compte utilisateur
        $user = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'motDePasse' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'type' => 'acteur_touristique',
        ]);

        // Création de l'acteur touristique associé
        ActeurTouristique::create([
            'utilisateur_id' => $user->id,
            'nom_entreprise' => $request->nom_entreprise,
            'description' => $request->description,
            'adresse' => $request->adresse,
            'site_web' => $request->site_web,
            'ville' => $request->ville,
            'reseaux_sociaux' => [
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
            ],
        ]);

        Auth::login($user);

        return redirect()->route('acteur.dashboard');
    }
}