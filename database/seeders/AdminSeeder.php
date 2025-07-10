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
            'localisation' => 'Sofitel, Boulevard de la Marina, Cotonou Bénin',
            'images' => [
                'infrastructures/sofitel1.png',
                'infrastructures/sofitel2.png',
                'infrastructures/sofitel3.png',
                'infrastructures/sofitel4.png',
                'infrastructures/sofitel5.png',
                'infrastructures/sofitel6.png',
                'infrastructures/sofitel7.png',
                'infrastructures/sofitel8.png',
                'infrastructures/sofitel9.png',
                'infrastructures/sofitel10.png',
            ],
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
            'localisation' => 'Plage de Fidjrossè, Fidjrossè, Cotonou',
            'images' => [
                'infrastructures/fidjrosse1.png',
                'infrastructures/fidjrosse2.png',
                'infrastructures/fidjrosse3.png',
                'infrastructures/fidjrosse4.png',
                'infrastructures/fidjrosse5.png',
                'infrastructures/fidjrosse6.png',
                'infrastructures/fidjrosse7.png',
            ],
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
            'localisation' => 'Chez Clarisse, Fidjrossè plage, Cotonou',
            'images' => [
                'infrastructures/clarisse1.png',
                'infrastructures/clarisse2.png'
            ],
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
            'images' => [
                'infrastructures/taxi1.png',
                'infrastructures/taxi2.png',
                'infrastructures/taxi3.png',
                'infrastructures/taxi4.png',
                'infrastructures/taxi5.png',
                'infrastructures/taxi6.png',
                'infrastructures/taxi7.png'
            ],
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
            'localisation' => 'Bénin',
            'images' => [
                'infrastructures/bus1.png',
                'infrastructures/bus2.png',
                'infrastructures/bus3.png',
                'infrastructures/bus4.png',
                'infrastructures/bus5.png',
                'infrastructures/bus6.png',
                'infrastructures/bus7.png',
                'infrastructures/bus8.png',
                'infrastructures/bus9.png'
            ],
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
            'localisation' => 'Place de l’Amazone, Cotonou, Bénin',
            'images' => [
                'infrastructures/amazone1.png',
                'infrastructures/amazone2.png',
                'infrastructures/amazone3.png',
                'infrastructures/amazone4.png',
                'infrastructures/amazone5.png',
                'infrastructures/amazone6.png',
                'infrastructures/amazone7.png'
            ],
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
            'localisation' => 'Monument Bio Guera, Aéroport de Cadjehoun, Cotonou, Bénin',
            'images' => [
                'infrastructures/bioguera1.png',
                'infrastructures/bioguera2.png'
            ],
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
            'localisation' => 'Place Bulgarie, Cotonou, Bénin',
            'images' => ['infrastructures/bulgarie.png'],
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
            'images' => [
                'infrastructures/ganvie1.png',
                'infrastructures/ganvie2.png',
                'infrastructures/ganvie3.png',
                'infrastructures/ganvie4.png',
                'infrastructures/ganvie5.png',
                'infrastructures/ganvie6.png',
                'infrastructures/ganvie7.png',
                'infrastructures/ganvie8.png',
                'infrastructures/ganvie9.png',
                'infrastructures/ganvie10.png',
                'infrastructures/ganvie11.png',
                'infrastructures/ganvie12.png',
                'infrastructures/ganvie13.png'
            ],
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
            'nom' => 'Le Livingstone',
            'description' => 'Restaurant emblématique à ambiance coloniale avec une carte internationale.',
            'localisation' => 'Le Livingstone, Boulevard Saint Michel, Cotonou, Bénin',
            'images' => [
                'infrastructures/livingstone1.png',
                'infrastructures/livingstone2.png',
                'infrastructures/livingstone3.png',
                'infrastructures/livingstone4.png',
                'infrastructures/livingstone5.png',
                'infrastructures/livingstone6.png',
                'infrastructures/livingstone7.png'
            ],
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
            'localisation' => 'Hôtel Tata Somba, Natitingou, Bénin',
            'images' => [
                'infrastructures/somba1.png',
                'infrastructures/somba2.png',
                'infrastructures/somba3.png',
                'infrastructures/somba4.png',
                'infrastructures/somba5.png',
                'infrastructures/somba6.png',
                'infrastructures/somba7.png',
                'infrastructures/somba8.png',
                'infrastructures/somba9.png',
                'infrastructures/somba10.png',
                'infrastructures/somba11.png',
                'infrastructures/somba12.png',
                'infrastructures/somba13.png',
                'infrastructures/somba14.png',
                'infrastructures/somba15.png',
                'infrastructures/somba16.png',
                'infrastructures/somba17.png',
                'infrastructures/somba18.png'
            ],
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
            'nom' => 'Temple des Pythons',
            'description' => 'Lieu sacré du culte vaudou, célèbre pour sa coexistence entre les pythons vivants et la spiritualité traditionnelle.',
            'localisation' => 'Temple des Pythons, Ouidah, Bénin',
            'images' => [
                'infrastructures/python1.png',
                'infrastructures/python2.png',
                'infrastructures/python3.png',
                'infrastructures/python4.png',
                'infrastructures/python5.png',
                'infrastructures/python6.png'
            ],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 1000,
                'guide_disponible' => true,
                'serpents_vivants' => true,
                'cultes_vodoun' => true,
                'zone_photographique' => true,
                'accessibilite' => true
            ],
            'is_active' => true,
        ]);

        InfrastructureTouristique::create([
            'acteur_touristique_id' => $acteur3->id,
            'nom' => 'Grande Mosquée de Porto-Novo',
            'description' => 'Mosquée historique construite entre 1912 et 1925, alliant style afro-brésilien et héritage islamique.',
            'localisation' => 'Grande Mosquée de Porto-Novo, Centre-ville, Porto-Novo, Bénin',
            'images' => [
                'infrastructures/mosque1.png',
                'infrastructures/mosque2.png',
                'infrastructures/mosque3.png',
                'infrastructures/mosque4.png',
                'infrastructures/mosque5.png',
                'infrastructures/mosque6.png'
            ],
            'type' => 'attraction',
            'caracteristiques' => [
                'prix' => 0,
                'accessible' => true,
                'patrimoine' => true,
                'culte_actif' => true,
                'visite_autorisee' => true,
                'architecture_coloniale' => true
            ],
            'is_active' => true,
        ]);
    }
}