<?php

namespace Modules\Listing\States;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

class PendingListingStatus extends ListingStatus implements HasColor, HasDescription, HasIcon, HasLabel
{
    protected static string $name = 'pending';

    public function getLabel(): ?string
    {
        return 'Pending';
    }

    public function getColor(): string | array | null
    {
        return 'warning';
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-clock';
    }

    public function getDescription(): ?string
    {
        return 'Listing is waiting for review.';
    }
}
