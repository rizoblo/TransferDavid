<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    public function toParticipates(){
        return $this->belongsToMany(Participate::class);
    }
}
