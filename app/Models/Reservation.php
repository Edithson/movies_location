<?php

namespace App\Models;

use App\Models\User;
use App\Models\Seance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seance(){
        return $this->belongsTo(Seance::class);
    }
}
