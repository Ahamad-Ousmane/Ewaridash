<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastructureTouristique extends Model
{
    use HasFactory;

    protected $table = 'infrastructure_touristiques';

    protected $fillable = [
        'acteur_touristique_id',
        'nom',
        'description',
        'localisation',
        'images',
        'type',
        'caracteristiques',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'caracteristiques' => 'array',
        'is_active' => 'boolean',
    ];

    const TYPES = [
        'hotel' => 'Hôtel',
        'restaurant' => 'Restaurant',
        'plage' => 'Espace Plage',
        'transport' => 'Service de Transport',
    ];

    public function acteurTouristique()
    {
        return $this->belongsTo(ActeurTouristique::class);
    }

    public function raContenu()
    {
        return $this->hasOne(RaContenu::class);
    }

    public function getTypeLibelleAttribute()
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getMainImageAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            return $this->images[0];
        }
        return null;
    }

    public function getPrixAttribute()
    {
        return $this->caracteristiques['prix'] ?? null;
    }

    public function getCapaciteAttribute()
    {
        return $this->caracteristiques['capacite'] ?? null;
    }
}