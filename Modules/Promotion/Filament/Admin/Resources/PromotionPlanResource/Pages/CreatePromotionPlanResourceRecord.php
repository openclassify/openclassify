<?php

declare(strict_types=1);

namespace Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource;

class CreatePromotionPlanResourceRecord extends CreateRecord
{
    protected static string $resource = PromotionPlanResource::class;
}
