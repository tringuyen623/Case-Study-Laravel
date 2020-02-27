<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        ]);

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
