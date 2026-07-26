<?php

declare(strict_types=1);

namespace Modules\Listing\Filament\Admin\Resources\ListingResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Listing\Filament\Admin\Resources\ListingResource;
use Modules\Listing\Models\Listing;

class EditListing extends EditRecord
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (! $record instanceof Listing) {
            return parent::handleRecordUpdate($record, $data);
        }

        $record->applyAdminFormData($data);
        $record->save();

        return $record;
    }
}
