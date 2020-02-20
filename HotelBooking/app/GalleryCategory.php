<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryCategory extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    public function hotelGalleries(){
        return $this->hasMany(HotelGallery::class);
    }
}
