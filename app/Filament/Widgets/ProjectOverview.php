<?php

namespace App\Filament\Widgets;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        $projects = Project::where('status', ProjectStatus::InProgress)->get();

        $totalProjects = $projects->count();
        $totalTasks = Task::count();
        $todayTasks = Task::whereDate('due_date', $today)->count();

        $projectsWithDaysLeft = $projects->map(function ($project) use ($today) {
            $daysLeft = Carbon::parse($project->deadline)->diffInDays($today);

            return [
                'name' => $project->name,
                'days_left' => $daysLeft,
                'progress' => $project->progress,
            ];
        });

        $stats = [
            Stat::make('Total Running Projects', $totalProjects),
            Stat::make('Total Tasks', $totalTasks),
            Stat::make('Today\'s Tasks', $todayTasks),
        ];

        foreach ($projectsWithDaysLeft as $project) {
            $stats[] = Stat::make($project['name'], view('filament.widgets.project-stats', [
                'project' => $project,
            ]));
        }

        return $stats;
    }
}
