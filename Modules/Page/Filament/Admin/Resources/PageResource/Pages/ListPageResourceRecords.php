<?php

declare(strict_types=1);

namespace Modules\Page\Filament\Admin\Resources\PageResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Page\Filament\Admin\Resources\PageResource;

class ListPageResourceRecords extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
