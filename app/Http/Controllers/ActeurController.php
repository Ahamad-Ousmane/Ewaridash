<?php

namespace App\Http\Controllers;

use App\Models\ActeurTouristique;
use App\Models\InfrastructureTouristique;
use App\Models\RaContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActeurController extends Controller
{
    

    public function dashboard()
{
    $acteur = Auth::user()->acteurTouristique;
    
    // Si l'acteur n'existe pas, créer un profil de base
    if (!$acteur) {
        $acteur = ActeurTouristique::create([
            'utilisateur_id' => Auth::id(),
            'nom_entreprise' => Auth::user()->nom . ' ' . Auth::user()->prenom . ' - Entreprise',
            'description' => null,
            'adresse' => null,
            'site_web' => null,
            'type_activite' => 'autre', // Valeur par défaut
        ]);
    }

    $stats = [
        'total_infrastructures' => $acteur->infrastructures()->count(),
        'infrastructures_actives' => $acteur->infrastructuresActives()->count(),
        'hotels' => $acteur->infrastructures()->byType('hotel')->count(),
        'restaurants' => $acteur->infrastructures()->byType('restaurant')->count(),
        'plages' => $acteur->infrastructures()->byType('plage')->count(),
        'transports' => $acteur->infrastructures()->byType('transport')->count(),
    ];

    $recentInfrastructures = $acteur->infrastructures()
        ->latest()
        ->take(5)
        ->get();

    return view('acteur.dashboard', compact('acteur', 'stats', 'recentInfrastructures'));
}

    public function profile()
    {
        $acteur = Auth::user()->acteurTouristique;
        $utilisateur = Auth::user();
        return view('acteur.profile', compact('acteur', 'utilisateur'));
    }

    public function createProfile()
{
    return view('acteur.profile.create');
}

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string',
            'site_web' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $acteur = Auth::user()->acteurTouristique;
        
        if (!$acteur) {
            $acteur = ActeurTouristique::create([
                'utilisateur_id' => Auth::id(),
                'nom_entreprise' => $request->nom_entreprise,
                'description' => $request->description,
                'adresse' => $request->adresse,
                'site_web' => $request->site_web,
                'reseaux_sociaux' => [
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'twitter' => $request->twitter,
                ],
            ]);
        } else {
            $acteur->update([
                'nom_entreprise' => $request->nom_entreprise,
                'description' => $request->description,
                'adresse' => $request->adresse,
                'site_web' => $request->site_web,
                'reseaux_sociaux' => [
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'twitter' => $request->twitter,
                ],
            ]);
        }

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function infrastructures()
    {
        $acteur = Auth::user()->acteurTouristique;
        $infrastructures = $acteur->infrastructures()
            ->latest()
            ->paginate(12);

        return view('acteur.infrastructures.index', compact('infrastructures'));
    }

    public function createInfrastructure()
    {
        return view('acteur.infrastructures.create');
    }

    public function storeInfrastructure(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'localisation' => 'required|string',
            'type' => 'required|in:hotel,restaurant,plage,transport',
            'images.*' => 'nullable|image|max:2048',
            'prix' => 'nullable|numeric',
            'capacite' => 'nullable|integer',
            'amenities' => 'nullable|string',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('infrastructures', 'public');
                $images[] = $path;
            }
        }

        $caracteristiques = [];
        if ($request->filled('prix')) {
            $caracteristiques['prix'] = $request->prix;
        }
        if ($request->filled('capacite')) {
            $caracteristiques['capacite'] = $request->capacite;
        }
        if ($request->filled('amenities')) {
            $caracteristiques['amenities'] = explode(',', $request->amenities);
        }

        InfrastructureTouristique::create([
            'acteur_touristique_id' => Auth::user()->acteurTouristique->id,
            'nom' => $request->nom,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'type' => $request->type,
            'images' => $images,
            'caracteristiques' => $caracteristiques,
        ]);

        return redirect()->route('acteur.infrastructures.index')
            ->with('success', 'Infrastructure créée avec succès.');
    }

    public function showInfrastructure($id)
    {
        $infrastructure = InfrastructureTouristique::with('raContenu')
            ->where('acteur_touristique_id', Auth::user()->acteurTouristique->id)
            ->findOrFail($id);

        return view('acteur.infrastructures.show', compact('infrastructure'));
    }

    public function editInfrastructure($id)
    {
        $infrastructure = InfrastructureTouristique::where('acteur_touristique_id', Auth::user()->acteurTouristique->id)
            ->findOrFail($id);

        return view('acteur.infrastructures.edit', compact('infrastructure'));
    }

    public function updateInfrastructure(Request $request, $id)
{
    $infrastructure = InfrastructureTouristique::where('acteur_touristique_id', Auth::user()->acteurTouristique->id)
        ->findOrFail($id);

    // Validation corrigée
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'localisation' => 'required|string',
        'type' => 'required|in:hotel,restaurant,plage,transport',
        'is_active' => 'required|boolean',
        'images.*' => 'nullable|image|max:10240', // 10MB
        'existing_images.*' => 'nullable|string',
        'images_to_remove.*' => 'nullable|string',
        'caracteristiques.prix' => 'nullable|numeric|min:0',
        'caracteristiques.capacite' => 'nullable|integer|min:1',
        'caracteristiques.amenities' => 'nullable|array',
        'caracteristiques.amenities.*' => 'string',
    ]);

    // Gestion des images existantes
    $images = [];
    
    // Récupérer les images existantes qui ne sont pas marquées pour suppression
    if ($request->has('existing_images')) {
        $imagesToRemove = $request->input('images_to_remove', []);
        foreach ($request->input('existing_images') as $existingImage) {
            if (!in_array($existingImage, $imagesToRemove)) {
                $images[] = $existingImage;
            }
        }
    }

    // Supprimer physiquement les images marquées pour suppression
    if ($request->has('images_to_remove')) {
        foreach ($request->input('images_to_remove') as $imageToRemove) {
            Storage::disk('public')->delete($imageToRemove);
        }
    }

    // Ajouter les nouvelles images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('infrastructures', 'public');
            $images[] = $path;
        }
    }

    // Construire les caractéristiques correctement
    $caracteristiques = [];
    
    // Prix
    if ($request->filled('caracteristiques.prix')) {
        $caracteristiques['prix'] = (float) $request->input('caracteristiques.prix');
    }
    
    // Capacité
    if ($request->filled('caracteristiques.capacite')) {
        $caracteristiques['capacite'] = (int) $request->input('caracteristiques.capacite');
    }
    
    // Équipements (amenities)
    if ($request->has('caracteristiques.amenities')) {
        $caracteristiques['amenities'] = $request->input('caracteristiques.amenities');
    } else {
        $caracteristiques['amenities'] = [];
    }

    // Mise à jour de l'infrastructure
    $infrastructure->update([
        'nom' => $request->nom,
        'description' => $request->description,
        'localisation' => $request->localisation,
        'type' => $request->type,
        'is_active' => $request->is_active,
        'images' => $images,
        'caracteristiques' => $caracteristiques,
    ]);

    return redirect()->route('acteur.infrastructures.show', $infrastructure->id)
        ->with('success', 'Infrastructure mise à jour avec succès.');
}

    public function destroyInfrastructure($id)
    {
        $infrastructure = InfrastructureTouristique::where('acteur_touristique_id', Auth::user()->acteurTouristique->id)
            ->findOrFail($id);

        // Supprimer les images
        if ($infrastructure->images) {
            foreach ($infrastructure->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $infrastructure->delete();

        return redirect()->route('acteur.infrastructures.index')
            ->with('success', 'Infrastructure supprimée avec succès.');
    }
}