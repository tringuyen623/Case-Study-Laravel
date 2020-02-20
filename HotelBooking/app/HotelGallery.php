<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelGallery extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function galleryCategory(){
        return $this->belongsTo(GalleryCategory::class);
    }
}
