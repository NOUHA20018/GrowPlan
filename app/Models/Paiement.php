<?php

namespace App\Models;

use App\Http\Requests\UserTypes;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'montant','remise','prime','methode_paiement','statut','user_id','cour_id','date_paiement'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id')->where('role',UserTypes::APPRENANT);
    }
}
