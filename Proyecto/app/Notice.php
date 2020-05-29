<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function toUsers(){
        return $this->belongsTo(User::class);
    }
}
