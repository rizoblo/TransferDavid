<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function toTeams2(){
        return $this->belongsTo(Team::class);
    }
    public function toTeams(){
        return $this->belongsTo(Team::class);
    }
    public function toLeagues(){
        return $this->belongsTo(League::class);
    }
}
