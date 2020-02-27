<?php

use App\Http\Controllers\RoomTypeImageController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HotelsTableSeeder::class);
        $this->call(RoomTypeTableSeeder::class);
        $this->call(BedTableSeeder::class);
        $this->call(RoomTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(AmenityTableSeeder::class);
        $this->call(TaxTableSeeder::class);
        $this->call(RoomTypeImageController::class);
        $this->call(HotelGalleryTableSeeder::class);
    }
}
