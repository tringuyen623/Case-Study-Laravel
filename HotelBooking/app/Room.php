<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function bookings(){
        return $this->belongsToMany(Booking::class)->withPivot('from_date', 'to_date');
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function bed(){
        return $this->belongsTo(Bed::class);
    }
}
