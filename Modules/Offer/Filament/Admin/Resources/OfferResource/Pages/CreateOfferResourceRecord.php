<?php

declare(strict_types=1);

namespace Modules\Offer\Filament\Admin\Resources\OfferResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Offer\Filament\Admin\Resources\OfferResource;

class CreateOfferResourceRecord extends CreateRecord
{
    protected static string $resource = OfferResource::class;
}
