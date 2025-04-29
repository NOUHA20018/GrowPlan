<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    protected $fillable =[
        'title','duree','video','resume','cour_id'
    ];

    public function quizzes(){
        return $this->hasMany(Quizze::class);
    }
    public function cour(){
        return $this->belongsTo(Cour::class,'cour_id');
    }
}
