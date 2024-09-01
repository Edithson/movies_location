<?php

namespace App\Models;

use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    protected $guarded = [];
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function film(){
        return $this->belongsTo(Film::class);
    }
}
