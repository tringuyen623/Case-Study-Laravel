<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'title' => '24/7 Front Desk',
            'icon' => 'flaticon-reception',
            'description' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'title' => 'Spa Suites',
            'icon' => 'flaticon-herbs',
            'description' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('services')->insert([
            'title' => 'Spa',
            'icon' => 'flaticon-car',
            'description' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'title' => 'Restaurent & Bar',
            'icon' => 'flaticon-cheers',
            'description' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
