<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use SoftDeletes;

    public function room(){
        return $this->hasOne(Room::class);
    }
}
