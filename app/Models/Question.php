<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =[
        'question_text','quizze_id'
    ];

    public function quizze(){
        return $this->belongTo(Quizze::class,'quizze_id');
    }
    public function reponses_possible(){
        return $this->hasMany(Reponses_possibles::class);
    }

   
}
