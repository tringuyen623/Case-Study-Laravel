<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function rooms(){
        return $this->belongsToMany(Room::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
