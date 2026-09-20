<?php

declare(strict_types=1);

namespace Modules\Report\Filament\Admin\Resources\ReportResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Report\Filament\Admin\Resources\ReportResource;

class CreateReportResourceRecord extends CreateRecord
{
    protected static string $resource = ReportResource::class;
}
