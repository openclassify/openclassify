<?php

declare(strict_types=1);

namespace Modules\Review\Filament\Admin\Resources\ReviewResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Review\Filament\Admin\Resources\ReviewResource;

class CreateReviewResourceRecord extends CreateRecord
{
    protected static string $resource = ReviewResource::class;
}
