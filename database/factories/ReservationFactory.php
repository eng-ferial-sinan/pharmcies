<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1 ,
            'salon_id' => 1 ,
            'service_id' => rand(0,100) ,
            'price' => rand(0,100) ,
            'date' => now()->format('y-m-d') ,
            'time' => now()->format('H:i:s') ,
        ];
    }
}
