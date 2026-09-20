<?php

declare(strict_types=1);

namespace Modules\Page\Filament\Admin\Resources\PageResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Page\Filament\Admin\Resources\PageResource;

class EditPageResourceRecord extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
