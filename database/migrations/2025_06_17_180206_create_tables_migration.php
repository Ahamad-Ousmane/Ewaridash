<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table utilisateurs
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('motDePasse');
            $table->string('telephone')->nullable();
            $table->enum('type', ['admin', 'acteur_touristique'])->default('acteur_touristique');
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Table acteurs touristiques
        Schema::create('acteurs_touristiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->string('nom_entreprise');
            $table->text('description')->nullable();
            $table->string('adresse')->nullable();
            $table->string('site_web')->nullable();
            $table->string('ville')->nullable();
            $table->json('reseaux_sociaux')->nullable();
            $table->timestamps();
        });

        // Table infrastructures touristiques
        Schema::create('infrastructure_touristiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acteur_touristique_id')->constrained('acteurs_touristiques')->onDelete('cascade');
            $table->string('nom');
            $table->text('description');
            $table->string('localisation');
            $table->json('images')->nullable();
            $table->enum('type', ['hotel', 'restaurant', 'attraction', 'transport']);
            $table->json('caracteristiques')->nullable(); // Prix, capacité, etc.
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table contenus RA
        Schema::create('ra_contenus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infrastructure_touristique_id')->constrained('infrastructure_touristiques')->onDelete('cascade');
            $table->text('description');
            $table->string('scene');
            $table->json('assets_3d')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ra_contenus');
        Schema::dropIfExists('infrastructure_touristiques');
        Schema::dropIfExists('acteurs_touristiques');
        Schema::dropIfExists('utilisateurs');
    }
};