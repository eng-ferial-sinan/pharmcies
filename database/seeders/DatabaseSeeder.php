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
        // \App\Models\User::factory(10)->create();
        $this->call([statusSeeder::class]);
        $this->call([sittingSeeder::class]);
        $this->call([permistionSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([user_permitionSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([medicinSeeder::class]);
        $this->call([pharmacySeeder::class]);
        $this->call([OrderSeeder::class]);



    }
}
