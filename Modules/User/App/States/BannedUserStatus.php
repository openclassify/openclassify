<?php

namespace Modules\User\App\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class BannedUserStatus extends UserStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'banned';

    public function getLabel(): ?string
    {
        return 'Banned';
    }

    public function getColor(): string | array | null
    {
        return 'danger';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-no-symbol';
    }

    public function getDescription(): ?string
    {
        return 'User is blocked from panel access.';
    }
}
