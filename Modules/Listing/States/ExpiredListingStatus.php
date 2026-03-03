<?php

namespace Modules\Listing\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class ExpiredListingStatus extends ListingStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'expired';

    public function getLabel(): ?string
    {
        return 'Expired';
    }

    public function getColor(): string | array | null
    {
        return 'danger';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-x-circle';
    }

    public function getDescription(): ?string
    {
        return 'Listing is no longer active due to expiry.';
    }
}
