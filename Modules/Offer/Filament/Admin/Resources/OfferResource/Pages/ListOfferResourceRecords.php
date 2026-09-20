<?php

declare(strict_types=1);

namespace Modules\Offer\Filament\Admin\Resources\OfferResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Offer\Filament\Admin\Resources\OfferResource;

class ListOfferResourceRecords extends ListRecords
{
    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
