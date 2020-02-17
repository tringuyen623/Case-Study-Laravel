<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\type;

class Hotel extends Model
{
    protected $guarded = [];
    
    public function users(){
        return $this->hasMany(User::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function bookings(){
        return $this->rooms()->bookings();
    }
}
