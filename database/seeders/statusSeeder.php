<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insertOrIgnore([
         ['id'=>1,'name'=>"جاري المعالجة"],
         ['id'=>2,'name'=>"جاري التحضير"],
         ['id'=>3,'name'=>"المندوب في الطريق "],
         ['id'=>4,'name'=>"تم التوصيل "],
         ['id'=>5,'name'=>"تم الاستلام "],
         ['id'=>6,'name'=>" الغاء الطلبية"]
        ]);
       
    }
}
