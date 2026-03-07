<?php

namespace Modules\Admin\Support;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Modules\S3\Support\MediaStorage;

final class HomeSlideFormSchema
{
    public static function make(array $defaults, callable $normalizeSlides): Repeater
    {
        return Repeater::make('home_slides')
            ->label('Homepage Slides')
            ->helperText('Use 1 to 5 slides. Upload a wide image for each slide to improve the hero area.')
            ->schema([
                Hidden::make('disk'),
                FileUpload::make('image_path')
                    ->label('Slide Image')
                    ->image()
                    ->disk(fn (Get $get): string => MediaStorage::storedDisk($get('disk'), self::mediaDriver($get)))
                    ->directory('home-slides')
                    ->visibility('public')
                    ->imageEditor()
                    ->imagePreviewHeight('200')
                    ->helperText('Recommended: 1600x1000 or wider.')
                    ->afterStateUpdated(function (Get $get, Set $set, mixed $state): void {
                        $set(
                            'disk',
                            MediaStorage::managesPath($state)
                                ? MediaStorage::diskFromDriver(self::mediaDriver($get))
                                : null,
                        );
                    })
                    ->columnSpanFull(),
                TextInput::make('badge')
                    ->label('Badge')
                    ->maxLength(255),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->rows(3)
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                TextInput::make('primary_button_text')
                    ->label('Primary Button')
                    ->required()
                    ->maxLength(120),
                TextInput::make('secondary_button_text')
                    ->label('Secondary Button')
                    ->required()
                    ->maxLength(120),
            ])
            ->columns(2)
            ->default($defaults)
            ->minItems(1)
            ->maxItems(5)
            ->collapsible()
            ->collapsed()
            ->cloneable()
            ->reorderableWithButtons()
            ->addActionLabel('Add Slide')
            ->itemLabel(fn (array $state): string => filled($state['title'] ?? null) ? (string) $state['title'] : 'New Slide')
            ->dehydrateStateUsing(fn ($state) => $normalizeSlides($state));
    }

    private static function mediaDriver(Get $get): string
    {
        $driver = $get('../../media_disk');

        return is_string($driver) && trim($driver) !== ''
            ? MediaStorage::normalizeDriver($driver)
            : MediaStorage::activeDriver();
    }
}
