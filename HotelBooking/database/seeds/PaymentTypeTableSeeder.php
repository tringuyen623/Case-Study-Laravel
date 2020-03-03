<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'type' => 'Online'
        ]);

        DB::table('payment_types')->insert([
            'type' => 'Offline'
        ]);
    }
}
