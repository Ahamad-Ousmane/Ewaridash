<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\ActeurTouristique;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Créer un administrateur
        $admin = Utilisateur::create([
            'nom' => 'Administrateur',
            'email' => 'admin@tourismora.com',
            'motDePasse' => Hash::make('admin123'),
            'telephone' => '+229 97 00 00 00',
            'type' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Créer un acteur touristique de démonstration
        $acteurUser = Utilisateur::create([
            'nom' => 'Jean Doe',
            'email' => 'acteur@example.com',
            'motDePasse' => Hash::make('acteur123'),
            'telephone' => '+229 97 11 11 11',
            'type' => 'acteur_touristique',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $acteur = ActeurTouristique::create([
            'utilisateur_id' => $acteurUser->id,
            'nom_entreprise' => 'Hôtel Paradise Cotonou',
            'description' => 'Un magnifique hôtel 4 étoiles situé au cœur de Cotonou, offrant un service d\'exception et des équipements modernes pour un séjour inoubliable.',
            'adresse' => 'Boulevard de la Marina, Cotonou, Bénin',
            'site_web' => 'https://hotel-paradise-cotonou.com',
            'reseaux_sociaux' => [
                'facebook' => 'https://facebook.com/hotelparadisecotonou',
                'instagram' => 'https://instagram.com/hotelparadisecotonou',
                'twitter' => 'https://twitter.com/hotelparadise'
            ],
        ]);

        echo "✅ Administrateur créé: admin@tourismora.com / admin123\n";
        echo "✅ Acteur touristique créé: acteur@example.com / acteur123\n";
    }
}