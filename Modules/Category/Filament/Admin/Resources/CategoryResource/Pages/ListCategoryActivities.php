<?php

namespace Modules\Category\Filament\Admin\Resources\CategoryResource\Pages;

use Modules\Category\Filament\Admin\Resources\CategoryResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListCategoryActivities extends ListActivities
{
    protected static string $resource = CategoryResource::class;
}
