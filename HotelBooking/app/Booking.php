<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function rooms(){
        return $this->belongsToMany(Room::class)->withPivot('from_date', 'to_date');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
