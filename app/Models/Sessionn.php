<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessionn extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'transport_type',
        'difficulty',
        'team_size',
        'children_under_10',
        'status',
    ];

    /**
     * Conversion automatique des types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'difficulty'        => 'integer',
        'team_size'         => 'integer',
        'children_under_10' => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * Utilisateur de la session.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Jeu associé.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function sessionnPlaces()
    {
        return $this->hasMany(SessionnPlace::class);
    }
}
