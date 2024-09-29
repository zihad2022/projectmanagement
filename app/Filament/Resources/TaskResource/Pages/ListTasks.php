<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'pending' => Tab::make('Pending')->modifyQueryUsing(function ($query) {
                return $query->where('status', TaskStatus::Pending);
            }),
            'in_progress' => Tab::make('In Progress')->modifyQueryUsing(function ($query) {
                return $query->where('status', TaskStatus::InProgress);
            }),
            'completed' => Tab::make('Completed')->modifyQueryUsing(function ($query) {
                return $query->where('status', TaskStatus::Completed);
            }),
        ];
    }
}
