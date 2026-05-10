<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionnPlace extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sessionn_id',
        'place_id',
        'validated',
        'validated_at',
    ];

    /**
     * Cast automatique des types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'validated'   => 'boolean',
        'validated_at'=> 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /**
     * Session associée.
     */
    public function sessionn()
    {
        return $this->belongsTo(Sessionn::class);
    }

    /**
     * Lieu associé.
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}
