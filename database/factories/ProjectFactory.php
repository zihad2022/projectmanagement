<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'budget' => $this->faker->numberBetween(10000, 1000000),
            'deadline' => Carbon::now()->addDays($this->faker->numberBetween(10, 100)),
            'progress' => $this->faker->numberBetween(0, 100),
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
