<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Product;
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
        User::factory()->count(10)->create();
       
        
        Plan::factory()->create([
          'name'=> 'free',
          'customize_scheduling_frequency'=> 0,
          'unlimited_characters'=> 0,
          'monthly_subscription'=> 0,
          'yearly_subscription'=> 0
        ]);
       
        Plan::factory()->create([
          'name'=> 'pro',    
        ]);

    }
}
