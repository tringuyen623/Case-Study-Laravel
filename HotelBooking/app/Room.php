<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function bookings(){
        return $this->belongsToMany(Booking::class)->withPivot('from_date', 'to_date');
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function roomRate(){
        return $this->roomType->base_price;
    }

    public function bed(){
        return $this->belongsTo(Bed::class);
    }

    public function available($date){
        return $this->bookings()->wherePivot('from_date','<=', $date)->wherePivot('to_date','>', $date)->where('status',1)->first();
    }
}
