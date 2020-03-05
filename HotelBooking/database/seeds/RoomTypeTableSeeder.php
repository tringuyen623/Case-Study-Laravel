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
            'description' => 'This is Superior room',
            'size' => '35m2',
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
            'description' => 'This is Deluxe room',
            'size' => '35m2',
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
            'description' => 'This is Premium Deluxe room',
            'size' => '40m2',
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
            'description' => 'This is Family Deluxe room',
            'size' => '45m2',
            'higher_capacity' => 4,
            'kids_capacity' => 2,
            'base_price' => 200.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // DB::table('room_types')->insert([
        //     'name' => 'Honeymoon Pool Villa',
        //     'short_code' => 'HPV',
        //     'description' => 'This is Pool Villa room',
        //     'size' => '45m2',
        //     'higher_capacity' => 3,
        //     'kids_capacity' => 2,
        //     'base_price' => 200.00,
        //     'status' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        DB::table('room_types')->insert([
            'name' => 'King Suite',
            'short_code' => 'KS',
            'description' => 'This is King Suite room',
            'size' => '45m2',
            'higher_capacity' => 5,
            'kids_capacity' => 2,
            'base_price' => 250.00,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
