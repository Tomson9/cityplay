<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riddle extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'place_id',
        'difficulty',
        'question',
        'image',
    ];

    /**
     * Conversion automatique des types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'difficulty' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec le lieu.
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
