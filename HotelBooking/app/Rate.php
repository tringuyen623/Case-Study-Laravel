<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function rateType(){
        return $this->belongsTo(RateType::class, 'rate_type_id');
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
