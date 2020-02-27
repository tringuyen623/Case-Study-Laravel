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
        for( $i = 1; $i < 5; $i++){
            DB::table('beds')->insert([
                'bed_type' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
