<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    const STATUS_EN_ATTENTE = 'en_attente';
    const STATUS_ACCEPTE = 'accepte';
    const STATUS_REFUSE = 'refuse';
    const STATUS_ANNULE = 'annule';
    const STATUS_TERMINE = 'termine';
     protected $fillable = [
        'user_id',
        'cour_id',
        'inscrit_le',
        'status',
    ];
}
