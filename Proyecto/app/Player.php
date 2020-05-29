<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function toTeams(){
        return $this->belongsTo(Team::class);
    }
}
