<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function ToPlayers(){
        return $this->hasMany(Player::class);
    }
    public function toParticipates(){
        return $this->belongsToMany(Participate::class);
    }
}
