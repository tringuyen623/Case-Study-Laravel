<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function bookings(){
        return $this->belongsToMany(Booking::class);
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
