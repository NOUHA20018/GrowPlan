<?php

namespace App\Models;

use App\Http\Requests\UserTypes;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    protected $fillable = [
        'question','reponse','bonne_reponse','chapitre_id','cour_id','user_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'apprenant_quizze','quizze_id','user_id')->where('role',UserTypes::APPRENANT);
    }

    public function chapitre(){
        return $this->belongsTo(Chapitre::class,'chapitre_id');
    }
    public function cour(){
        return $this->belongsTo(Cour::class,'cour_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
