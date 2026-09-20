<?php

declare(strict_types=1);

namespace Modules\Report\Filament\Admin\Resources\ReportResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Report\Filament\Admin\Resources\ReportResource;

class EditReportResourceRecord extends EditRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
