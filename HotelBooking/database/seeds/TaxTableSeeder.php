<?php

use App\Tax;
use Illuminate\Database\Seeder;

class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = new Tax();
        $tax->name = 'VAT';
        $tax->type = 'TAX';
        $tax->rate = 10;
        $tax->save();

        $tax = new Tax();
        $tax->name = 'Service Charge';
        $tax->type = 'FEE';
        $tax->rate = 10;
        $tax->save();
    }
}
