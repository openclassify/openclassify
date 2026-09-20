<?php

declare(strict_types=1);

namespace Modules\Review\Filament\Admin\Resources\ReviewResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Review\Filament\Admin\Resources\ReviewResource;

class EditReviewResourceRecord extends EditRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
