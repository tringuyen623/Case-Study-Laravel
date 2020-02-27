<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create();

        DB::table('hotels')->insert([
            'name' => 'Dream Hotel',
            'address' => '28 Nguyen Tri Phuong, Tp.Hue, Viet Nam',
            'phone' => '0987123456',
            'email' => 'dreamhotel@demo.com',
            'check_in_time' => '14:00',
            'check_out_time' => '12:00',
            'currency' => 'USD',
            'currency_symbol' => '$',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
