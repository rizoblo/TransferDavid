<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    public function toLeagues(){
        return $this->belongsTo(League::class);
    }
    public function toTeams(){
        return $this->belongsTo(Team::class);
    }
}
