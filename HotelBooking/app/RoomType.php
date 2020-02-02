<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $guarded = [];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
