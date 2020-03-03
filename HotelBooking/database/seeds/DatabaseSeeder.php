<?php

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
        $this->call(RoomTypeImageTableSeeder::class);
        $this->call(HotelGalleryTableSeeder::class);
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(PaymentStatusTableSeeder::class);
    }
}
