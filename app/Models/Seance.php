<?php

namespace App\Models;

use App\Models\Film;
use App\Models\User;
use App\Models\Salle;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seance extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function salle(){
        return $this->belongsTo(Salle::class);
    }

    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function reservations(){
        //car une seance peux faire l'objet d'1;n reservations
        return $this->hasMany(Reservation::class);
    }
}
