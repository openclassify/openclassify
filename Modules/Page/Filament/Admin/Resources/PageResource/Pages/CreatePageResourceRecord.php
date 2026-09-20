<?php

declare(strict_types=1);

namespace Modules\Page\Filament\Admin\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Page\Filament\Admin\Resources\PageResource;

class CreatePageResourceRecord extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
