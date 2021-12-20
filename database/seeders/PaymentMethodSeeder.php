<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('payment_methods')->insertOrIgnore(
            ['id'=>1,'name' => 'cash']);
        DB::table('payment_methods')->insertOrIgnore(
            ['id'=>2,'name' => 'paypal']);
    }
}
