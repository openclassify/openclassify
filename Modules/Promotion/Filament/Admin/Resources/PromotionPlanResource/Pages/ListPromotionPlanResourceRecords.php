<?php

declare(strict_types=1);

namespace Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource;

class ListPromotionPlanResourceRecords extends ListRecords
{
    protected static string $resource = PromotionPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
