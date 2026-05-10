<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'name',
        'latitude',
        'longitude',
        'description',
        'order',
    ];

    /**
     * Conversion automatique des types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'order'      => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec le jeu.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relation avec le jeu.
     */
    public function riddles()
    {
        return $this->hasMany(Riddle::class);
    }

    public function sessionnPlaces()
    {
        return $this->hasMany(SessionnPlace::class);
    }
}
