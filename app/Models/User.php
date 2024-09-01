<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Film;
use App\Models\Type;
use App\Models\Sceance;
use App\Models\Commentaire;
use App\Models\Reservation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profil',
        'type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function commentaires(){
        return $this->hasMany(Commentaire::class);
    }

    /**
     * public function film(){
        return $this->belongsToMany(Film::class, 'commentaires')->withPivot('commentaire');
    }
     */

    public function film(){
        return $this->belongsToMany(Sceance::class, 'evaluations');
    }

    public function like(){
        return $this->belongsToMany(Film::class, 'likes');
    }

    public function reservations(){
        //car un user peux réservéd'1;n fois
        return $this->hasMany(Reservation::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
