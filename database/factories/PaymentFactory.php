<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_date' => $this->faker->date(),
            'currency' => $this->faker->randomElement(['BDT', 'USD', 'EUR', 'GBP']),
            'project_id' => \App\Models\Project::factory(),
            'client_id' => \App\Models\Client::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
        ];
    }
}
