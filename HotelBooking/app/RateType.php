<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateType extends Model
{
    public function rates(){
        return $this->hasMany(Rate::class);
    }
}
