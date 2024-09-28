<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'due_date' => Carbon::now()->addDays($this->faker->numberBetween(1, 30)),
            'milestone_id' => \App\Models\Milestone::factory(),
            'project_id' => \App\Models\Project::factory(),
            'assigned_to' => \App\Models\TeamMember::factory()->create()->id,
        ];
    }
}
