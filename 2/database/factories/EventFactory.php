<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'location' => $this->faker->address(),
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
