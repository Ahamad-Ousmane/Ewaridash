<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\ActeurTouristique;
use App\Models\InfrastructureTouristique;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Créer les administrateurs
        $admin1 = Utilisateur::create([
            'nom' => 'Ahamad',
            'email' => 'ahamad@ewari.com',
            'motDePasse' => Hash::make('ahamad123'),
            'telephone' => '+22955288119',
            'type' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $admin2 = Utilisateur::create([
            'nom' => 'Ayila',
            'email' => 'ayila@ewari.com',
            'motDePasse' => Hash::make('ayila123'),
            'telephone' => '+22990978213',
            'type' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Créer des acteurs touristiques de démonstration
        $acteurUser1 = Utilisateur::create([
            'nom' => 'Assou',
            'email' => 'assou@ewari.com',
            'motDePasse' => Hash::make('assou123'),
            'telephone' => '+22997111111',
            'type' => 'acteur_touristique',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $acteur1 = ActeurTouristique::create([
            'utilisateur_id' => $acteurUser1->id,
            'nom_entreprise' => 'ASSOU&FILS',
            'description' => 'Un ensemble de complexe hôtelier situé au Bénin, offrant des services d\'exception et des équipements modernes pour des séjours inoubliables.',
            'adresse' => 'Boulevard de la Marina, Cotonou, Bénin',
            'site_web' => 'https://assouetfils.com',
            'reseaux_sociaux' => [
                'facebook' => 'https://facebook.com/assouetfils',
                'instagram' => 'https://instagram.com/assouetfils',
                'twitter' => 'https://twitter.com/assouetfils'
            ],
        ]);

        $acteurUser2 = Utilisateur::create([
            'nom' => 'Kora',
            'email' => 'kora@ewari.com',
            'motDePasse' => Hash::make('korat123'),
            'telephone' => '+22997222222',
            'type' => 'acteur_touristique',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $acteur2 = ActeurTouristique::create([
            'utilisateur_id' => $acteurUser2->id,
            'nom_entreprise' => 'KORA TRAVEL',
            'description' => 'Agence spécialisée dans les circuits culturels et historiques à travers le Bénin.',
            'adresse' => 'Quartier Gbira, Parakou',
            'site_web' => 'https://koratravel.bj',
            'reseaux_sociaux' => [
                'facebook' => 'https://facebook.com/koratravel',
                'instagram' => 'https://instagram.com/koratravel',
                'twitter' => 'https://twitter.com/koratravel'
            ],
        ]);

        $acteurUser3 = Utilisateur::create([
            'nom' => 'Dossa',
            'email' => 'dossa@ewari.com',
            'motDePasse' => Hash::make('dossa123'),
            'telephone' => '+22997333333',
            'type' => 'acteur_touristique',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $acteur3 = ActeurTouristique::create([
            'utilisateur_id' => $acteurUser3->id,
            'nom_entreprise' => 'DOSSA TOURISME',
            'description' => 'Promoteur d’expériences immersives dans les villages lacustres et lieux sacrés du Bénin.',
            'adresse' => 'Ganvié, Bénin',
            'site_web' => 'https://dossatourisme.bj',
            'reseaux_sociaux' => [
                'facebook' => 'https://facebook.com/dossatourisme',
                'instagram' => 'https://instagram.com/dossatourisme',
                'twitter' => 'https://twitter.com/dossatourisme'
            ],
        ]);

        // Créer les infrastructures de démonstration
        // Infrastructures pour ASSOU&FILS (acteur1)
        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur1->id,
            'nom' => 'Sofitel Hôtel Ibis Cotonou',
            'description' => 'Un hôtel de luxe situé à proximité de l\'aéroport avec des services haut de gamme.',
            'localisation' => 'Rue 2101, Quartier Ganhi, Cotonou',
            'images' => ['infrastructures/sofitel1.jpg'],
            'type' => 'hotel',
            'caracteristiques' => [
                'capacite' => 150,
                'prix' => 85000,
                'wifi' => true,
                'piscine' => true,
                'parking' => true,
                'restaurant' => true,
                'bar' => true,
                'climatisation' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur1->id,
            'nom' => 'Plage de Fidjrossè',
            'description' => 'Plage prisée de Cotonou, idéale pour les promenades au coucher du soleil.',
            'localisation' => 'Route des Pêches, Fidjrossè, Cotonou',
            'images' => ['infrastructures/fidjrosse1.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 0,
                'securise' => true,
                'surveillance' => true,
                'activites' => ['baignade', 'volley', 'jogging']
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur1->id,
            'nom' => 'Chez Clarisse Fidjrossè',
            'description' => 'Restaurant local célèbre pour ses poissons braisés et mets béninois.',
            'localisation' => 'Fidjrossè plage, Cotonou',
            'images' => ['infrastructures/chezclarisse.jpg'],
            'type' => 'restaurant',
            'caracteristiques' => [
                'capacite' => 60,
                'prix' => 8000,
                'terrasse' => true,
                'menu_vegetarien' => true,
                'musique_live' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur1->id,
            'nom' => 'Taxi Vite Cotonou',
            'description' => 'Service de transport rapide en taxi urbain dans les principales artères de Cotonou.',
            'localisation' => 'Ganhi, Cotonou',
            'images' => ['infrastructures/taxi-vite.jpg'],
            'type' => 'transport',
            'caracteristiques' => [
                'prix_moyen' => 1500,
                'type_vehicule' => 'voiture',
                'disponibilite_24h' => true,
                'application_mobile' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur1->id,
            'nom' => 'Bus Touristique Cotonou',
            'description' => 'Circuit touristique en bus climatisé pour découvrir les monuments de Cotonou.',
            'localisation' => 'Départ Place de l’Amazone',
            'images' => ['infrastructures/bus-tour.jpg'],
            'type' => 'transport',
            'caracteristiques' => [
                'capacite' => 30,
                'prix' => 5000,
                'guide_audio' => true,
                'horaires_fixes' => true
            ],
            'is_active' => true,
        ]);

        // Infrastructures pour KORA TRAVEL (acteur2)
        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Place de l’Amazone',
            'description' => 'Esplanade monumentale abritant la statue de l\'Amazone, symbole historique du Bénin.',
            'localisation' => 'Centre administratif, Cotonou',
            'images' => ['infrastructures/amazone1.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 0,
                'accessible' => true,
                'guide_disponible' => true,
                'eclairage_nocturne' => true,
                'RA'=> true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Place Bio Guéra',
            'description' => 'Statue équestre rendant hommage au héros de la résistance du Nord béninois.',
            'localisation' => 'Carrefour Stade de l’Amitié, Cotonou',
            'images' => ['infrastructures/bioguera1.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 0,
                'accessible' => true,
                'historique' => true,
                'lieu_de_rassemblement' => true,
                'RA'=> true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Place Bulgarie',
            'description' => 'Point névralgique et dynamique de la circulation à Cotonou, symbole urbain.',
            'localisation' => 'Carrefour de la place Bulgarie, Cotonou',
            'images' => ['infrastructures/bulgarie1.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 0,
                'accessible' => true,
                'zone_photographique' => true,
                'zone_commerciale' => true,
                'RA'=> true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Ganvié Village Lacustre',
            'description' => 'Village construit sur pilotis au cœur du lac Nokoué, expérience unique.',
            'localisation' => 'Ganvié, Lac Nokoué',
            'images' => ['infrastructures/ganvie1.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 3000,
                'capacite' => 10,
                'guide_local' => true,
                'transport_pirogue' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Le Berlin',
            'description' => 'Restaurant chic de cuisine européenne et africaine, ambiance feutrée.',
            'localisation' => 'Haie vive, Cotonou',
            'images' => ['infrastructures/leberlin.jpg'],
            'type' => 'restaurant',
            'caracteristiques' => [
                'capacite' => 70,
                'prix' => 18000,
                'parking' => true,
                'climatisation' => true,
                'wifi' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur2->id,
            'nom' => 'Le Livingstone',
            'description' => 'Restaurant emblématique à ambiance coloniale avec une carte internationale.',
            'localisation' => 'Boulevard Saint Michel, Cotonou',
            'images' => ['infrastructures/livingstone.jpg'],
            'type' => 'restaurant',
            'caracteristiques' => [
                'capacite' => 100,
                'prix' => 25000,
                'terrasse' => true,
                'musique_live' => true,
                'carte_vins' => true
            ],
            'is_active' => true,
        ]);

        // Infrastructures pour DOSSA TOURISME (acteur3)
        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur3->id,
            'nom' => 'Résidence Tata Somba',
            'description' => 'Hébergement traditionnel inspiré de l\'architecture du Nord Bénin.',
            'localisation' => 'Natitingou',
            'images' => ['infrastructures/tatasomba.jpg'],
            'type' => 'hotel',
            'caracteristiques' => [
                'capacite' => 25,
                'prix' => 20000,
                'architecture_traditionnelle' => true,
                'visite_guidee_disponible' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur3->id,
            'nom' => 'Maison de la culture de Ouidah',
            'description' => 'Centre culturel et musée retraçant l\'histoire de l\'esclavage.',
            'localisation' => 'Route des Esclaves, Ouidah',
            'images' => ['infrastructures/ouidahculture.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 1500,
                'guide' => true,
                'accessibilite' => true,
                'expositions' => ['histoire', 'esclavage']
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur3->id,
            'nom' => 'La Capitainerie de Porto-Novo',
            'description' => 'Ancien bâtiment colonial devenu lieu de mémoire et de visite.',
            'localisation' => 'Porto-Novo centre',
            'images' => ['infrastructures/capitainerie.jpg'],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 1000,
                'accessible' => true,
                'patrimoine' => true,
                'audio_guide' => true
            ],
            'is_active' => true,
        ]);
 
    }
}