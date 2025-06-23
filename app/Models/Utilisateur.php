<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'email',
        'motDePasse',
        'telephone',
        'type',
        'is_active',
    ];

    protected $hidden = [
        'motDePasse',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // ✅ CRUCIAL : Ces 4 méthodes sont OBLIGATOIRES pour que Laravel fonctionne
    
    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName(); // Retourne 'id' par défaut
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the name of the password field.
     * ✅ CETTE MÉTHODE EST CRUCIALE !
     */
    public function getPasswordName()
    {
        return 'motDePasse';
    }

    // ✅ Méthodes métier
    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isActeurTouristique()
    {
        return $this->type === 'acteur_touristique';
    }

    public function acteurTouristique()
    {
        return $this->hasOne(ActeurTouristique::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');
    }

    public function scopeActeurs($query)
    {
        return $query->where('type', 'acteur_touristique');
    }
}