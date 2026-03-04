<?php

namespace Modules\User\App\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class SuspendedUserStatus extends UserStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'suspended';

    public function getLabel(): ?string
    {
        return 'Suspended';
    }

    public function getColor(): string | array | null
    {
        return 'warning';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-pause-circle';
    }

    public function getDescription(): ?string
    {
        return 'User access is temporarily limited.';
    }
}
