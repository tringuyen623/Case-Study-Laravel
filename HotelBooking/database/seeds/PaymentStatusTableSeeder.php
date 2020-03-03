<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            'status' => 1
        ]);

        DB::table('payment_statuses')->insert([
            'status' => 0
        ]);
    }
}
