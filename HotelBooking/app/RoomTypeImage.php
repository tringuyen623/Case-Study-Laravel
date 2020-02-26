<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomTypeImage extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
