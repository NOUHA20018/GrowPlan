<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\UserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name','prenom','email','password','role','date_naissance','addresse','level','bio','total_earnings','cours_valides','cours_refuse'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function quizzes()
    {
         return $this->belongsToMany(Quizze::class, 'apprenants_quizzes', 'apprenant_id', 'quiz_id')
         ->withPivot('score', 'date_passage', 'responses_json')
         
                ->withTimestamps();
    }

    public function formateurQuizzes()
    {
        return $this->hasMany(Quizze::class);
               
    }
    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
    public function cours(){
        return $this->hasMany(Cour::class);
    }

    public function cours_valides()
    {
        return $this->hasMany(Cour::class, 'admin_id')
        ->where('status', 'valide');
    }
    public function formateur_cours_valides()
    {
        return $this->hasMany(Cour::class, 'user_id') 
                    ->where('status', 'valide'); 
    }
    public function formateur_cours_refuses()
    {
        return $this->hasMany(Cour::class, 'user_id') 
                    ->where('status', 'refuse'); 
    }
    public function cours_refuses()
{
    return $this->hasMany(Cour::class, 'admin_id') 
        ->where('st atus', 'refuse');
}
    public function apprenant_cours()
    {
        return $this->belongsToMany(Cour::class, 'progressions', 'user_id', 'cour_id')
                    ->withPivot('progression')
                    ->withTimestamps();
    }
    public function apprenantChapitreInscrit(){
        return $this->hasManyThrough(
            Chapitre::class,Cour::class,
        );
    }

    public function coursInscrits()
    {
        return $this->belongsToMany(Cour::class, 'inscriptions', 'user_id', 'cour_id')
                    ->withPivot('inscrit_le', 'status')
                    ->withTimestamps();
    }

    public function categories(){
        return $this->hasMany(Categorie::class)
        ->whereIn('role', [UserTypes::FORMATEUR, UserTypes::ADMIN]);
    }
    public function inscriptionsApprenants()
    {
        return $this->hasManyThrough(
           Inscription::class, // module li bagha nwsl lih 
        Cour::class,        // module wasit(cour)
        'user_id', //krbt user b cour
        'cour_id', // KYRBT COUR B INSCRIPTION
        'id',      // dial users
        'id'       //dial cours
    );
    }



    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
