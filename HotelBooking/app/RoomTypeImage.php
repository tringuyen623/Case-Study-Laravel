<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomTypeImage extends Model
{
    protected $guarded = [];
    
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
