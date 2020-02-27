<?php

use App\GalleryCategory;
use App\HotelGallery;
use Illuminate\Database\Seeder;

class HotelGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $galleryCategory = new GalleryCategory();
            $galleryCategory->name = 'Room';
            $galleryCategory->save();
            $galleryCategory->hotelGalleries()->save(new HotelGallery(['image' => 'image']));

            $galleryCategory = new GalleryCategory();
            $galleryCategory->name = 'Hotel';
            $galleryCategory->save();
            $galleryCategory->hotelGalleries()->save(new HotelGallery(['image' => 'image']));

            $galleryCategory = new GalleryCategory();
            $galleryCategory->name = 'Service';
            $galleryCategory->save();
            $galleryCategory->hotelGalleries()->save(new HotelGallery(['image' => 'image']));
    }
}
