<?php

namespace Modules\Admin\Support\Filament;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

final class ResourceTableColumns
{
    public static function id(string $name = 'id'): TextColumn
    {
        return TextColumn::make($name)->sortable();
    }

    public static function activeIcon(string $name = 'is_active', string $label = 'Active'): IconColumn
    {
        return IconColumn::make($name)->label($label)->boolean();
    }

    public static function createdAtHidden(string $name = 'created_at'): TextColumn
    {
        return TextColumn::make($name)
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
