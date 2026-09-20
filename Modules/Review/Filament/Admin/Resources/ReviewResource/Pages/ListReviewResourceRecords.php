<?php

declare(strict_types=1);

namespace Modules\Review\Filament\Admin\Resources\ReviewResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Review\Filament\Admin\Resources\ReviewResource;

class ListReviewResourceRecords extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
