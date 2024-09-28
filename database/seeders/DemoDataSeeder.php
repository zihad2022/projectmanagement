<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Milestone;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Project;
use App\Models\Task;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create payment methods
        PaymentMethod::factory()->count(5)->create();

        // Create clients
        $clients = Client::factory()->count(10)->create();

        // Create team members first
        $teamMembers = TeamMember::factory()->count(15)->create();

        // Create projects with milestones, tasks, and team members
        Project::factory()
            ->count(10)
            ->has(Milestone::factory()->count(3), 'milestones')
            ->has(Task::factory()->count(5), 'tasks')
            ->create()
            ->each(function ($project) use ($teamMembers) {
                // Attach 3 random team members to each project
                $project->teamMembers()->attach($teamMembers->random(3));
            });

        // Create payments
        Payment::factory()->count(20)->create();
    }
}
