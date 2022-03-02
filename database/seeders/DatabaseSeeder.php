<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PaymentMethodSeeder::class]);
        $this->call([SittingSeeder::class]);
        $this->call([PermissionSeeder::class]);
        $this->call([RoleSeeder::class]);
        $this->call([DemoSeeder::class]);
        $this->call([UserSeeder::class]);
        \App\Models\User::factory(10)->create();



    }
}
