<?php

declare(strict_types=1);

namespace Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource;

class EditPromotionPlanResourceRecord extends EditRecord
{
    protected static string $resource = PromotionPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
