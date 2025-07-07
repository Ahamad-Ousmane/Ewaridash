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
        'attraction' => 'Attraction',
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


    public function getImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return null;
        }

        // Si l'image commence par "infrastructures/" = Supabase
        if (str_starts_with($imagePath, 'infrastructures/')) {
            $supabaseUrl = env('SUPABASE_URL', 'https://gpogbnmvkvpzphtbosai.supabase.co');
            return $supabaseUrl . '/storage/v1/object/public/images/' . $imagePath;
        }

        // Sinon = stockage local Laravel
        return '/storage/' . $imagePath;
    }

    /**
     * Retourne toutes les URLs des images
     */
    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function($imagePath) {
            return $this->getImageUrl($imagePath);
        }, $this->images);
    }
}