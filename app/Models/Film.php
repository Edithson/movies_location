<?php

namespace App\Models;

use App\Models\User;
use App\Models\Seance;
use App\Models\Evaluation;
use App\Models\Commentaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function commentaires(){
        return $this->hasMany(Commentaire::class);
    }

    /**
     *     public function user(){
        return $this->belongsToMany(User::class, 'commentaires')->withPivot('commentaire');
    }
     */

    public function seances(){
        return $this->hasMany(Seance::class);
    }

    public function like(){
        return $this->belongsToMany(User::class, 'likes');
    }
}
