<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MilestoneStatus: int implements HasLabel, HasColor
{
    case Pending = 0;
    case Completed = 1;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Completed => 'success',
        };
    }
}
