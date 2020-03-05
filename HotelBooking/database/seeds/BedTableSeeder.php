<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('beds')->insert([
                'bed_type' => 'DBL',
                'created_at' => now(),
                'updated_at' => now()
            ]);     
            
            DB::table('beds')->insert([
                'bed_type' => 'KING',
                'created_at' => now(),
                'updated_at' => now()
            ]);     

            DB::table('beds')->insert([
                'bed_type' => 'TWN',
                'created_at' => now(),
                'updated_at' => now()
            ]);     

            DB::table('beds')->insert([
                'bed_type' => 'SGL',
                'created_at' => now(),
                'updated_at' => now()
            ]);     
    }
}
