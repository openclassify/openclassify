<?php

namespace Modules\User\App\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class ActiveUserStatus extends UserStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'active';

    public function getLabel(): ?string
    {
        return 'Active';
    }

    public function getColor(): string | array | null
    {
        return 'success';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-check-circle';
    }

    public function getDescription(): ?string
    {
        return 'User can access all assigned panels.';
    }
}
