<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    public function rooms(){
        return $this->belongsToMany(Room::class)->withPivot('from_date', 'to_date');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function getFullName(){
        $fullName = $this->customer->first_name . ' ' .$this->customer->last_name;

        return $fullName;
    }
}
