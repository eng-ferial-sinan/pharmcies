<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name,
            'send_messages_automatically' => 1 ,
            'message_reminder' => 1 ,
            'unlimited_messages' => 1 ,
            'attached_photos_video' => 1 ,
            'remove_ads' => 1 ,
            'choose_multiple_contacts' => 1 ,
            'unlimited_characters' => 1 ,
            'customize_scheduling_frequency' => 1 ,
            'number_of_contacts' => 10 ,
            'add_the_number_of_waiting_messages' => 3 ,
            'monthly_subscription' => 3 ,
            'yearly_subscription' => 10,
        ];
    }
}
