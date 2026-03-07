<?php

namespace Modules\Video\Filament\Admin\Resources\VideoResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Video\Filament\Admin\Resources\VideoResource;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;
}
