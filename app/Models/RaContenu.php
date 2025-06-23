<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaContenu extends Model
{
    use HasFactory;

    protected $table = 'ra_contenus';

    protected $fillable = [
        'infrastructure_touristique_id',
        'description',
        'scene',
        'assets_3d',
    ];

    protected $casts = [
        'assets_3d' => 'array',
    ];

    public function infrastructureTouristique()
    {
        return $this->belongsTo(InfrastructureTouristique::class);
    }

    public function activerRA()
    {
        // Logique pour activer le contenu RA
        return true;
    }
}