<?php

declare(strict_types=1);

namespace Modules\Offer\Filament\Admin\Resources\OfferResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Offer\Filament\Admin\Resources\OfferResource;

class EditOfferResourceRecord extends EditRecord
{
    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
