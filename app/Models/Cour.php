<?php

namespace App\Models;

use App\Http\Requests\UserTypes;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    protected $fillable=[
        'title','description','image','prix','date_creation','categorie_id','user_id',
    ];
    public function chapitres(){
        return $this->hasMany(Chapitre::class);
    }
    public function quizzes(){
        return $this->hasMany(Quizze::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->where('role',UserTypes::FORMATEUR);
    }
    public function apprenant_cours()
    {
        return $this->belongsToMany(User::class, 'apprenant_cours', 'user_id', 'cour_id')
                    ->withPivot('progression')
                    ->withTimestamps();
    }
}
