<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function images(){
        return $this->hasMany(RoomTypeImage::class);
    }

    public function featuredImage(){
        return $this->images->where('featured', 1)->first();
    }

    public function amenities(){
        return $this->belongsToMany(Amenity::class,'room_type_pivot_amenity','room_type_id','amenity_id');
    }
}
