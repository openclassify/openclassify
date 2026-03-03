<?php

namespace Modules\Listing\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class SoldListingStatus extends ListingStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'sold';

    public function getLabel(): ?string
    {
        return 'Sold';
    }

    public function getColor(): string | array | null
    {
        return 'gray';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-currency-dollar';
    }

    public function getDescription(): ?string
    {
        return 'Listing is completed and no longer available.';
    }
}
