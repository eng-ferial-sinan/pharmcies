<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class sittingSeeder extends Seeder
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
            ['nameEn'=>"compony",'nameAr'=>"شركة ادوية",'email'=>"company@admin.com",'address'=>"Sana",'phone'=>"00967000000"]
           ]);
           
    }
}
