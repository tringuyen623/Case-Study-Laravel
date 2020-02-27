<?php

use App\Amenity;
use Illuminate\Database\Seeder;

class AmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenity = new Amenity();
        $amenity->name = 'Free WIFI';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = 'Air Conditioner';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = 'Fitness Center';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = 'Room Service';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = 'Free Newspaper';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = 'Coffe Maker';
        $amenity->save();

        $amenity = new Amenity();
        $amenity->name = '50" LCD TV';
        $amenity->save();
    }
}
