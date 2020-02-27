<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert([
            'name' => 'Superior',
            'short_code' => 'SUP',
            'description' => Str::random(100),
            'size' => '35m2',
            'view' => 'Garden',
            'higher_capacity' => 2,
            'kids_capacity' => 2,
            'base_price' => 100.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('room_types')->insert([
            'name' => 'Deluxe',
            'short_code' => 'DLX',
            'description' => Str::random(100),
            'size' => '35m2',
            'view' => 'Candle lake or Valley poll',
            'higher_capacity' => 3,
            'kids_capacity' => 2,
            'base_price' => 120.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('room_types')->insert([
            'name' => 'Premium Deluxe',
            'short_code' => 'PDLX',
            'description' => Str::random(100),
            'size' => '40m2',
            'view' => 'City view or Perfum river',
            'higher_capacity' => 3,
            'kids_capacity' => 2,
            'base_price' => 150.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('room_types')->insert([
            'name' => 'Family Deluxe',
            'short_code' => 'BGL',
            'description' => Str::random(100),
            'size' => '45m2',
            'view' => 'Candle lake or Valley poll',
            'higher_capacity' => 4,
            'kids_capacity' => 2,
            'base_price' => 200.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('room_types')->insert([
            'name' => 'Honeymoon Pool Villa',
            'short_code' => 'HPV',
            'description' => Str::random(100),
            'size' => '45m2',
            'view' => 'Candle lake or Valley poll',
            'higher_capacity' => 3,
            'kids_capacity' => 2,
            'base_price' => 200.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('room_types')->insert([
            'name' => 'King Suite',
            'short_code' => 'KS',
            'description' => Str::random(100),
            'size' => '45m2',
            'view' => 'Candle lake or Valley poll',
            'higher_capacity' => 5,
            'kids_capacity' => 2,
            'base_price' => 250.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
