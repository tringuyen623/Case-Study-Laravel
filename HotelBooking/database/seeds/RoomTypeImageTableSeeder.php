<?php

use App\RoomTypeImage;
use Illuminate\Database\Seeder;

class RoomTypeImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 6; $i++){
            $roomTypeImage = new RoomTypeImage();
            $roomTypeImage->image = 'image' . $i;
            $roomTypeImage->room_type_id = $i;
            $roomTypeImage->save();
        }
    }
}
