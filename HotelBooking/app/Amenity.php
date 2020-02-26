<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function roomTypes(){
        return $this->belongsToMany(RoomType::class,'roomm_type_pivot_amenity', 'amenity_id', 'room_type_id');
    }
}
