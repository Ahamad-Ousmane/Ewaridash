<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeurTouristique extends Model
{
    use HasFactory;

    protected $table = 'acteurs_touristiques';

    protected $fillable = [
        'utilisateur_id',
        'nom_entreprise',
        'description',
        'adresse',
        'site_web',
        'ville', 
        'reseaux_sociaux',
    ];

    protected $casts = [
        'reseaux_sociaux' => 'array',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function infrastructures()
    {
        return $this->hasMany(InfrastructureTouristique::class);
    }

    public function infrastructuresActives()
    {
        return $this->hasMany(InfrastructureTouristique::class)->where('is_active', true);
    }

    public function getTotalInfrastructuresAttribute()
    {
        return $this->infrastructures()->count();
    }

    public function getInfrastructuresActivesCountAttribute()
    {
        return $this->infrastructuresActives()->count();
    }
}