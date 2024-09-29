<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

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
                return $query->where('status', ProjectStatus::Pending);
            }),
            'in_progress' => Tab::make('In Progress')->modifyQueryUsing(function ($query) {
                return $query->where('status', ProjectStatus::InProgress);
            }),
            'completed' => Tab::make('Completed')->modifyQueryUsing(function ($query) {
                return $query->where('status', ProjectStatus::Completed);
            }),
        ];
    }
}
