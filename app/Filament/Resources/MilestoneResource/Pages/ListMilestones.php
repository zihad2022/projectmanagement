<?php

namespace App\Filament\Resources\MilestoneResource\Pages;

use App\Enums\MilestoneStatus;
use App\Filament\Resources\MilestoneResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMilestones extends ListRecords
{
    protected static string $resource = MilestoneResource::class;

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
                return $query->where('status', MilestoneStatus::Pending);
            }),
            'completed' => Tab::make('Completed')->modifyQueryUsing(function ($query) {
                return $query->where('status', MilestoneStatus::Completed);
            }),
        ];
    }
}
