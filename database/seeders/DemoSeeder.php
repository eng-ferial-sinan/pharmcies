<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Salon;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Salon::factory()->count(5)->create();
        User::factory()->count(30)->create();
       
        $salons=Salon::all();
        foreach($salons as $salon)
        {
        Service::factory()->count(5)->create([
          'salon_id'=> $salon->id
        ]);
        }

    }
}
