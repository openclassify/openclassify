<?php
namespace Modules\Admin\Filament\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Admin\Filament\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
