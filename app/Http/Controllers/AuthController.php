<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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
        \Log::info('=== CONNEXION DEBUG ===');
        \Log::info('User found: ' . $user->email);
        \Log::info('User type: ' . $user->type);
        \Log::info('User class: ' . get_class($user));
        
        // Vérifier auth() après login
        $authUser = auth()->user();
        \Log::info('Auth user class: ' . get_class($authUser));
        \Log::info('Auth user email: ' . $authUser->email);
        \Log::info('Auth user type: ' . $authUser->type);
        \Log::info('Has isAdmin method: ' . (method_exists($authUser, 'isAdmin') ? 'YES' : 'NO'));

        
        
        if (method_exists($authUser, 'isAdmin')) {
            \Log::info('isAdmin() result: ' . ($authUser->isAdmin() ? 'TRUE' : 'FALSE'));
        }
        
        // Test redirection
        if ($authUser->type === 'admin') {
            \Log::info('Redirecting to admin dashboard');
            return redirect()->route('admin.dashboard');
        } else {
            \Log::info('Redirecting to acteur dashboard');
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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'motDePasse' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'type' => 'acteur_touristique',
        ]);

        Auth::login($user);

        return redirect()->route('acteur.dashboard');
    }
}