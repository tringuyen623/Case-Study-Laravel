<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 0; $i < 10; $i++){
            DB::table('rooms')->insert([
                'room_number' => 10 . $i,
                'room_type_id' => random_int(1,6),
                'extra_bed' => random_int(0,1),
                'bed_id' => random_int(1,4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        for( $i = 0; $i < 10; $i++){
            DB::table('rooms')->insert([
                'room_number' => 20 . $i,
                'room_type_id' => random_int(1,6),
                'extra_bed' => random_int(0,1),
                'bed_id' => random_int(1,4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        for( $i = 0; $i < 10; $i++){
            DB::table('rooms')->insert([
                'room_number' => 30 . $i,
                'room_type_id' => random_int(1,6),
                'extra_bed' => random_int(0,1),
                'bed_id' => random_int(1,4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        for( $i = 0; $i < 10; $i++){
            DB::table('rooms')->insert([
                'room_number' => 40 . $i,
                'room_type_id' => random_int(1,6),
                'extra_bed' => random_int(0,1),
                'bed_id' => random_int(1,4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        for( $i = 0; $i < 10; $i++){
            DB::table('rooms')->insert([
                'room_number' => 50 . $i,
                'room_type_id' => random_int(1,6),
                'extra_bed' => random_int(0,1),
                'bed_id' => random_int(1,4),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
