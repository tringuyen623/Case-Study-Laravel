<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function getFullName(){
        return ($this->gender === 0 ? 'Mr. ' : 'Ms. ') . $this->first_name . ' ' . $this->last_name;
    }
}
