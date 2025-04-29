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
        'name','prenom','email','password','role','profil','date_naissance','addresse','level','bio','total_earnings','cours_valides','cours_refuse'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',
    ];
    public function quizzes(){
        return $this->belongsToMany(Quizze::class,'apprenant_quizze','quizze_id',"user_id")->where('role',UserTypes::APPRENANT);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
    public function cours(){
        return $this->hasMany(Cour::class);
    }

    public function apprenant_cours()
    {
        return $this->belongsToMany(Cour::class, 'apprenant_cours', 'user_id', 'cour_id')
                    ->withPivot('progression')
                    ->withTimestamps();
    }

    public function categories(){
        return $this->hasMany(Categorie::class)
        ->whereIn('role', [UserTypes::FORMATEUR, UserTypes::ADMIN]);
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
