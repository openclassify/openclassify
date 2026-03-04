<?php

namespace Modules\User\App\Support\Filament;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserFormFields
{
    public static function name(): TextInput
    {
        return TextInput::make('name')->required()->maxLength(255);
    }

    public static function email(): TextInput
    {
        return TextInput::make('email')->email()->required()->maxLength(255)->unique(ignoreRecord: true);
    }

    public static function password(callable $requiredCallback): TextInput
    {
        return TextInput::make('password')
            ->password()
            ->required($requiredCallback)
            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
            ->dehydrated(fn ($state) => filled($state));
    }

    public static function status(): StateFusionSelect
    {
        return StateFusionSelect::make('status')->required();
    }

    public static function roles(): Select
    {
        return Select::make('roles')->multiple()->relationship('roles', 'name')->preload();
    }
}
