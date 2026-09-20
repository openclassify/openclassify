<?php

declare(strict_types=1);

namespace Modules\Report\Filament\Admin\Resources\ReportResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Report\Filament\Admin\Resources\ReportResource;

class ListReportResourceRecords extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
