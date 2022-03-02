<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SittingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insertOrIgnore([
            ['nameEn'=>"Online Store",
            'nameAr'=>"حجز صالون",
            'email'=>"company@admin.com",
            'address'=>"Sana",
            'phone'=>"00967000000",
            'lat'=>15.3387797,
            'lng'=>44.173536,
            'created_at'=>Carbon::now()
            ]
           ]);
           
    }
}
