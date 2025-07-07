<?php

namespace App\Http\Controllers;

use App\Models\ActeurTouristique;
use App\Models\InfrastructureTouristique;
use App\Models\RaContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class ActeurController extends Controller
{
    public function infrastructures(Request $request)
    {
        $acteur = Auth::user()->acteurTouristique;
        
        // Commencer la requête avec les infrastructures de l'acteur
        $query = $acteur->infrastructures();

        // Filtrage par recherche
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('localisation', 'like', '%' . $request->search . '%');
        }

        // Filtrage par type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtrage par statut (actif/inactif)
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        // Tri
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
            case 'price_asc':
                $query->orderByRaw("(caracteristiques->>'prix')::numeric asc");
                break;
            case 'price_desc':
                $query->orderByRaw("(caracteristiques->>'prix')::numeric desc");
                break;
            default:
                $query->latest();
        }

        $infrastructures = $query->paginate(12);

        return view('acteur.infrastructures.index', compact('infrastructures'));
    }

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
            'attractions' => $acteur->infrastructures()->byType('attraction')->count(),
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
        'adresse' => 'required|string',
        'ville' => 'required|string',
        'telephone_entreprise' => 'nullable|string',
        'site_web' => 'nullable|url',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'twitter' => 'nullable|url',
    ]);

    $reseaux = [
        'facebook' => $request->facebook,
        'instagram' => $request->instagram,
        'twitter' => $request->twitter,
    ];

    $acteur = Auth::user()->acteurTouristique;

    if (!$acteur) {
        $acteur = ActeurTouristique::create([
            'utilisateur_id' => Auth::id(),
            'nom_entreprise' => $request->nom_entreprise,
            'description' => $request->description,
            'adresse' => $request->adresse,
            'ville' => $request->ville,
            'telephone_entreprise' => $request->telephone_entreprise,
            'site_web' => $request->site_web,
            'reseaux_sociaux' => $reseaux,
        ]);
    } else {
        $acteur->update([
            'nom_entreprise' => $request->nom_entreprise,
            'description' => $request->description,
            'adresse' => $request->adresse,
            'ville' => $request->ville,
            'telephone_entreprise' => $request->telephone_entreprise,
            'site_web' => $request->site_web,
            'reseaux_sociaux' => $reseaux,
        ]);
    }

    return back()->with('success', 'Profil mis à jour avec succès.');
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
        'type' => 'required|in:hotel,restaurant,attraction,transport,',
        'images.*' => 'nullable|image|max:2048',
        'prix' => 'nullable|numeric',
        'capacite' => 'nullable|integer',
        'amenities' => 'nullable|string',
    ]);

    $images = [];
    
    Log::info("🚀 Début upload images - Nombre: " . ($request->hasFile('images') ? count($request->file('images')) : 0));
    
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
            Log::info("📸 Image $index - Nom: " . $image->getClientOriginalName() . " - Taille: " . $image->getSize());
            
            try {
                $path = $this->uploadToSupabase($image);
                $images[] = $path;
                Log::info("✅ Image $index uploadée vers Supabase: $path");
                
            } catch (\Exception $e) {
                Log::error("❌ Échec Supabase pour image $index: " . $e->getMessage());
                
                // Fallback: stockage local
                $path = $image->store('infrastructures', 'public');
                $images[] = $path;
                Log::info("💾 Fallback local pour image $index: $path");
            }
        }
    }

    Log::info("📊 Images finales à sauvegarder: " . json_encode($images));

    
    
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

private function uploadToSupabase($file)
{
    Log::info("🔧 uploadToSupabase appelée");
    
    $supabaseUrl = env('SUPABASE_URL');
    $serviceKey = env('SUPABASE_SERVICE_KEY');
    
    Log::info("🌐 URL Supabase: " . ($supabaseUrl ?: 'NON DÉFINIE'));
    Log::info("🔑 Service Key présente: " . (!empty($serviceKey) ? 'OUI (' . strlen($serviceKey) . ' chars)' : 'NON'));
    
    if (empty($supabaseUrl) || empty($serviceKey)) {
        throw new \Exception("Configuration Supabase manquante");
    }
    
    $client = new Client([
        'timeout' => 30,
        'verify' => false,
        'curl' => [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]
    ]);
    
    $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    $path = 'infrastructures/' . $filename;
    $url = "$supabaseUrl/storage/v1/object/images/$path";
    
    Log::info("📤 URL upload: $url");
    Log::info("📁 Fichier: " . $file->getRealPath() . " (" . $file->getSize() . " bytes)");
    
    try {
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => "Bearer $serviceKey",
                'Content-Type' => $file->getMimeType(),
                'x-upsert' => 'true',
            ],
            'body' => file_get_contents($file->getRealPath())
        ]);
        
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody()->getContents();
        
        Log::info("📊 Réponse Supabase - Status: $statusCode");
        Log::info("📊 Body: $responseBody");
        
        if ($statusCode >= 200 && $statusCode < 300) {
            Log::info("✅ SUCCESS: Upload Supabase réussi: $path");
            return $path;
        } else {
            throw new \Exception("Status code inattendu: $statusCode");
        }
        
    } catch (\Exception $e) {
        Log::error("💥 Exception complète: " . get_class($e) . " - " . $e->getMessage());
        throw $e;
    }
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
        'type' => 'required|in:hotel,restaurant,attraction,transport',
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
            // Supprimer de Supabase ET du stockage local pour compatibilité
            try {
                // Tentative de suppression sur Supabase
                $this->deleteFromSupabase($imageToRemove);
                Log::info("✅ Image supprimée de Supabase: $imageToRemove");
            } catch (\Exception $e) {
                Log::error("❌ Échec suppression Supabase pour: $imageToRemove - " . $e->getMessage());
            }
            
            // Suppression locale en fallback
            Storage::disk('public')->delete($imageToRemove);
        }
    }

    // Ajouter les nouvelles images avec upload vers Supabase
    Log::info("🚀 Début upload nouvelles images - Nombre: " . ($request->hasFile('images') ? count($request->file('images')) : 0));
    
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
            Log::info("📸 Nouvelle image $index - Nom: " . $image->getClientOriginalName() . " - Taille: " . $image->getSize());
            
            try {
                // Tentative d'upload vers Supabase
                $path = $this->uploadToSupabase($image);
                $images[] = $path;
                Log::info("✅ Nouvelle image $index uploadée vers Supabase: $path");
                
            } catch (\Exception $e) {
                Log::error("❌ Échec Supabase pour nouvelle image $index: " . $e->getMessage());
                
                // Fallback: stockage local
                $path = $image->store('infrastructures', 'public');
                $images[] = $path;
                Log::info("💾 Fallback local pour nouvelle image $index: $path");
            }
        }
    }

    Log::info("📊 Images finales après modification: " . json_encode($images));

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

    private function deleteFromSupabase($imagePath)
{
    Log::info("🗑️ deleteFromSupabase appelée pour: $imagePath");
    
    $supabaseUrl = env('SUPABASE_URL');
    $serviceKey = env('SUPABASE_SERVICE_KEY');
    
    if (empty($supabaseUrl) || empty($serviceKey)) {
        throw new \Exception("Configuration Supabase manquante pour suppression");
    }
    
    $client = new Client([
        'timeout' => 30,
        'verify' => false,
        'curl' => [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]
    ]);
    
    $url = "$supabaseUrl/storage/v1/object/images/$imagePath";
    
    Log::info("🗑️ URL suppression: $url");
    
    try {
        $response = $client->delete($url, [
            'headers' => [
                'Authorization' => "Bearer $serviceKey",
            ]
        ]);
        
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody()->getContents();
        
        Log::info("📊 Réponse suppression Supabase - Status: $statusCode");
        Log::info("📊 Body: $responseBody");
        
        if ($statusCode >= 200 && $statusCode < 300) {
            Log::info("✅ SUCCESS: Suppression Supabase réussie: $imagePath");
            return true;
        } else {
            throw new \Exception("Status code inattendu pour suppression: $statusCode");
        }
        
    } catch (\Exception $e) {
        Log::error("💥 Exception suppression Supabase: " . get_class($e) . " - " . $e->getMessage());
        throw $e;
    }
}
}