<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Utilisateur;
use App\Models\ActeurTouristique;
use App\Models\InfrastructureTouristique;
use App\Models\RaContenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Dashboard principal admin
     */
    public function dashboard()
    {
        Log::info('=== DASHBOARD DEBUG ===');
        Log::info('Auth check: ' . (auth()->check() ? 'TRUE' : 'FALSE'));
        Log::info('Auth user: ' . (auth()->user() ? auth()->user()->email : 'NULL'));
        Log::info('Session ID: ' . session()->getId());
        Log::info('Session data: ' . json_encode(session()->all()));

        // Statistiques principales
        $stats = [
            'total_users' => Utilisateur::count(),
            'active_users' => Utilisateur::where('is_active', true)->count(),
            'active_infrastructures' => InfrastructureTouristique::where('is_active', true)->count(),
            'active_acteurs' => ActeurTouristique::whereHas('utilisateur', fn($q) => $q->where('is_active', true))->count(),
            'total_acteurs' => ActeurTouristique::count(),
            'total_infrastructures' => InfrastructureTouristique::count(),
            'total_contenus' => RaContenu::count(),
            'taux_activite' => $this->calculateActivityRate(),
            'croissance' => $this->calculateGrowth(),
        ];

        // Données pour les graphiques
        $chartData = [
            'activity' => $this->getActivityData(30),
            'infrastructure_types' => $this->getInfrastructureTypeData(),
        ];

        // Listes récentes
        $recentActeurs = ActeurTouristique::with('utilisateur')
                                         ->latest()
                                         ->take(5)
                                         ->get();

        $recentInfrastructures = InfrastructureTouristique::with('acteurTouristique')
                                                         ->latest()
                                                         ->take(5)
                                                         ->get();

        return view('admin.dashboard', compact('stats', 'recentActeurs', 'recentInfrastructures', 'chartData'));
    }

    /**
     * Calculer le taux d'activité
     */
    private function calculateActivityRate()
    {
        $total = ActeurTouristique::count();
        $active = ActeurTouristique::whereHas('utilisateur', fn($q) => $q->where('is_active', true))->count();
        
        return $total > 0 ? round(($active / $total) * 100) : 0;
    }

    /**
     * Calculer le taux de croissance
     */
    private function calculateGrowth()
    {
        $currentMonth = ActeurTouristique::whereMonth('created_at', now()->month)->count();
        $lastMonth = ActeurTouristique::whereMonth('created_at', now()->subMonth()->month)->count();
        
        return $lastMonth > 0 ? round(($currentMonth - $lastMonth) / $lastMonth * 100) : ($currentMonth > 0 ? 100 : 0);
    }

    /**
     * Données d'activité pour le graphique
     */
    private function getActivityData($days = 30)
    {
        $labels = [];
        $inscriptions = [];
        $infrastructures = [];

        for ($i = $days; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');
            
            $inscriptions[] = Utilisateur::whereDate('created_at', $date)->count();
            $infrastructures[] = InfrastructureTouristique::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $labels,
            'inscriptions' => $inscriptions,
            'infrastructures' => $infrastructures
        ];
    }

    /**
     * Données des types d'infrastructures
     */
    private function getInfrastructureTypeData()
    {
        $types = InfrastructureTouristique::select('type')
            ->selectRaw('count(*) as count')
            ->groupBy('type')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->type => $item->count];
            });

        return [
            'labels' => $types->keys(),
            'data' => $types->values()
        ];
    }

    public function users()
    {
        $users = Utilisateur::with('acteurTouristique')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'motDePasse' => 'required|min:6|confirmed',
            'telephone' => 'nullable|string|max:20',
            'type' => 'required|in:admin,acteur_touristique',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'motDePasse' => Hash::make($request->motDePasse),
            'telephone' => $request->telephone,
            'type' => $request->type,
            'is_active' => true,
        ]);

        // Si c'est un acteur touristique, créer le profil associé
        if ($request->type === 'acteur_touristique') {
            ActeurTouristique::create([
                'utilisateur_id' => $user->id,
                'nom_entreprise' => $request->nom_entreprise ?? $request->nom,
                'type_acteur' => $request->type_acteur ?? 'autre',
                'description' => $request->description,
                'adresse' => $request->adresse,
                'site_web' => $request->site_web,
                'is_verified' => false,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
    }

    public function editUser(Utilisateur $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, Utilisateur $user)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $user->id,
            'motDePasse' => 'nullable|min:6|confirmed',
            'telephone' => 'nullable|string|max:20',
            'type' => 'required|in:admin,acteur_touristique',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('motDePasse')) {
            $data['motDePasse'] = Hash::make($request->motDePasse);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroyUser(Utilisateur $user)
    {
        // Empêcher la suppression du dernier admin
        if ($user->isAdmin() && Utilisateur::where('type', 'admin')->count() <= 1) {
            return back()->with('error', 'Impossible de supprimer le dernier administrateur.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Gestion des acteurs touristiques
     */
    public function acteurs()
    {
        $acteurs = ActeurTouristique::with('utilisateur')->paginate(15);
        return view('admin.acteurs.index', compact('acteurs'));
    }

    /**
     * Gestion des infrastructures
     */
    public function infrastructures()
    {
        $infrastructures = InfrastructureTouristique::with('acteurTouristique.utilisateur')->paginate(15);
        $acteurs = ActeurTouristique::with('utilisateur')->paginate(15);
        return view('admin.infrastructures.index', compact('infrastructures', 'acteurs'));
    }

    /**
     * Gestion des contenus RA
     */
    public function contenus()
    {
        $contenus = RaContenu::with('infrastructure.acteurTouristique.utilisateur')->paginate(15);
        return view('admin.contenus.index', compact('contenus'));
    }

    /**
     * Analytics et statistiques
     */
    public function analytics()
    {
        $analytics = [
            'users_by_month' => Utilisateur::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->pluck('count', 'month'),
            'infrastructures_by_type' => InfrastructureTouristique::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type'),
            'acteurs_by_type' => ActeurTouristique::selectRaw('type_acteur, COUNT(*) as count')
                ->groupBy('type_acteur')
                ->pluck('count', 'type_acteur'),
        ];

        return view('admin.analytics', compact('analytics'));
    }



    /**
     * Afficher la liste des infrastructures
     */
    public function infrastructuresIndex(Request $request)
    {
        $query = InfrastructureTouristique::with(['acteurTouristique.utilisateur']);

        // Filtrage par recherche
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%')
                ->orWhereHas('acteurTouristique.utilisateur', function ($subQ) use ($request) {
                    $subQ->where('nom', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            });
        }

        // Filtrage par type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtrage par statut
        if ($request->filled('status')) {
            $query->whereHas('acteurTouristique.utilisateur', function ($q) use ($request) {
                if ($request->status === 'active') {
                    $q->where('is_active', true);
                } elseif ($request->status === 'inactive') {
                    $q->where('is_active', false);
                }
            });
        }

        // Filtrage par acteur
        if ($request->filled('acteur')) {
            $query->where('acteur_touristique_id', $request->acteur);
        }

        // Tri (par défaut le plus récent)
        switch ($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nom', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nom', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $infrastructures = $query->paginate(15);
        $acteurs = ActeurTouristique::all();

        return view('admin.infrastructures.index', compact('infrastructures', 'acteurs'));
    }


    /**
     * Afficher une infrastructure
     */
    public function infrastructuresShow(InfrastructureTouristique $infrastructure)
    {
        $infrastructure->load(['acteurTouristique.utilisateur']);
        return view('admin.infrastructures.show', compact('infrastructure'));
    }

    /**
     * Basculer le statut d'une infrastructure
     */
    public function infrastructuresToggleStatus(InfrastructureTouristique $infrastructure)
    {
        $infrastructure->update([
            'is_active' => !$infrastructure->is_active
        ]);

        return back()->with('success', 'Statut de l\'infrastructure mis à jour avec succès.');
    }

    /**
     * Supprimer une infrastructure
     */
    public function infrastructuresDestroy(InfrastructureTouristique $infrastructure)
    {
        $infrastructure->delete();
        return back()->with('success', 'Infrastructure supprimée avec succès.');
    }

    /**
     * Actions en lot sur les infrastructures
     */
    public function infrastructuresBulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'infrastructure_ids' => 'required|array',
            'infrastructure_ids.*' => 'exists:infrastructures,id'
        ]);

        $infrastructures = InfrastructureTouristique::whereIn('id', $request->infrastructure_ids);

        switch ($request->action) {
            case 'activate':
                $infrastructures->update(['is_active' => true]);
                $message = 'Infrastructures activées avec succès.';
                break;
            case 'deactivate':
                $infrastructures->update(['is_active' => false]);
                $message = 'Infrastructures désactivées avec succès.';
                break;
            case 'delete':
                $infrastructures->delete();
                $message = 'Infrastructures supprimées avec succès.';
                break;
        }

        return back()->with('success', $message);
    }

    public function acteursIndex(Request $request)
    {
        $query = ActeurTouristique::with(['utilisateur'])
            ->withCount('infrastructures');

        // Filtrage par recherche
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nom_entreprise', 'like', '%' . $request->search . '%')
                    ->orWhereHas('utilisateur', function ($subQ) use ($request) {
                        $subQ->where('nom', 'like', '%' . $request->search . '%')
                            ->orWhere('email', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // Filtrage par statut
        if ($request->filled('status')) {
            $query->whereHas('utilisateur', function ($q) use ($request) {
                if ($request->status === 'active') {
                    $q->where('is_active', true);
                } elseif ($request->status === 'inactive') {
                    $q->where('is_active', false);
                }
            });
        }

        // Tri
        switch ($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nom_entreprise', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nom_entreprise', 'desc');
                break;
            case 'most_infrastructures':
                $query->orderByDesc('infrastructures_count');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $acteurs = $query->paginate(12);

        return view('admin.acteurs.index', compact('acteurs'));
    }

    /**
     * Afficher un acteur touristique
     */
    public function acteursShow(ActeurTouristique $acteur)
    {
        $acteur->load(['utilisateur', 'infrastructures']);
        return view('admin.acteurs.show', compact('acteur'));
    }

    /**
     * Afficher le formulaire de création d'un acteur
     */
    public function acteursCreate()
    {
        return view('admin.acteurs.create');
    }

    /**
     * Créer un nouvel acteur touristique
     */
    public function acteursStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'telephone' => 'nullable|string|max:20',
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:500',
            'type_activite' => 'required|string|in:hotel,restaurant,transport,activite,autre',
            'description' => 'nullable|string|max:1000',
            'site_web' => 'nullable|url|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Créer l'utilisateur
            $utilisateur = Utilisateur::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->password),
                'role' => 'acteur_touristique',
                'is_active' => true,
            ]);

            // Créer l'acteur touristique
            $acteur = ActeurTouristique::create([
                'utilisateur_id' => $utilisateur->id,
                'nom_entreprise' => $request->nom_entreprise,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'type_activite' => $request->type_activite,
                'description' => $request->description,
                'site_web' => $request->site_web,
            ]);

            DB::commit();

            return redirect()->route('admin.acteurs.index')
                ->with('success', 'Acteur touristique créé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de la création de l\'acteur.'])
                ->withInput();
        }
    }

    /**
     * Afficher le formulaire d'édition d'un acteur
     */
    public function acteursEdit(ActeurTouristique $acteur)
    {
        $acteur->load('utilisateur');
        return view('admin.acteurs.edit', compact('acteur'));
    }

    /**
     * Mettre à jour un acteur touristique
     */
    public function acteursUpdate(Request $request, ActeurTouristique $acteur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $acteur->utilisateur->id,
            'telephone' => 'nullable|string|max:20',
            'nom_entreprise' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:500',
            'type_activite' => 'required|string|in:hotel,restaurant,transport,activite,autre',
            'description' => 'nullable|string|max:1000',
            'site_web' => 'nullable|url|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Mettre à jour l'utilisateur
            $updateData = [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $acteur->utilisateur->update($updateData);

            // Mettre à jour l'acteur touristique
            $acteur->update([
                'nom_entreprise' => $request->nom_entreprise,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'type_activite' => $request->type_activite,
                'description' => $request->description,
                'site_web' => $request->site_web,
            ]);

            DB::commit();

            return redirect()->route('admin.acteurs.show', $acteur)
                ->with('success', 'Acteur touristique mis à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour de l\'acteur.'])
                ->withInput();
        }
    }

    /**
     * Basculer le statut d'un acteur
     */
    public function acteursToggleStatus(ActeurTouristique $acteur)
    {
        $acteur->utilisateur->update([
            'is_active' => !$acteur->utilisateur->is_active
        ]);

        $status = $acteur->utilisateur->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Acteur {$status} avec succès.");
    }

    /**
     * Supprimer un acteur touristique
     */
    public function acteursDestroy(ActeurTouristique $acteur)
    {
        DB::beginTransaction();
        try {
            // Supprimer d'abord les infrastructures
            $acteur->infrastructures()->delete();

            // Puis supprimer l'acteur et l'utilisateur
            $utilisateur = $acteur->utilisateur;
            $acteur->delete();
            $utilisateur->delete();

            DB::commit();

            return back()->with('success', 'Acteur supprimé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Erreur lors de la suppression de l\'acteur.']);
        }
    }

    /**
     * Actions en lot sur les acteurs
     */
    public function acteursBulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'acteur_ids' => 'required|array',
            'acteur_ids.*' => 'exists:acteurs_touristiques,id'
        ]);

        $acteurs = ActeurTouristique::with('utilisateur')->whereIn('id', $request->acteur_ids);

        switch ($request->action) {
            case 'activate':
                foreach ($acteurs->get() as $acteur) {
                    $acteur->utilisateur->update(['is_active' => true]);
                }
                $message = 'Acteurs activés avec succès.';
                break;

            case 'deactivate':
                foreach ($acteurs->get() as $acteur) {
                    $acteur->utilisateur->update(['is_active' => false]);
                }
                $message = 'Acteurs désactivés avec succès.';
                break;

            case 'delete':
                DB::beginTransaction();
                try {
                    foreach ($acteurs->get() as $acteur) {
                        $acteur->infrastructures()->delete();
                        $utilisateur = $acteur->utilisateur;
                        $acteur->delete();
                        $utilisateur->delete();
                    }
                    DB::commit();
                    $message = 'Acteurs supprimés avec succès.';
                } catch (\Exception $e) {
                    DB::rollback();
                    return back()->withErrors(['error' => 'Erreur lors de la suppression des acteurs.']);
                }
                break;
        }

        return back()->with('success', $message);
    }
}
