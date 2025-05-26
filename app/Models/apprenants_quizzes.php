<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apprenants_quizzes extends Model
{
    protected $fillable=['apprenant_id','quiz_id','score','date_passage','responses_json'];
}
