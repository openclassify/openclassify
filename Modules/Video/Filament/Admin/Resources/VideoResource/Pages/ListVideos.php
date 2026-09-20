<?php

declare(strict_types=1);

namespace Modules\Video\Filament\Admin\Resources\VideoResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Video\Filament\Admin\Resources\VideoResource;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
